<?php
use Orm\Model;

class Model_Yotei extends Model
{
	protected static $_properties = array(
		'id',
		'hinichi',
		'name',
		'title',
		'body',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('hinichi', 'Hinichi', 'required');
		$val->add_field('name', 'Name', 'required|max_length[20]');
		$val->add_field('title', 'Title', 'required|max_length[50]');
		$val->add_field('body', 'Body', 'required');

		return $val;
	}

}
