<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'products' => $this->productModel->findAll(),
        ];
        return view('home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami',
        ];
        return view('about', $data);
    }
}
