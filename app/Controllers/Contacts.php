<?php

namespace App\Controllers;

use App\Models\ContactsModel;

class Contacts extends BaseController
{
    protected $contactsModel;
    public function __construct()
    {
        $this->contactsModel = new ContactsModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $contacts = $this->contactsModel->searchContacts($keyword);
        } else {
            $contacts = $this->contactsModel;
        }
        $perPage = 5;
        $group = 'contacts';
        $currentPage = $this->request->getVar('page_contacts') ? $this->request->getVar('page_contacts') : 1;
        $pagination = 'contactsPagination';
        $data = [
            'title' => 'Contacts List',
            // 'contacts' => $this->contactsModel->getContacts(),
            'contacts' => $contacts->paginate($perPage, $group),
            'pager' => $contacts->pager,
            'perPage' => $perPage,
            'group' => $group,
            'currentPage' => $currentPage,
            'pagination' => $pagination
        ];
        return view('contacts/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Contact Detail',
            'contacts' => $this->contactsModel->getContacts($slug)
        ];
        return view('contacts/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Contacts List Form',
            'validation' => \config\services::validation()
        ];
        return view('contacts/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required[contacts.name]',
                'errors' => 'The name field is required.',
            ],
            'phone' => [
                'rules' => 'required[contacts.phone]|min_length[12]|max_length[14]',
                'errors' => [
                    'The phone field is required.',
                    'The minimum length is 12 characters.',
                    'The maximum length is 14 characters.'
                ]
            ],
            'email' => [
                'rules' => 'required[contacts.email]|valid_email[contacts.email]',
                'errors' => [
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email is invalid.'
                ]
            ]
        ])) {
            return redirect()->to('/contacts/create')->withInput();
        }
        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->contactsModel->save([
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'phone' => $this->request->getVar('phone'),
            'email' => $this->request->getVar('email'),
        ]);
        session()->setFlashdata('Message', 'ADDED.');
        return redirect()->to('/contacts' . '/' . $slug);
    }

    public function delete($id)
    {
        $this->contactsModel->delete($id);
        session()->setFlashdata('Message', 'DELETED.');
        return redirect()->to('/contacts');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit contacts',
            'validation' => \config\services::validation(),
            'contacts' => $this->contactsModel->getContacts($slug)
        ];
        return view('contacts/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required[contacts.name]',
                'errors' => 'The name field is required.',
            ],
            'phone' => [
                'rules' => 'required[contacts.phone]|min_length[12]|max_length[14]',
                'errors' => [
                    'The phone field is required.',
                    'The minimum length is 12 characters.',
                    'The maximum length is 14 characters.'
                ]
            ],
            'email' => [
                'rules' => 'required[contacts.email]|valid_email[contacts.email]',
                'errors' => [
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email is invalid.'
                ]
            ]
        ])) {
            return redirect()->to('/contacts/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->contactsModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'phone' => $this->request->getVar('phone'),
            'email' => $this->request->getVar('email'),
        ]);
        session()->setFlashdata('Message', 'UPDATED.');
        return redirect()->to('/contacts' . '/' . $slug);
    }
}
