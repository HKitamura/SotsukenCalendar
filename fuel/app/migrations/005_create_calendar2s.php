<?php

namespace Fuel\Migrations;

class Create_calendar2s
{
	public function up()
	{
		\DBUtil::create_table('calendar2s', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'date' => array('type' => 'date'),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'naiyou' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('calendar2s');
	}
}