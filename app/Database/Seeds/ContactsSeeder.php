<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class ContactsSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'name' => 'alpha',
        //         'phone' => '081234567890',
        //         'email' => 'alpha@theempire.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ], [
        //         'name' => 'beta',
        //         'phone' => '081234567890',
        //         'email' => 'beta@theempire.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ], [
        //         'name' => 'charlie',
        //         'phone' => '081234567890',
        //         'email' => 'charlie@theempire.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ]
        // ];



        // fzaninotto/Faker
        $faker = \Faker\Factory::create('ms_MY');
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'name' => $faker->name,
                'phone' => $faker->e164PhoneNumber,
                'email' => $faker->safeEmail,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
            $this->db->table('contacts')->insert($data);
        }


        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO contacts (name, phone, email, created_at, updated_at) VALUES(:name:, :phone:, :email:, :created_at:, :updated_at:)",
        //     $data
        // );

        // Using Query Builder
        // For one data
        // $this->db->table('contacts')->insert($data);
        // For many data
        // $this->db->table('contacts')->insertBatch($data);
    }
}
