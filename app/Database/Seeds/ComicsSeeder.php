<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class ComicsSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'name' => 'alpha',
        //         'slug' => 'alpha',
        //         'phone' => '081234567890',
        //         'email' => 'alpha@theempire.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ], [
        //         'name' => 'beta',
        //         'slug' => 'beta',
        //         'phone' => '081234567890',
        //         'email' => 'beta@theempire.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ]
        // ];



        // fzaninotto/Faker
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 50; $i++) {
            $title = $faker->name;
            $slug = url_title($title, '-', true);
            $data = [
                'title' => $title,
                'slug' => $slug,
                'author' => $faker->nik,
                'publisher' => $faker->name,
                'cover' => 'FishIn.jpeg',
                'created_at' => Time::now(),
                // 'updated_at' => Time::now(),
                // 'deleted_at' => Time::now(),
            ];
            $this->db->table('comics')->insert($data);
        }


        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO contacts (name, slug, phone, email, created_at, updated_at) VALUES(:name:, :slug:, :phone:, :email:, :created_at:, :updated_at:)",
        //     $data
        // );


        // Using Query Builder
        // For one data
        // $this->db->table('contacts')->insert($data);
        // For many data
        // $this->db->table('contacts')->insertBatch($data);
    }
}
