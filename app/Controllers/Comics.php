<?php

namespace App\Controllers;

use App\Models\ComicsModel;

class Comics extends BaseController
{
    protected $comicsModel;
    public function __construct()
    {
        $this->comicsModel = new ComicsModel();
    }

    public function index()
    {
        $comics = $this->comicsModel->findAll();

        $data = [
            'title' => 'Comics List',
            'comics' => $comics
        ];

        return view('comics/index', $data);
    }
}
