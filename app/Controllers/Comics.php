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
                    'required' => 'The title field is required.',
                    'is_unique' => 'The comic\'s title must be unique OR similar comic\'s title is already exist.'
                ]
            ],
            'author' => [
                'rules' => 'required[comics.author]',
                'errors' => 'The author field is required.'
            ],
            'publisher' => [
                'rules' => 'required[comics.publisher]',
                'errors' => 'The publisher field is required.'
            ],
            'cover' => [
                'rules' => 'required[comics.cover]',
                'errors' => 'The cover field is required.'
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

    public function delete($id)
    {
        $this->comicsModel->delete($id);
        session()->setFlashdata('Message', 'Data Successfully Deleted.');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Comics',
            'validation' => \config\services::validation(),
            'comics' => $this->comicsModel->getComics($slug)
        ];
        return view('comics/edit', $data);
    }

    public function update($id)
    {
        $oldComics = $this->comicsModel->getComics($this->request->getVar('slug'));
        // if ($oldComics['title'] == $this->request->getVar('title')) {
        //     $title_rule = 'required';
        // } else {
        //     $title_rule = 'required|is_unique[comics.title]';
        // }
        $title_rule = $oldComics['title'] == $this->request->getVar('title') ? 'required' : 'required|is_unique[comics.title]';
        if (!$this->validate([
            'title' => [
                'rules' => $title_rule,
                'errors' => [
                    'required' => 'The title field is required.',
                    'is_unique' => 'The comic\'s title must be unique OR similar comic\'s title is already exist.'
                ]
            ],
            'author' => [
                'rules' => 'required[comics.author]',
                'errors' => 'The author field is required.'
            ],
            'publisher' => [
                'rules' => 'required[comics.publisher]',
                'errors' => 'The publisher field is required.'
            ],
            'cover' => [
                'rules' => 'required[comics.cover]',
                'errors' => 'The cover field is required.'
            ]
        ])) {
            $validation = \config\services::validation();
            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $this->request->getVar('cover')
        ]);
        session()->setFlashdata('Message', 'Data Successfully Updated.');
        return redirect()->to('/comics');
    }
}
