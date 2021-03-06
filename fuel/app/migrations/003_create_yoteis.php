<?php

namespace Fuel\Migrations;

class Create_yoteis
{
	public function up()
	{
		\DBUtil::create_table('yoteis', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'hinichi' => array('type' => 'date'),
			'name' => array('constraint' => 20, 'type' => 'varchar'),
			'title' => array('constraint' => 50, 'type' => 'varchar'),
			'body' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('yoteis');
	}
}