<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel; // Panggil model kategori untuk dropdown

class Shop extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data['daftar_produk'] = $produkModel->getProdukWithKategori();
        return view('shop_view', $data);
    }

    // Fungsi untuk menampilkan form tambah produk
    public function tambah()
    {
        $kategoriModel = new KategoriModel();
        // Ambil semua kategori dari Postgres buat isi dropdown select
        $data['daftar_kategori'] = $kategoriModel->findAll();

        return view('tambah_produk_view', $data);
    }

    // Fungsi untuk memproses penyimpanan data ke database
   public function simpan()
{
    $produkModel = new ProdukModel();

    // Tangkap file foto dari input form
    $fileFoto = $this->request->getFile('foto');
    $namaFoto = 'default.png'; // Nama bawaan jika tidak upload foto

    // Validasi: Cek apakah user mengupload file gambar
    if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
        $namaFoto = $fileFoto->getRandomName(); // Bikin nama acak unik
        $fileFoto->move(ROOTPATH . 'public/uploads', $namaFoto); // Pindahkan file
    }

    $produkModel->save([
        'kategori_id' => $this->request->getPost('kategori_id'),
        'nama_produk' => $this->request->getPost('nama_produk'),
        'deskripsi'   => $this->request->getPost('deskripsi'),
        'harga'       => $this->request->getPost('harga'),
        'stok'        => $this->request->getPost('stok'),
        'foto'        => $namaFoto
    ]);

    return redirect()->to('/');
}

    // Menampilkan Form Edit beserta data lama produknya
public function edit($id)
{
    $produkModel = new ProdukModel();
    $kategoriModel = new KategoriModel();

    $data['produk'] = $produkModel->find($id); // Cari produk spesifik berdasarkan ID
    $data['daftar_kategori'] = $kategoriModel->findAll(); // Ambil list kategori buat dropdown

    return view('edit_produk_view', $data);
}

// Memproses perubahan data ke database
public function update($id)
{
    $produkModel = new ProdukModel();
    $produkLama = $produkModel->find($id); // Ambil data lama buat ngecek foto
    
    $fileFoto = $this->request->getFile('foto');
    $namaFoto = $produkLama['foto']; // Gunakan foto lama sebagai cadangan default

    // Cek jika ada file gambar baru yang diupload
    if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
        $namaFoto = $fileFoto->getRandomName(); // Bikin nama acak baru
        $fileFoto->move(ROOTPATH . 'public/uploads', $namaFoto);

        // Hapus file foto lama di folder uploads agar tidak jadi sampah server
        if ($produkLama['foto'] && $produkLama['foto'] !== 'default.png') {
            $pathFotoLama = ROOTPATH . 'public/uploads/' . $produkLama['foto'];
            if (file_exists($pathFotoLama)) {
                unlink($pathFotoLama); // Hapus file fisik
            }
        }
    }

    $produkModel->update($id, [
        'kategori_id' => $this->request->getPost('kategori_id'),
        'nama_produk' => $this->request->getPost('nama_produk'),
        'deskripsi'   => $this->request->getPost('deskripsi'),
        'harga'       => $this->request->getPost('harga'),
        'stok'        => $this->request->getPost('stok'),
        'foto'        => $namaFoto
    ]);

    return redirect()->to('/');
}

// Menghapus produk dari database
public function delete($id)
{
    $produkModel = new ProdukModel();
    
    $produkModel->delete($id); // Eksekusi DELETE FROM produk WHERE id = $id

    return redirect()->to('/');
}

// Fungsi memasukkan produk ke session keranjang
public function addToCart($id)
{
    $produkModel = new ProdukModel();
    $produk = $produkModel->find($id);

    if (!$produk || $produk['stok'] <= 0) {
        return redirect()->back()->with('error', 'Waduh, stok barang ini lagi kosong, Bree!');
    }

    $keranjang = session()->get('keranjang') ?? [];

    // Jika produk sudah ada di keranjang, tinggal tambahkan jumlahnya (+1)
    if (isset($keranjang[$id])) {
        if ($keranjang[$id]['jumlah'] >= $produk['stok']) {
            return redirect()->back()->with('error', 'Gak bisa nambah, lu udah borong semua sisa stoknya!');
        }
        $keranjang[$id]['jumlah']++;
    } else {
        // Jika belum ada, masukkan data baru ke array session
        $keranjang[$id] = [
            'nama_produk' => $produk['nama_produk'],
            'harga'       => $produk['harga'],
            'foto'        => $produk['foto'],
            'jumlah'      => 1
        ];
    }

    session()->set('keranjang', $keranjang);
    return redirect()->back()->with('pesan', $produk['nama_produk'] . ' sukses mendarat di keranjang belanja!');
}

// Menampilkan halaman daftar isi keranjang belanja
public function keranjang()
{
    $data['keranjang'] = session()->get('keranjang') ?? [];
    return view('keranjang_view', $data);
}

// Menghapus salah satu item di dalam keranjang
public function hapusKeranjang($id)
{
    $keranjang = session()->get('keranjang') ?? [];
    if (isset($keranjang[$id])) {
        unset($keranjang[$id]);
        session()->set('keranjang', $keranjang);
    }
    return redirect()->to('/keranjang')->with('pesan', 'Barang berhasil dikeluarkan dari keranjang.');
}

// Fungsi Utama Checkout (CO): Potong Stok Postgres Berdasarkan Isi Keranjang
public function checkout()
{
    $keranjang = session()->get('keranjang') ?? [];
    if (empty($keranjang)) {
        return redirect()->to('/')->with('error', 'Keranjang lu masih kosong melompong, Bree!');
    }

    $produkModel = new ProdukModel();

    // Loop data untuk proses pemotongan stok di database
    foreach ($keranjang as $id => $item) {
        $produkAsli = $produkModel->find($id);
        
        // Proteksi ganda dari ancaman race condition stok habis
        if ($produkAsli['stok'] < $item['jumlah']) {
            return redirect()->to('/keranjang')->with('error', 'Gagal CO! Stok ' . $item['nama_produk'] . ' mendadak tidak mencukupi.');
        }

        // Jalankan kueri UPDATE untuk mengurangi jumlah stok saat ini
        $stokBaru = $produkAsli['stok'] - $item['jumlah'];
        $produkModel->update($id, ['stok' => $stokBaru]);
    }

    // Bersihkan isi keranjang setelah sukses Checkout
    session()->remove('keranjang');

    return redirect()->to('/')->with('pesan', '🔥 CHECKOUT SUKSES! Stok Postgres berhasil dipotong. Selamat berbelanja kembali, Bree!');
    }
}