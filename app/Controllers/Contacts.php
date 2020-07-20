<?php

namespace App\Controllers;

use App\Models\ContactsModel;
use CodeIgniter\Validation\Rules;

class Contacts extends BaseController
{
    protected $contactsModel;
    public function __construct()
    {
        $this->contactsModel = new ContactsModel();
    }

    public function index()
    {
        // $pager = \config\services::pager();
        $pager = service('pager');
        $uri = service('uri');

        if (isset($_POST['submit'])) {
            $data['keyword'] = $_POST['keyword'];
            // echo $data['keyword'];
        } else {
            $data['keyword'] = null;
        }

        $data = [
            'title' => 'Contacts List',
            // 'contacts' => $this->contactsModel->getContacts(),
            'contacts' => $this->contactsModel->paginate(8),
            'pager' => $this->contactsModel->pager
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
                'rules' => 'required|is_unique[contacts.name]',
                'errors' => [
                    'required' => 'The name field is required.',
                    'is_unique' => 'The contact\'s name must be unique OR similar contact\'s name is already exist.'
                ]
            ],
            'phone' => [
                'rules' => 'required[contacts.phone]',
                'error' => 'The phone field is required.'
            ],
            'email' => [
                'rules' => 'required[contacts.email]',
                'errors' => 'The email field is required.'
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
        session()->setFlashdata('Message', 'Data Successfully Added.');
        return redirect()->to('/contacts');
    }

    public function delete($id)
    {
        $this->contactsModel->delete($id);
        session()->setFlashdata('Message', 'Data Successfully Deleted.');
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
        $oldcontacts = $this->contactsModel->getContacts($this->request->getVar('slug'));
        $name_rule = $oldcontacts['name'] == $this->request->getVar('name') ? 'required' : 'required|is_unique[contacts.name]';
        if (!$this->validate([
            'name' => [
                'rules' => $name_rule,
                'errors' => [
                    'required' => 'The name field is required.',
                    'is_unique' => 'The contact\'s name must be unique OR similar contact\'s name is already exist.'
                ]
            ],
            'phone' => [
                'rules' => 'required[contacts.phone]',
                'errors' => 'The phone field is required.'
            ],
            'email' => [
                'rules' => 'required[contacts.email]',
                'errors' => 'The email field is required.'
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
        session()->setFlashdata('Message', 'Data Successfully Updated.');
        return redirect()->to('/contacts');
    }
}
