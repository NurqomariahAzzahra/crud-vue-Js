<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Data Mahasiswa';
        $data['mahasiswa'] = array(
            'nim' => '1915101010',
            'nama' => 'Nurqomariah Azzahra'
        );
        return view('admin.beranda', compact('title', 'data'));
    }

    public function dasboard()
    {
        $title = 'Data Dashboard';
        return view('admin.dasboard', compact('title'));
    }
}
