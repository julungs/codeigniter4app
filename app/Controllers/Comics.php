<?php

namespace App\Controllers;

use App\Models\ComicsModel;
use CodeIgniter\Validation\Rules;

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
            'title' => 'Add Comics List Form',
            'validation' => \config\services::validation()
        ];

        return view('comics/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[comics.title]',
                'errors' => [
                    'required' => '{field} comics title must be filled.',
                    'is_unique' => '{field} comics title was registered'
                ]
            ],
            'author' => [
                'rules' => 'required[comics.author]',
                'errors' => 'required[{field} comics author must be filled.]'

            ],
            'publisher' => [
                'rules' => 'required[comics.publisher]',
                'errors' => 'required[{field} comics publisher must be filled.]'
            ],
            'cover' => [
                'rules' => 'required[comics.cover]',
                'errors' => 'required[{field} comics cover must be filled.]'
            ]
        ])) {
            $validation = \config\services::validation();
            return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
        }
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
