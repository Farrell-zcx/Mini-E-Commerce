<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    // Menampilkan Halaman Form Register
    public function register()
    {
        return view('register_view');
    }

    // Memproses Data Pendaftaran Akun
    public function simpanRegister()
    {
        $userModel = new UserModel();

        // Ambil data dari inputan form
        $nama     = $this->request->getPost('nama_lengkap');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cek apakah email sudah pernah terdaftar (Validasi Manual Simpel)
        $userLama = $userModel->where('email', $email)->first();
        if ($userLama) {
            return redirect()->back()->with('error', 'Waduh, email ini sudah terdaftar, Bree! Pakai email lain.');
        }

        // Enkripsi password polosan menjadi Hash Aman
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Tembak data ke database MySQL
        $userModel->save([
            'nama_lengkap' => $nama,
            'email'        => $email,
            'password'     => $passwordHash, // Yang disimpan adalah versi kode acak
            'role'         => 'customer'     // Otomatis terdaftar sebagai pembeli
        ]);

        return redirect()->to('/login')->with('pesan', 'Akun lu sukses dibuat, Bree! Silakan login.');
    }

    // Menampilkan Halaman Form Login
public function login()
{
    return view('login_view');
}

// Memproses Logika Verifikasi Akun & Pembuatan Session
public function prosesLogin()
{
    $userModel = new \App\Models\UserModel();

    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Cari data user di MySQL berdasarkan email
    $user = $userModel->where('email', $email)->first();

    if ($user) {
        // Verifikasi password ketikan user dengan password terenkripsi di DB
        if (password_verify($password, $user['password'])) {
            
            // Jika password COCOK, buat tanda pengenal (Session) di browser
            session()->set([
                'isLoggedIn'   => true,
                'user_id'      => $user['id'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'         => $user['role']
            ]);

            // Tendang ke halaman utama dengan pesan sukses
            return redirect()->to('/')->with('pesan', 'Halo ' . $user['nama_lengkap'] . ', selamat datang kembali, Bree!');
        } else {
            // Jika password salah
            return redirect()->back()->with('error', 'Waduh, password lu salah, Bree!');
        }
    } else {
        // Jika email tidak ditemukan
        return redirect()->back()->with('error', 'Email belum terdaftar di sistem, Bree!');
    }
}

// Memproses Fungsi Logout 
public function logout()
{
    session()->destroy();
    return redirect()->to('/login')->with('pesan', 'Sukses keluar akun. Sampai jumpa lagi, Bree!');
    }

}