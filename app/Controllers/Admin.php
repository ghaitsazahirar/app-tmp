<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    // TAMPILKAN SEMUA ADMIN KE DASHBOARD
    public function index()
    {
        $admins = $this->adminModel->findAll();
        $breadcrumbs = [
        ['label' => 'Home', 'url' => base_url('/')],
        ['label' => 'Admin', 'url' => ''] 
        ];

        return view('admin/index', [
        'admins' => $admins,
        'breadcrumbs' => $breadcrumbs,
        'pageTitle' => 'Data Admin'
        ]);
    }

    // SIMPAN ADMIN BARU
    public function store()
    {
        $data = $this->request->getPost();

        if (empty($data['name']) || empty($data['email'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Semua field wajib diisi'])->setStatusCode(400);
        }

        $this->adminModel->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    // AMBIL DATA ADMIN BERDASARKAN ID (UNTUK EDIT)
    public function edit($id)
    {
        $admin = $this->adminModel->find($id);
        if (!$admin) {
            return $this->response->setJSON(['message' => 'Admin tidak ditemukan'])->setStatusCode(404);
        }

        return $this->response->setJSON($admin);
    }

    // UPDATE ADMIN
    public function update($id)
    {
        $data = $this->request->getPost();

        $admin = $this->adminModel->find($id);
        if (!$admin) {
            return $this->response->setJSON(['message' => 'Admin tidak ditemukan'])->setStatusCode(404);
        }

        $updateData = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $this->adminModel->update($id, $updateData);

        return $this->response->setJSON(['status' => 'success']);
    }

    // HAPUS ADMIN
    public function delete($id)
    {
        $admin = $this->adminModel->find($id);
        if (!$admin) {
            return $this->response->setJSON(['message' => 'Admin tidak ditemukan'])->setStatusCode(404);
        }

        $this->adminModel->delete($id);

        return $this->response->setJSON(['status' => 'deleted']);
    }
}
