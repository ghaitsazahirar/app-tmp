<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        // Tampilkan halaman login
        return view('login/index');
    }

 
    public function login()
    {
        $session = session();
        $adminModel = new AdminModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $adminModel->where('email', $email)->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                // login sukses, simpan data ke session
                $session->set([
                    'admin_id' => $admin['id'],
                    'admin_name' => $admin['email'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('success', 'Logout berhasil');
    }
}
