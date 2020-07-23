<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactsTable extends Migration
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
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'phone'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'email' => [
				'type'           => 'TEXT',
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
		$this->forge->createTable('contacts');
	}

	public function down()
	{
		$this->forge->dropTable('contacts');
	}
}
