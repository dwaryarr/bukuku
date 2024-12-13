<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\OrderModel;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $recent_orders = $this->orderModel->getRecentOrders();
        foreach ($recent_orders as &$ro) {
            $customer = $this->userModel->find($ro['user_id']);
            if ($ro['user_id'] == null || $customer == null) {
                $ro['customer_name'] = 'Guest';
                continue;
            }
            $ro['customer_name'] = $customer['fullname'];
        }
        $data = [
            'title' => 'Dashboard Admin',
            'products' => $this->productModel->findAll(),
            'statistics' => [
                'total_sales' => $this->orderModel->getTotalSales()['total'],
                'total_users' => $this->userModel->countAll(),
                'total_orders' => $this->orderModel->countAll(),
                'total_products' => $this->productModel->countAll(),
            ],
            'recent_orders' => $recent_orders,
            'top_products' => $this->productModel->getPopularProducts(5),
        ];
        return view('admin/dashboard', $data);
    }
}
