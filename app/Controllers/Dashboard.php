<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
class Dashboard extends BaseController
{
    public function index()
    {
        $adminModel = new AdminModel();
        $admins = $adminModel->findAll(); 
        return view('admin/index', ['admins' => $admins]);
    }
}
