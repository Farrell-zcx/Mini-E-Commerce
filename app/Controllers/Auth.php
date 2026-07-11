<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Auth: register, login, dan logout user.
 */
class Auth extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Menampilkan halaman form register.
     */
    public function register(): string
    {
        return view('register_view');
    }

    /**
     * Memproses data pendaftaran akun baru.
     */
    public function simpanRegister(): RedirectResponse
    {
        // Validasi input
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $passwordHash = password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        );

        $this->userModel->insert([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'password'     => $passwordHash,
            'role'         => 'customer',
        ]);

        return redirect()->to('/login')->with('pesan', 'Akun berhasil dibuat! Silakan login.');
    }

    /**
     * Menampilkan halaman form login.
     */
    public function login(): string
    {
        return view('login_view');
    }

    /**
     * Memproses verifikasi login dan pembuatan session.
     */
    public function prosesLogin(): RedirectResponse
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email belum terdaftar di sistem.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password yang Anda masukkan salah.');
        }

        session()->set([
            'isLoggedIn'   => true,
            'user_id'      => $user['id'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role'         => $user['role'],
        ]);

        return redirect()->to('/')->with('pesan', 'Halo ' . $user['nama_lengkap'] . ', selamat datang kembali!');
    }

    /**
     * Memproses logout dan menghancurkan session.
     */
    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/login')->with('pesan', 'Berhasil keluar. Sampai jumpa lagi!');
    }
}