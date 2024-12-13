<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;


class Order extends Controller
{

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $recent_orders = $this->orderModel->getOrdersByUserId(session()->get('user_id'));
        foreach ($recent_orders as &$ro) {
            $customer = $this->userModel->find($ro['user_id']);
            if ($ro['user_id'] == null || $customer == null) {
                $ro['customer_name'] = 'Guest';
                continue;
            }
            $ro['customer_name'] = $customer['fullname'];
        }
        $data = [
            'title' => 'Riwayat Order',
            // 'orders' => $this->orderModel->findAll(),
            'orders' => $recent_orders,
        ];
        return view('riwayat_order', $data);
    }

    public function detail($order_id)
    {
        $order = $this->orderModel->getOrderById($order_id);
        if ($order['status'] == 0) {
            session()->setFlashdata('warning', 'Silahkan lakukan pembayaran terlebih dahulu');
            return redirect()->to('/pembayaran/' . $order_id);
        }
        $user_id = session()->get('user_id');
        if ($user_id == null || $user_id != $order['user_id']) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->to('/');
        }
        $customer = $this->userModel->find($order['user_id']);
        if ($order['user_id'] == null || $customer == null) {
            $order['customer_name'] = 'Guest';
        } else {
            $order['customer_name'] = $customer['fullname'];
        }
        $order_detail = $this->orderModel->getOrderDetailByOrderId($order_id);
        $data = [
            'title' => '#' . $order_id . ' Order Detail',
            'order' => $order,
            'order_detail' => $order_detail,
        ];
        return view('order_detail', $data);
    }

    public function cart()
    {
        $data = [
            'title' => 'Cart',
            'cart' => session()->get('cart') ?? [],
        ];
        return view('cart', $data);
    }

    public function add_to_cart($product_id)
    {
        if (session()->get('role') == 'admin') {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            session()->remove('cart');
            return redirect()->to('/');
        }
        $data_product = $this->productModel->find($product_id);
        $cart = session()->get('cart') ?? [];
        $product = [
            'id'    => $product_id,
            'name'  => $data_product['name'],
            'image' => $data_product['image'],
            'price' => $data_product['price'],
            'qty'   => ($this->request->getPost('qty') ? $this->request->getPost('qty') : 1),
        ];
        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['qty'] += $product['qty'];
        } else {
            $cart[$product['id']] = $product;
        }
        session()->set('cart', $cart);
        session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang');
        return redirect()->to('/cart');
    }

    // AJAX
    public function update_cart_qty($id)
    {
        $cart = session()->get('cart');
        $cart[$id]['qty'] = $this->request->getPost('qty');
        session()->set('cart', $cart);
        echo 'success';
    }

    public function remove_from_cart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->set('cart', $cart);
        session()->setFlashdata('success', 'Produk dihapus dari keranjang');
        return redirect()->to('/cart');
    }

    public function clear_cart()
    {
        session()->remove('cart');
        session()->setFlashdata('success', 'Keranjang dikosongkan');
        return redirect()->to('/cart');
    }

    public function checkout()
    {
        if (session()->get('role') == 'admin') {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            session()->remove('cart');
            return redirect()->to('/');
        }
        $cart = session()->get('cart');
        if ($cart == null) {
            session()->setFlashdata('error', 'Keranjang kosong');
            return redirect()->to('/cart');
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $this->orderModel->save([
            'user_id' => session()->get('user_id'),
            'total' => $total,
            'bukti_bayar' => null,
            'status_bayar' => 'pending', // Menunggu Pembayaran
            'status' => 0, // Menunggu Pembayaran
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $order_id = $this->orderModel->insertID();
        foreach ($cart as $item) {
            $this->orderModel->insertDetail([
                'order_id' => $order_id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        session()->remove('cart');
        session()->setFlashdata('success', 'Pesanan berhasil dibuat, silahkan lakukan pembayaran');
        return redirect()->to('/pembayaran/' . $order_id);
    }

    public function pembayaran($order_id)
    {
        $order = $this->orderModel->getOrderById($order_id);
        if ($order['status'] != 0) {
            session()->setFlashdata('info', 'Order ID <b>#' . $order_id . '</b> sudah dibayar');
            return redirect()->to('/order-detail/' . $order_id);
        }
        $customer = $this->userModel->find($order['user_id']);
        if ($order['user_id'] == null || $customer == null) {
            $order['customer_name'] = 'Guest';
        } else {
            $order['customer_name'] = $customer['fullname'];
        }
        $data = [
            'title' => 'Pembayaran',
            'order' => $order,
            'order_detail' => $this->orderModel->getOrderDetailByOrderId($order_id),
        ];
        return view('pembayaran', $data);
    }

    public function upload_bukti_bayar($order_id)
    {
        $order = $this->orderModel->getOrderById($order_id);
        if ($order['status'] != 0) {
            session()->setFlashdata('info', 'Order ID <b>#' . $order_id . '</b> sudah dibayar');
            return redirect()->to('/order-detail/' . $order_id);
        }
        $bukti_bayar = $this->request->getFile('bukti_bayar');
        if ($bukti_bayar->isValid() && !$bukti_bayar->hasMoved()) {
            $newName = $bukti_bayar->getRandomName();
            $bukti_bayar->move('assets/images/bukti_bayar', $newName);
            $this->orderModel->update($order_id, [
                'bukti_bayar' => $newName,
                'status_bayar' => 'success',
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            session()->setFlashdata('success', 'Bukti bayar berhasil diupload');
        } else {
            session()->setFlashdata('error', 'Gagal mengupload bukti bayar');
        }
        return redirect()->to('/pembayaran/' . $order_id);
    }


    // Admin
    public function admin_order()
    {
        $orders = $this->orderModel->findAll();
        foreach ($orders as &$o) {
            $customer = $this->userModel->find($o['user_id']);
            if ($o['user_id'] == null || $customer == null) {
                $o['customer_name'] = 'Guest';
                continue;
            }
            $o['customer_name'] = $customer['fullname'];
        }
        $data = [
            'title' => 'Orders',
            'orders' => $orders,
        ];
        return view('admin/orders/list', $data);
    }

    public function admin_order_detail($order_id)
    {
        $order = $this->orderModel->getOrderById($order_id);
        $customer = $this->userModel->find($order['user_id']);
        if ($order['user_id'] == null || $customer == null) {
            $order['customer_name'] = 'Guest';
        } else {
            $order['customer_name'] = $customer['fullname'];
        }
        $order_detail = $this->orderModel->getOrderDetailByOrderId($order_id);
        $data = [
            'title' => '#' . $order_id . ' Order Detail',
            'order' => $order,
            'order_detail' => $order_detail,
        ];
        return view('admin/orders/detail', $data);
    }

    public function admin_delete_order($order_id)
    {
        $order = $this->orderModel->find($order_id);
        if ($order == null) {
            session()->setFlashdata('error', 'Order ID <b>#' . $order_id . '</b> tidak ditemukan');
            return redirect()->to('/admin/orders');
        }
        if (($order['bukti_bayar'] != null) && ($order['bukti_bayar'] != 'default_buktibayar.png')) {
            unlink('assets/images/bukti_bayar/' . $order['bukti_bayar']);
        }
        $this->orderModel->deleteDetail($order_id);
        $this->orderModel->delete($order_id);
        session()->setFlashdata('success', 'Order ID <b>#' . $order_id . '</b> berhasil dihapus');
        return redirect()->to('/admin/orders');
    }
}
