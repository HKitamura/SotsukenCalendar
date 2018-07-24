<?php

namespace Fuel\Migrations;

class Create_calendar6s
{
	public function up()
	{
		\DBUtil::create_table('calendar6s', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'Name' => array('constraint' => 255, 'type' => 'varchar'),
			'Year' => array('constraint' => 11, 'type' => 'int'),
			'Month' => array('constraint' => 11, 'type' => 'int'),
			'Day' => array('constraint' => 11, 'type' => 'int'),
			'Hour' => array('constraint' => 11, 'type' => 'int'),
			'Minute' => array('constraint' => 11, 'type' => 'int'),
			'Title' => array('constraint' => 255, 'type' => 'varchar'),
			'Text' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('calendar6s');
	}
}