<?php
class Controller_calendar7 extends Controller_Template
{
	public function action_index()
	{
		if (Auth::check()) {	
			$data['calendar7s'] = Model_calendar7::find('all', array(
													    'order_by' => array('Day' => 'asc',
																			'Hour' => 'asc',
																			'Minute' => 'asc',
																			'Name' => 'asc',
																			),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar7/index', $data);
		} else {
			Response::redirect('login/index');
		}
	}
	public function action_itiran()
	{
		if (Auth::check()) {	
			$data['calendar7s'] = Model_calendar7::find('all', array(
													    'order_by' => array('Day' => 'asc',
																			'Hour' => 'asc',
																			'Minute' => 'asc',
																			'Name' => 'asc',
																			),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar7/itiran', $data);
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_next()
	{
		if (Auth::check()) {	
			$data['calendar7s'] = Model_calendar7::find('all', array(
													    'order_by' => array('Day' => 'asc',
																			'Hour' => 'asc',
																			'Minute' => 'asc',
																			'Name' => 'asc',
																			),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar7/next', $data);
		} else {
			Response::redirect('login/index');
		}
	}
	public function action_previous()
	{
		if (Auth::check()) {	
			$data['calendar7s'] = Model_calendar7::find('all', array(
													    'order_by' => array('Day' => 'asc',
																			'Hour' => 'asc',
																			'Minute' => 'asc',
																			'Name' => 'asc',
																			),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar7/previous', $data);
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_view($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar7');

			if ( ! $data['calendar7'] = Model_calendar7::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar7');
			}

			$this->template->title = "詳細";
			$this->template->content = View::forge('calendar7/view', $data);
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_create()
	{
		if (Auth::check()) {	
			if (Input::method() == 'POST')
			{
				$val = Model_calendar7::validate('create');

				if ($val->run())
				{
					$calendar7 = Model_calendar7::forge(array(
					'name' => Input::post('name'),
					'year' => Input::post('year'),
					'month' => Input::post('month'),
					'day' => Input::post('day'),
					'hour' => Input::post('hour'),
					'minute' => Input::post('minute'),
					'title' => Input::post('title'),
					'text' => Input::post('text'),
					'user' => Input::post('user'),
					));
					if($calendar7->year >= 2000 && $calendar7->year <= 2050){
						if($calendar7->month >= 1 && $calendar7->month <= 12){
							if($calendar7->day >= 1 && $calendar7->day <= 31){
								if($calendar7->month == 2)
								{
									if($calendar7->year%4 == 0 && $calendar7->year%100 != 0 || $calendar7->year%400 == 0)
									{
										if($calendar7->day > 29)
										{
											Session::set_flash('error', $calendar7->month.' 月(閏年)は 1 ～ 29の間で入力してください');
										}
										else{
											if ($calendar7 and $calendar7->save())
											{
												Session::set_flash('success', '予定を追加しました #'.$calendar7->id);
												Response::redirect('calendar7');
											}
											else
											{
												Session::set_flash('error', '追加に失敗しました');
											}
										}
									}
									else{
										if($calendar7->day > 28)
										{
											Session::set_flash('error', $calendar7->month.' 月は 1 ～ 28の間で入力してください');
										}
										else{
											if ($calendar7 and $calendar7->save())
											{
												Session::set_flash('success', '予定を追加しました #'.$calendar7->id);
												Response::redirect('calendar7');
											}
											else
											{
												Session::set_flash('error', '追加に失敗しました');
											}
										}

									}
								}
								elseif($calendar7->month == 4 && $calendar7->day > 30)
								{
									Session::set_flash('error', $calendar7->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar7->month == 6 && $calendar7->day > 30)
								{
									Session::set_flash('error', $calendar7->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar7->month == 9 && $calendar7->day > 30)
								{
									Session::set_flash('error', $calendar7->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar7->month == 11 && $calendar7->day > 30)
								{
									Session::set_flash('error', $calendar7->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar7->hour > 24 || $calendar7->hour < 0)
								{
									Session::set_flash('error',' 時間(時)を正しく設定してください');

								}
								elseif($calendar7->minute > 59 || $calendar7->minute < 00)
								{
									Session::set_flash('error',' 時間(分)を正しく設定してください');
								}

								else
								{
									if ($calendar7 and $calendar7->save())
									{
										Session::set_flash('success', '予定を追加しました #'.$calendar7->id);

										Response::redirect('calendar7');
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
			$this->template->content = View::forge('calendar7/create');
		} else {
			Response::redirect('login/index');
		}

	}
	public function action_edit($id = null)
	{
		if (Auth::check()) {
			is_null($id) and Response::redirect('calendar7');
			if ( ! $calendar7 = Model_calendar7::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar7');
			}
			$val = Model_calendar7::validate('edit');
			if($calendar7->user == Arr::get(Auth::get_user_id(),1)){			
				if ($val->run())
				{
					$calendar7->name = Input::post('name');
					$calendar7->year = Input::post('year');
					$calendar7->month = Input::post('month');
					$calendar7->day = Input::post('day');
					$calendar7->hour = Input::post('hour');
					$calendar7->minute = Input::post('minute');
					$calendar7->title = Input::post('title');
					$calendar7->text = Input::post('text');

					if ($calendar7->save())
					{
						Session::set_flash('success', '更新しました #' . $id);

						Response::redirect('calendar7');
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
						$calendar7->name = $val->validated('name');
						$calendar7->year = $val->validated('year');
						$calendar7->month = $val->validated('month');
						$calendar7->day = $val->validated('day');
						$calendar7->hour = $val->validated('hour');
						$calendar7->minute = $val->validated('minute');
						$calendar7->title = $val->validated('title');
						$calendar7->text = $val->validated('text');

						Session::set_flash('error', $val->error());
					}

					$this->template->set_global('calendar7', $calendar7, false);
				}
				$this->template->title = "編集";
				$this->template->content = View::forge('calendar7/edit');
			} else {
				Session::set_flash('error', '編集権限がありません #'.$id);
				Response::redirect('calendar7');
			}
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_delete($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar7');
			if ($calendar7 = Model_calendar7::find($id))
			{
				if($calendar7->user == Arr::get(Auth::get_user_id(),1)){			
					$calendar7->delete();
					Session::set_flash('success', '削除しました #'.$id);
				} else {
					Session::set_flash('error', '削除権限がありません #'.$id);
					Response::redirect('calendar7');
				}
			}
			else
			{
				if($calendar7->user == Arr::get(Auth::get_user_id(),1)){			
					Session::set_flash('error', '削除に失敗しました #'.$id);
				} else {
					Session::set_flash('error', '削除権限がありません #'.$id);
					Response::redirect('calendar7');
				}
			}
			Response::redirect('calendar7');
		} else {
			Response::redirect('login/index');
		}
	}
}
