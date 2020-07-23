<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToContacts extends Migration
{
	public function up()
	{
		$this->forge->addColumn('contacts', [
			'deleted_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
	}

	public function down()
	{
		$this->forge->dropColumn('contacts', 'deleted_at');
	}
}
