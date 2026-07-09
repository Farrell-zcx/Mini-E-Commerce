<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * AuthFilter — Middleware untuk memproteksi route yang butuh login.
 *
 * Jika user belum memiliki session 'isLoggedIn', maka akan
 * di-redirect ke halaman login.
 */
class AuthFilter implements FilterInterface
{
    /**
     * Cek session sebelum request diproses controller.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    /**
     * Tidak ada proses setelah response.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah response
    }
}
