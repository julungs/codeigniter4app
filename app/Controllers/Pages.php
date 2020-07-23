<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
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

    //--------------------------------------------------------------------

}
