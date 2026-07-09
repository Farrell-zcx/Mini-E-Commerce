<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * ProdukController — Menangani semua operasi CRUD Produk.
 */
class ProdukController extends BaseController
{
    protected ProdukModel $produkModel;
    protected KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->produkModel   = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    /**
     * Menampilkan halaman katalog semua produk.
     */
    public function index(): string
    {
        $data['daftar_produk'] = $this->produkModel->getProdukWithKategori();
        return view('shop_view', $data);
    }

    /**
     * Menampilkan form tambah produk baru.
     */
    public function tambah(): string
    {
        $data['daftar_kategori'] = $this->kategoriModel->findAll();
        return view('tambah_produk_view', $data);
    }

    /**
     * Memproses penyimpanan produk baru ke database.
     */
    public function simpan(): RedirectResponse
    {
        // Validasi input di controller
        $rules = [
            'kategori_id' => 'required|integer',
            'nama_produk' => 'required|min_length[3]|max_length[255]',
            'harga'       => 'required|numeric|greater_than[0]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
            'foto'        => 'is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Proses upload foto
        $fileFoto = $this->request->getFile('foto');
        $namaFoto = 'default.png';

        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(ROOTPATH . 'public/uploads', $namaFoto);
        }

        $this->produkModel->save([
            'kategori_id' => $this->request->getPost('kategori_id'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'foto'        => $namaFoto,
        ]);

        return redirect()->to('/')->with('pesan', 'Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit produk berdasarkan ID.
     */
    public function edit(int $id): string
    {
        $data['produk']          = $this->produkModel->find($id);
        $data['daftar_kategori'] = $this->kategoriModel->findAll();

        return view('edit_produk_view', $data);
    }

    /**
     * Memproses perubahan data produk ke database.
     */
    public function update(int $id): RedirectResponse
    {
        // Validasi input
        $rules = [
            'kategori_id' => 'required|integer',
            'nama_produk' => 'required|min_length[3]|max_length[255]',
            'harga'       => 'required|numeric|greater_than[0]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
            'foto'        => 'is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $produkLama = $this->produkModel->find($id);
        $fileFoto   = $this->request->getFile('foto');
        $namaFoto   = $produkLama['foto'];

        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(ROOTPATH . 'public/uploads', $namaFoto);

            // Hapus foto lama jika bukan default
            if ($produkLama['foto'] && $produkLama['foto'] !== 'default.png') {
                $pathFotoLama = ROOTPATH . 'public/uploads/' . $produkLama['foto'];
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        }

        $this->produkModel->update($id, [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'foto'        => $namaFoto,
        ]);

        return redirect()->to('/')->with('pesan', 'Produk berhasil diperbarui!');
    }

    /**
     * Menghapus produk dari database (via POST).
     */
    public function delete(int $id): RedirectResponse
    {
        $produk = $this->produkModel->find($id);

        // Hapus file foto terkait jika bukan default
        if ($produk && $produk['foto'] && $produk['foto'] !== 'default.png') {
            $pathFoto = ROOTPATH . 'public/uploads/' . $produk['foto'];
            if (file_exists($pathFoto)) {
                unlink($pathFoto);
            }
        }

        $this->produkModel->delete($id);

        return redirect()->to('/')->with('pesan', 'Produk berhasil dihapus.');
    }
}
