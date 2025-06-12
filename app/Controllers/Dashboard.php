<?php

namespace App\Controllers;

use App\Controllers\BaseController;
class Dashboard extends BaseController
{
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => base_url('/')],
            ['label' => 'Dashboard', 'url' => ''] // halaman aktif
        ];

        return view('dashboard/index', [
            'breadcrumbs' => $breadcrumbs,
            'pageTitle' => 'Dashboard'
        ]);
    }
}
