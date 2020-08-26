<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Student extends Migration {
	public function up() {
		$this->forge->addField([
				'id'    			 => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => TRUE,
					'auto_increment' => TRUE
				],
				'first_name'       	 => [
					'type'           => 'VARCHAR',
					'constraint'	 => 30,
					'null'           => FALSE,
				],
				'last_name'       	 => [
					'type'           => 'VARCHAR',
					'constraint'	 => 30,
					'null'           => FALSE,
				],
				'email'       	 	=> [
					'type'           => 'VARCHAR',
					'constraint'	 => 50,
					'null'           => TRUE,
				],
				'pocket_money'    	 => [
					'type'           => 'INT',
					'constraint'     => 10,
					'null'           => TRUE,
				],
				'password'       	 	=> [
					'type'           => 'VARCHAR',
					'constraint'	 => 50,
					'null'           => TRUE,
				],
				'is_deleted'    	 => [
					'type'           => 'TINYINT',
					'constraint'     => 1,
					'null'           => FALSE,
					'default'		=> 0
				],
				'age'    			 => [
					'type'           => 'INT',
					'constraint'     => 3,
				],
				'state'       	 	=> [
					'type'           => 'VARCHAR',
					'constraint'	 => 50,
					'null'           => TRUE,
				],
				'zip'       	 	=> [
					'type'           => 'VARCHAR',
					'constraint'	 => 50,
					'null'           => TRUE,
				],
				'country'       	 	=> [
					'type'           => 'VARCHAR',
					'constraint'	 => 50,
					'null'           => TRUE,
				],


				'created_at datetime default current_timestamp',
				'deleted_at datetime default current_timestamp',
    			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('student');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('student');
	}
}
