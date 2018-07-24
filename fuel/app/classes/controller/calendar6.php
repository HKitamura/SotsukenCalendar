<?php
class Controller_calendar6 extends Controller_Template
{
	public function action_index()
	{
		if (Auth::check()) {	
			$data['calendar6s'] = Model_calendar6::find('all', array(
													    'order_by' => array('Day' => 'asc',
																			'Hour' => 'asc',
																			'Minute' => 'asc',
																			'Name' => 'asc',
																			),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar6/index', $data);
		} else {
			Response::redirect('login/index');
		}


	}

	public function action_view($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar6');

			if ( ! $data['calendar6'] = Model_calendar6::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar6');
			}

			$this->template->title = "詳細";
			$this->template->content = View::forge('calendar6/view', $data);
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_create()
	{
		if (Auth::check()) {	
			if (Input::method() == 'POST')
			{
				$val = Model_calendar6::validate('create');

				if ($val->run())
				{
					$calendar6 = Model_Calendar6::forge(array(
					'name' => Input::post('name'),
					'year' => Input::post('year'),
					'month' => Input::post('month'),
					'day' => Input::post('day'),
					'hour' => Input::post('hour'),
					'minute' => Input::post('minute'),
					'title' => Input::post('title'),
					'text' => Input::post('text'),
					));
					if($calendar6->year >= 2000 && $calendar6->year <= 2050){
						if($calendar6->month >= 1 && $calendar6->month <= 12){
							if($calendar6->day >= 1 && $calendar6->day <= 31){
								if($calendar6->month == 2 && $calendar6->day > 29)
								{
									Session::set_flash('error', $calendar6->month.' 月は 1 ～ 28 または 1 ～ 29 日の間で入力してください');
								}
								elseif($calendar6->month == 4 && $calendar6->day > 30)
								{
									Session::set_flash('error', $calendar6->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar6->month == 6 && $calendar6->day > 30)
								{
									Session::set_flash('error', $calendar6->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar6->month == 9 && $calendar6->day > 30)
								{
									Session::set_flash('error', $calendar6->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar6->month == 11 && $calendar6->day > 30)
								{
									Session::set_flash('error', $calendar6->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar6->hour > 24 || $calendar6->hour < 0)
								{
									Session::set_flash('error',' 時間(時)を正しく設定してください');

								}
								elseif($calendar6->minute > 59 || $calendar6->minute < 00)
								{
									Session::set_flash('error',' 時間(分)を正しく設定してください');
								}

								else
								{
									if ($calendar6 and $calendar6->save())
									{
										Session::set_flash('success', '予定を追加しました #'.$calendar6->id.'.');

										Response::redirect('calendar6');
									}
									else
									{
										Session::set_flash('error', '追加に失敗しました');
									}
								}
							}
							else
							{
								Session::set_flash('error', '日付は 1 ～ 31 日の間で入力してください');
							}
						}
						else
						{
							Session::set_flash('error', '月は 1 ～ 12 月の間で入力してください');
						}
					}
					else
					{
						Session::set_flash('error', '年は 2000 ～ 2050 年の間で入力してください');
					}
				}
				else
				{
					Session::set_flash('error', $val->error());
				}
			}

			$this->template->title = "予定登録";
			$this->template->content = View::forge('calendar6/create');
		} else {
			Response::redirect('login/index');
		}

	}
	public function action_edit($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar6');

			if ( ! $calendar6 = Model_calendar6::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar6');
			}
			$val = Model_calendar6::validate('edit');

			if ($val->run())
			{
				$calendar6->name = Input::post('name');
				$calendar6->year = Input::post('year');
				$calendar6->month = Input::post('month');
				$calendar6->day = Input::post('day');
				$calendar6->hour = Input::post('hour');
				$calendar6->minute = Input::post('minute');
				$calendar6->title = Input::post('title');
				$calendar6->text = Input::post('text');

				if ($calendar6->save())
				{
					Session::set_flash('success', '更新しました #' . $id);

					Response::redirect('calendar6');
				}

				else
				{
					Session::set_flash('error', '更新に失敗しました #' . $id);
				}
			}

			else
			{
				if (Input::method() == 'POST')
				{
					$calendar6->name = $val->validated('name');
					$calendar6->year = $val->validated('year');
					$calendar6->month = $val->validated('month');
					$calendar6->day = $val->validated('day');
					$calendar6->hour = $val->validated('hour');
					$calendar6->minute = $val->validated('minute');
					$calendar6->title = $val->validated('title');
					$calendar6->text = $val->validated('text');

					Session::set_flash('error', $val->error());
				}

				$this->template->set_global('calendar6', $calendar6, false);
			}

			$this->template->title = "編集";
			$this->template->content = View::forge('calendar6/edit');
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_delete($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar6');

			if ($calendar6 = Model_calendar6::find($id))
			{
				$calendar6->delete();

				Session::set_flash('success', '削除しました #'.$id);
			}

			else
			{
				Session::set_flash('error', '削除に失敗しました #'.$id);
			}
			Response::redirect('calendar6');
		} else {
			Response::redirect('login/index');
		}
	}
}
