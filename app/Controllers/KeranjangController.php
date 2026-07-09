<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * KeranjangController — Menangani logika keranjang belanja & checkout.
 */
class KeranjangController extends BaseController
{
    protected ProdukModel $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index(): string
    {
        $keranjang  = session()->get('keranjang') ?? [];
        $grandTotal = 0;

        foreach ($keranjang as $item) {
            $grandTotal += $item['harga'] * $item['jumlah'];
        }

        $data['keranjang']  = $keranjang;
        $data['grandTotal'] = $grandTotal;

        return view('keranjang_view', $data);
    }

    /**
     * Memasukkan produk ke session keranjang (via POST).
     */
    public function addToCart(int $id): RedirectResponse
    {
        $produk = $this->produkModel->find($id);

        if (!$produk || $produk['stok'] <= 0) {
            return redirect()->back()->with('error', 'Stok barang ini sedang kosong!');
        }

        $keranjang = session()->get('keranjang') ?? [];

        if (isset($keranjang[$id])) {
            if ($keranjang[$id]['jumlah'] >= $produk['stok']) {
                return redirect()->back()->with('error', 'Jumlah di keranjang sudah mencapai batas stok!');
            }
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'nama_produk' => $produk['nama_produk'],
                'harga'       => $produk['harga'],
                'foto'        => $produk['foto'],
                'jumlah'      => 1,
            ];
        }

        session()->set('keranjang', $keranjang);

        return redirect()->back()->with('pesan', $produk['nama_produk'] . ' berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus satu item dari keranjang.
     */
    public function hapus(int $id): RedirectResponse
    {
        $keranjang = session()->get('keranjang') ?? [];

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->set('keranjang', $keranjang);
        }

        return redirect()->to('/keranjang')->with('pesan', 'Barang berhasil dikeluarkan dari keranjang.');
    }

    /**
     * Memproses checkout — potong stok dengan database transaction.
     */
    public function checkout(): RedirectResponse
    {
        $keranjang = session()->get('keranjang') ?? [];

        if (empty($keranjang)) {
            return redirect()->to('/')->with('error', 'Keranjang belanja masih kosong!');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($keranjang as $id => $item) {
            $produkAsli = $this->produkModel->find($id);

            if (!$produkAsli || $produkAsli['stok'] < $item['jumlah']) {
                $db->transRollback();
                return redirect()->to('/keranjang')->with('error', 'Gagal checkout! Stok ' . $item['nama_produk'] . ' tidak mencukupi.');
            }

            $stokBaru = $produkAsli['stok'] - $item['jumlah'];
            $this->produkModel->update($id, ['stok' => $stokBaru]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/keranjang')->with('error', 'Terjadi kesalahan saat memproses checkout.');
        }

        session()->remove('keranjang');

        return redirect()->to('/')->with('pesan', '🔥 Checkout berhasil! Stok telah diperbarui. Terima kasih atas pembeliannya!');
    }
}
