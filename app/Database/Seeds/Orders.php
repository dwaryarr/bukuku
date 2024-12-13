<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Orders extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'user_id' => '2',
                'total' => '350000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '2',
                'created_at' => '2024-12-11 21:45:02',
                'updated_at' => '2024-12-11 21:45:02'
            ],
            [
                'id' => '2',
                'user_id' => '2',
                'total' => '1100000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '2',
                'created_at' => '2024-12-11 21:45:39',
                'updated_at' => '2024-12-11 21:45:39'
            ],
            [
                'id' => '3',
                'user_id' => '2',
                'total' => '750000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '1',
                'created_at' => '2024-12-11 21:46:04',
                'updated_at' => '2024-12-11 21:46:04'
            ],
            [
                'id' => '4',
                'user_id' => '3',
                'total' => '2250000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '2',
                'created_at' => '2024-12-11 21:46:39',
                'updated_at' => '2024-12-11 21:46:39'
            ],
            [
                'id' => '5',
                'user_id' => '3',
                'total' => '725000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '2',
                'created_at' => '2024-12-11 21:46:47',
                'updated_at' => '2024-12-11 21:46:47'
            ],
            [
                'id' => '6',
                'user_id' => '3',
                'total' => '550000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '2',
                'created_at' => '2024-12-11 21:46:57',
                'updated_at' => '2024-12-11 21:46:57'
            ],
            [
                'id' => '7',
                'user_id' => '3',
                'total' => '165000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'success',
                'status' => '1',
                'created_at' => '2024-12-11 21:51:48',
                'updated_at' => '2024-12-11 21:51:48'
            ],
            [
                'id' => '8',
                'user_id' => '3',
                'total' => '2500000',
                'bukti_bayar' => 'default_buktibayar.png',
                'status_bayar' => 'pending',
                'status' => '0',
                'created_at' => '2024-12-11 21:52:09',
                'updated_at' => '2024-12-11 21:52:09'
            ],
            [
                'id' => '9',
                'user_id' => '2',
                'total' => '1100000',
                'bukti_bayar' => null,
                'status_bayar' => 'pending',
                'status' => '0',
                'created_at' => '2024-12-11 21:55:48',
                'updated_at' => '2024-12-11 21:55:48'
            ]
        ];
        $this->db->table('orders')->insertBatch($data);
    }
}
