<?php

namespace Fuel\Migrations;

class Create_yoteitoukous
{
	public function up()
	{
		\DBUtil::create_table('yoteitoukous', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'body' => array('constraint' => 255, 'type' => 'varchar'),
			'ip' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('yoteitoukous');
	}
}