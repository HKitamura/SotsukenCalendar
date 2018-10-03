<?php

namespace Fuel\Migrations;

class Add_finishhour_and_finishminute_to_attachment
{
	public function up()
	{
		\DBUtil::add_fields('attachment', array(
			'finishhour' => array('constraint' => 11, 'type' => 'int'),
			'finishminute' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('attachment', array(
			'finishhour'
,			'finishminute'

		));
	}
}