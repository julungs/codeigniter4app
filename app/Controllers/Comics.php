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
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $comics = $this->comicsModel->searchComics($keyword);
        } else {
            $comics = $this->comicsModel;
        }
        $perPage = 5;
        $group = 'comics';
        $currentPage = $this->request->getVar('page_comics') ? $this->request->getVar('page_comics') : 1;
        $pagination = 'comicsPagination';
        $data = [
            'title' => 'Comics List',
            // 'comics' => $comics->getComics(),
            'comics' => $comics->paginate($perPage, $group),
            'pager' => $comics->pager,
            'perPage' => $perPage,
            'group' => $group,
            'currentPage' => $currentPage,
            'pagination' => $pagination
        ];
        return view('Comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Comic Detail',
            'comic' => $this->comicsModel->getComics($slug)
        ];
        return view('Comics/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Comics List Form',
            'validation' => \config\services::validation()
        ];
        return view('Comics/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required[comics.title]|is_unique[comics.title]',
                'errors' => [
                    'required' => 'The title field is required.',
                    'is_unique' => 'The comic\'s title must be unique OR similar comic\'s title is already exist.'
                ]
            ],
            'author' => [
                'rules' => 'required[comics.author]',
                'error' => 'The author field is required.'
            ],
            'publisher' => [
                'rules' => 'required[comics.publisher]',
                'errors' => 'The publisher field is required.'
            ],
            'cover' => [
                'rules' => 'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => 'The image file size is too big',
                    'is_image' => 'The choosen file is not an image',
                    'mime_in' => 'The choosen file is not an image'
                ]
            ]
        ])) {
            return redirect()->to('/comics/create')->withInput();
        }
        $coverFile = $this->request->getFile('cover');
        if ($coverFile->getError() == 4) {
            $coverTitle = 'FishIn.jpeg';
        } else {
            $coverTitle = $coverFile->getRandomName();
            $coverFile->move('img', $coverTitle);
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $coverTitle
        ]);
        session()->setFlashdata('Message', 'ADDED.');
        return redirect()->to('/comics' . '/' . $slug);
    }

    public function delete($id)
    {
        $comics = $this->comicsModel->find($id);
        if ($comics['cover'] != 'FishIn.jpeg') {
            unlink('img/' . $comics['cover']);
        }
        $this->comicsModel->delete($id);
        session()->setFlashdata('Message', 'DELETED.');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Comics',
            'validation' => \config\services::validation(),
            'comic' => $this->comicsModel->getComics($slug)
        ];
        return view('Comics/edit', $data);
    }

    public function update($id)
    {
        $oldComics = $this->comicsModel->getComics($this->request->getVar('slug'));
        $title_rule = $oldComics['title'] == $this->request->getVar('title') ? 'required[comics.title]' : 'required[comics.title]|is_unique[comics.title]';
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
                'rules' => 'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => 'The image file size is too big',
                    'is_image' => 'The choosen file is not an image',
                    'mime_in' => 'The choosen file is not an image'
                ]
            ]
        ])) {
            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $coverFile = $this->request->getFile('cover');
        $oldCover = $this->request->getVar('oldCover');
        if ($coverFile->getError() == 4) {
            $coverTitle = $oldCover;
        } else {
            $coverTitle = $coverFile->getRandomName();
            $coverFile->move('img', $coverTitle);
            if ($oldCover != 'FishIn.jpeg') {
                unlink('img/' . $oldCover);
            }
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $coverTitle
        ]);
        session()->setFlashdata('Message', 'UPDATED.');
        return redirect()->to('/comics' . '/' . $slug);
    }
}
