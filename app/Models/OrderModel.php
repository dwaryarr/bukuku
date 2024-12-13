<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'total',
        'bukti_bayar',
        'status_bayar',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;

    public function getOrderById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getOrderDetailByOrderId($orderId)
    {
        $query = 'SELECT od.id,order_id,product_id,quantity,od.price,p.name as product,p.description,p.image,pc.category FROM order_details od, products p,product_categories pc WHERE od.product_id=p.id AND p.category_id=pc.id AND order_id=' . $orderId;
        return $this->db->query($query)->getResultArray();
    }

    public function getOrdersByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getTotalSales()
    {
        return $this->selectSum('total')->first();
    }

    public function getRecentOrders($limit = NULL)
    {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }

    public function insertDetail($data)
    {
        return $this->db->table('order_details')->insert($data);
    }

    public function deleteDetail($orderId)
    {
        return $this->db->table('order_details')->where('order_id', $orderId)->delete();
    }
}
