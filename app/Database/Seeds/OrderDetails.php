<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrderDetails extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'order_id' => '1',
                'product_id' => '1',
                'quantity' => '1',
                'price' => '350000.00',
                'created_at' => '2024-12-11 21:45:02',
                'updated_at' => null
            ],
            [
                'id' => '2',
                'order_id' => '2',
                'product_id' => '8',
                'quantity' => '2',
                'price' => '550000.00',
                'created_at' => '2024-12-11 21:45:39',
                'updated_at' => null
            ],
            [
                'id' => '3',
                'order_id' => '3',
                'product_id' => '5',
                'quantity' => '1',
                'price' => '600000.00',
                'created_at' => '2024-12-11 21:46:04',
                'updated_at' => null
            ],
            [
                'id' => '4',
                'order_id' => '3',
                'product_id' => '2',
                'quantity' => '1',
                'price' => '150000.00',
                'created_at' => '2024-12-11 21:46:04',
                'updated_at' => null
            ],
            [
                'id' => '5',
                'order_id' => '4',
                'product_id' => '6',
                'quantity' => '3',
                'price' => '250000.00',
                'created_at' => '2024-12-11 21:46:39',
                'updated_at' => null
            ],
            [
                'id' => '6',
                'order_id' => '4',
                'product_id' => '10',
                'quantity' => '1',
                'price' => '1500000.00',
                'created_at' => '2024-12-11 21:46:39',
                'updated_at' => null
            ],
            [
                'id' => '7',
                'order_id' => '5',
                'product_id' => '3',
                'quantity' => '1',
                'price' => '725000.00',
                'created_at' => '2024-12-11 21:46:47',
                'updated_at' => null
            ],
            [
                'id' => '8',
                'order_id' => '6',
                'product_id' => '9',
                'quantity' => '1',
                'price' => '550000.00',
                'created_at' => '2024-12-11 21:46:57',
                'updated_at' => null
            ],
            [
                'id' => '9',
                'order_id' => '7',
                'product_id' => '7',
                'quantity' => '1',
                'price' => '165000.00',
                'created_at' => '2024-12-11 21:51:48',
                'updated_at' => null
            ],
            [
                'id' => '10',
                'order_id' => '8',
                'product_id' => '6',
                'quantity' => '10',
                'price' => '250000.00',
                'created_at' => '2024-12-11 21:52:09',
                'updated_at' => null
            ],
            [
                'id' => '11',
                'order_id' => '9',
                'product_id' => '8',
                'quantity' => '2',
                'price' => '550000.00',
                'created_at' => '2024-12-11 21:55:48',
                'updated_at' => null
            ]
        ];
        $this->db->table('order_details')->insertBatch($data);
    }
}
