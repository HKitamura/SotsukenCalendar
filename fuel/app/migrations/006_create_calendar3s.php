<?php

namespace Fuel\Migrations;

class Create_calendar3s
{
	public function up()
	{
		\DBUtil::create_table('calendar3s', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'Name' => array('constraint' => 255, 'type' => 'varchar'),
			'Year' => array('constraint' => 255, 'type' => 'varchar'),
			'Month' => array('constraint' => 255, 'type' => 'varchar'),
			'Day' => array('constraint' => 255, 'type' => 'varchar'),
			'Title' => array('constraint' => 255, 'type' => 'varchar'),
			'naiyou' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('calendar3s');
	}
}