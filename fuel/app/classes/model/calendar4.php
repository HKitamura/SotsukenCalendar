<?php
use Orm\Model;

class Model_Calendar4 extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'year',
		'month',
		'day',
		'time',
		'title',
		'text',
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
		$val->add_field('name', '名前', 'required|max_length[255]');
		$val->add_field('year', '年', 'required|max_length[255]');
		$val->add_field('month', '月', 'required|max_length[255]');
		$val->add_field('day', '日', 'required|max_length[255]');
		$val->add_field('time', '時間', 'required|max_length[255]');
		$val->add_field('title', 'タイトル', 'required|max_length[255]');
		$val->add_field('text', '内容', 'required');

		return $val;
	}

}
