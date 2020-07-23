<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateComicsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'author'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'publisher' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'cover' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => true
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true
			]

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('comics');
	}

	public function down()
	{
		$this->forge->dropTable('comics');
	}
}
