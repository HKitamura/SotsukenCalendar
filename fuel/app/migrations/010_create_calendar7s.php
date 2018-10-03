<?php

namespace Fuel\Migrations;

class Create_calendar7s
{
	public function up()
	{
		\DBUtil::create_table('calendar7s', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'year' => array('constraint' => 11, 'type' => 'int'),
			'month' => array('constraint' => 11, 'type' => 'int'),
			'day' => array('constraint' => 11, 'type' => 'int'),
			'hour' => array('constraint' => 11, 'type' => 'int'),
			'minute' => array('constraint' => 11, 'type' => 'int'),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'text' => array('type' => 'text'),
			'user' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('calendar7s');
	}
}