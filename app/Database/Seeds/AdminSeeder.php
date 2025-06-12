<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Admin Satu',
                'email' => 'admin1@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
        ];

        foreach ($data as $admin) {
            $this->db->table('admins')->insert($admin);
        }

        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $this->db->table('admins')->insert([
                'name'     => $faker->name,
                'email'    => $faker->unique()->email,
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ]);
        }
    }
}
