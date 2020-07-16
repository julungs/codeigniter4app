<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        // fzaninotto/Faker
        // $faker = \Faker\Factory::create('id_ID');
        // dd($faker->name);
        // fzaninotto/Faker
        $data = [
            'title' => 'Home | JS'
        ];
        return view('Pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        return view('Pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl Kebenaran',
                    'kota' => 'Madinah'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl Peradaban',
                    'kota' => 'Madinah'
                ]
            ]
        ];
        return view('Pages/contact', $data);
    }

    //--------------------------------------------------------------------

}
