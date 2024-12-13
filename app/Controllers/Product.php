<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Semua Produk',
            'products' => $this->productModel->findAll(),
        ];
        return view('product/index', $data);
    }

    public function detail($product_id)
    {
        $data = [
            'title' => 'Detail Produk',
            'product' => $this->productModel->where('id', $product_id)->first(),
            'related_products' => $this->productModel->where('id !=', $product_id)->limit(4)->findAll(),
        ];
        return view('product/detail', $data);
    }

    public function popular()
    {
        $data = [
            'title' => 'Produk Terlaris',
            'products' => $this->productModel->getPopularProducts(),
        ];
        return view('product/index', $data);
    }

    public function new_arrivals()
    {
        $data = [
            'title' => 'Produk Terbaru',
            'products' => $this->productModel->getNewArrivals(),
        ];
        return view('product/index', $data);
    }

    public function products()
    {
        $data = [
            'title' => 'Produk',
            'products' => $this->productModel->getAllProducts(),
        ];
        return view('admin/products/list', $data);
    }

    public function add_product()
    {
        $data = [
            'title' => 'Tambah Produk',
            'categories' => $this->productModel->findAllCategories(),
        ];
        return view('admin/products/add', $data);
    }

    public function store()
    {
        if (!$this->validate(array_merge($this->productModel->validationRules, [
            'image' => [
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'is_image' => 'Yang anda upload bukan gambar',
                    'mime_in' => 'Gambar harus berformat jpg/jpeg/png',
                ],
            ],
        ]), $this->productModel->validationMessages)) {
            session()->setFlashdata('error', implode('<br>', $this->validator->getErrors()));
            return redirect()->to('/admin/product/add');
        }

        $img = $this->request->getFile('image');
        $newName = $img->getRandomName();
        $img->move(FCPATH . 'assets/images/products', $newName);

        $this->productModel->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'discount' => $this->request->getPost('discount'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $newName,
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'Produk berhasil ditambahkan');
        return redirect()->to('/admin/products');
    }

    public function edit_product($product_id)
    {
        $data = [
            'title' => 'Edit Produk',
            'product' => $this->productModel->find($product_id),
            'categories' => $this->productModel->findAllCategories(),
        ];
        return view('admin/products/edit', $data);
    }

    public function update_product($product_id)
    {
        $rules = $this->productModel->validationRules;
        $rules['image'] = [
            'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Harus ada file gambar produk yang diupload',
                'is_image' => 'Yang anda upload bukan gambar',
                'mime_in' => 'Gambar harus berformat jpg/jpeg/png',
            ],
        ];
        $messages = $this->productModel->validationMessages;

        if (!$this->validate($rules, $messages)) {
            session()->setFlashdata('error', implode('<br>', $this->validator->getErrors()));
            return redirect()->to('/admin/product/edit/' . $product_id);
        }

        $product = $this->productModel->find($product_id);
        $img = $this->request->getFile('image');
        if ($img->isValid()) {
            if ($product['image'] != 'default.jpg') {
                unlink(FCPATH . 'assets/images/products/' . $product['image']);
            }
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'assets/images/products', $newName);
        } else {
            $newName = $product['image'];
        }

        $this->productModel->save([
            'id' => $product_id,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'discount' => $this->request->getPost('discount'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $newName,
            'status' => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('success', 'Produk berhasil diperbarui');
        return redirect()->to('/admin/product/edit/' . $product_id);
    }

    public function delete_product($product_id)
    {
        $product = $this->productModel->find($product_id);
        if ($product['image'] != 'default.jpg') {
            unlink(FCPATH . 'assets/images/products/' . $product['image']);
        }
        $this->productModel->delete($product_id);
        session()->setFlashdata('success', 'Produk berhasil dihapus');
        return redirect()->to('/admin/products');
    }

    public function categories()
    {
        $data = [
            'title' => 'Kategori',
            'categories' => $this->productModel->findAllCategories(),
        ];
        return view('admin/category/list', $data);
    }

    public function add_category()
    {
        $this->productModel->insertCategory([
            'category' => $this->request->getPost('category'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        session()->setFlashdata('success', 'Category "' . $this->request->getPost('category') . '" berhasil ditambahkan');
        return redirect()->to('/admin/categories');
    }

    public function update_category($category_id)
    {
        $this->productModel->updateCategory([
            'id' => $category_id,
            'category' => $this->request->getPost('category'),
        ]);
        session()->setFlashdata('success', 'Category berhasil diperbarui');
        return redirect()->to('/admin/categories');
    }
}
