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
        $data = [
            'title' => 'Comics List',
            'comics' => $this->comicsModel->getComics()
        ];

        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Comic Detail',
            'comics' => $this->comicsModel->getComics($slug)
        ];

        // if (empty($data['comics'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Comics ' . $slug . ' not found.');
        // }

        return view('comics/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Comics List Form'
        ];

        return view('comics/create', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $this->request->getVar('cover')
        ]);

        session()->setFlashdata('Message', 'Data Successfully Added.');

        return redirect()->to('/comics');
    }
}
