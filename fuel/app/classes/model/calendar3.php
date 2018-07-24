<?php
use Orm\Model;

class Model_Calendar3 extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'year',
		'month',
		'day',
		'title',
		'naiyou',
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
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('year', 'Year', 'required|max_length[255]');
		$val->add_field('month', 'Month', 'required|max_length[255]');
		$val->add_field('day', 'Day', 'required|max_length[255]');
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('naiyou', 'Naiyou', 'required');

		return $val;
	}

}
