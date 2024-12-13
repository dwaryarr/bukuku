<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'image', 'stock', 'discount', 'category_id', 'created_at', 'updated_at'];

    // Optionally, you can add validation rules
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'required',
        'price' => 'required|decimal',
        'category_id' => 'required|integer'
    ];

    // Optionally, you can add validation messages
    protected $validationMessages = [
        'name' => [
            'required' => 'Product name is required',
            'min_length' => 'Product name must be at least 3 characters long',
            'max_length' => 'Product name cannot exceed 255 characters'
        ],
        'description' => [
            'required' => 'Product description is required'
        ],
        'price' => [
            'required' => 'Product price is required',
            'decimal' => 'Product price must be a valid decimal number'
        ],
        'category_id' => [
            'required' => 'Category ID is required',
            'integer' => 'Category ID must be an integer'
        ]
    ];

    public function getAllProducts()
    {
        return $this->select('products.*, product_categories.category')
            ->join('product_categories', 'products.category_id = product_categories.id')
            ->findAll();
    }

    public function getPopularProducts($limit = NULL)
    {
        return $this->where('stock >', 0)
            ->orderBy('sold', 'DESC')
            ->findAll($limit);
    }

    public function getNewArrivals()
    {
        return $this->where('stock >', 0)
            ->where('created_at >', date('Y-m-d', strtotime('-7 days')))
            ->findAll();
    }

    // Categories
    public function findAllCategories()
    {
        return $this->db->table('product_categories')->get()->getResultArray();
    }

    public function insertCategory($data)
    {
        return $this->db->table('product_categories')->insert($data);
    }

    public function updateCategory($data)
    {
        return $this->db->table('product_categories')->where('id', $data['id'])->update($data);
    }
}
