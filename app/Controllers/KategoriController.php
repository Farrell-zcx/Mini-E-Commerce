<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * KategoriController — Menangani operasi CRUD Kategori.
 */
class KategoriController extends BaseController
{
    protected KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    /**
     * Memproses penyimpanan kategori baru ke database.
     */
    public function simpan(): RedirectResponse
    {
        $rules = [
            'nama_kategori' => 'required|min_length[2]|max_length[100]|is_unique[kategori.nama_kategori]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ]);

        return redirect()->back()->with('pesan', 'Kategori "' . $this->request->getPost('nama_kategori') . '" berhasil ditambahkan!');
    }
}
