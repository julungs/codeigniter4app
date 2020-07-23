<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToComics extends Migration
{
	public function up()
	{
		$this->forge->addColumn('comics', [
			'deleted_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
	}

	public function down()
	{
		$this->forge->dropColumn('comics', 'deleted_at');
	}
}
