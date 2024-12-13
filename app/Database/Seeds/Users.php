<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'fullname' => 'Admin',
                'email'    => 'admin@bukuku.com',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'nohp'     => '08123456789',
                'alamat' => '-',
                'role'     => 'admin',
                'status'   => 'active',
                'created_at' => '2024-11-19 08:08:35',
            ],
            [
                'fullname' => 'User 1',
                'email'    => 'user1@bukuku.com',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'nohp'     => '08123456789',
                'alamat' => '-',
                'role'     => 'user',
                'status'   => 'active',
                'created_at' => '2024-11-20 08:08:35',
            ],
            [
                'fullname' => 'User 2',
                'email'    => 'user2@bukuku.com',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'nohp'     => '08123456789',
                'alamat' => '-',
                'role'     => 'user',
                'status'   => 'active',
                'created_at' => '2024-11-21 08:08:35',
            ],
            [
                'fullname' => 'User 3',
                'email'    => 'user3@bukuku.com',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'nohp'     => '08123456789',
                'alamat' => '-',
                'role'     => 'user',
                'status'   => 'active',
                'created_at' => '2024-11-22 08:08:35',
            ],
            [
                'fullname' => 'User 4',
                'email'    => 'user4@example.com',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'nohp'     => '08123456789',
                'alamat' => '-',
                'role'     => 'user',
                'status'   => 'active',
                'created_at' => '2024-11-22 08:08:35',
            ],
            [
                'fullname' => 'User 5',
                'email'    => 'user5@example.com',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'nohp'     => '08123456789',
                'alamat' => '-',
                'role'     => 'user',
                'status'   => 'active',
                'created_at' => '2024-11-22 08:08:35',
            ],

        ];

        $this->db->table('users')->insertBatch($data);
    }
}
