<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactsModel extends Model
{
    protected $table = 'contacts';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'phone', 'email'];

    public function getContacts($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function searchContacts($keyword)
    {
        return $this->table('contacts')->like('email', '%' . $keyword . '%');
    }
}
