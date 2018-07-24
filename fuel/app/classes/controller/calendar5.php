<?php
class Controller_calendar5 extends Controller_Template
{
	public function action_index()
	{
		if (Auth::check()) {	
			$data['calendar5s'] = Model_calendar5::find('all', array(
													    'order_by' => array('Day' => 'asc'),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar5/index', $data);
		} else {
			Response::redirect('login/index');
		}


	}

	public function action_view($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar5');

			if ( ! $data['calendar5'] = Model_calendar5::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar5');
			}

			$this->template->title = "詳細";
			$this->template->content = View::forge('calendar5/view', $data);
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_create()
	{
		if (Auth::check()) {	
			if (Input::method() == 'POST')
			{
				$val = Model_calendar5::validate('create');

				if ($val->run())
				{
					$calendar5 = Model_calendar5::forge(array(
						'name' => Input::post('name'),
						'year' => Input::post('year'),
						'month' => Input::post('month'),
						'day' => Input::post('day'),
						'time' => Input::post('time'),
						'title' => Input::post('title'),
						'text' => Input::post('text'),
					));
					if($calendar5->year >= 2000 && $calendar5->year <= 2050){
						if($calendar5->month >= 1 && $calendar5->month <= 12){
							if($calendar5->day >= 1 && $calendar5->day <= 31){
								if($calendar5->month == 2 && $calendar5->day > 29)
								{
									Session::set_flash('error', $calendar5->month.' 月は 1 ～ 28 または 1 ～ 29 日の間で入力してください');
								}
								elseif($calendar5->month == 4 && $calendar5->day > 30)
								{
									Session::set_flash('error', $calendar5->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar5->month == 6 && $calendar5->day > 30)
								{
									Session::set_flash('error', $calendar5->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar5->month == 9 && $calendar5->day > 30)
								{
									Session::set_flash('error', $calendar5->month.' 月は 1 ～ 30 日の間で入力してください');
								}
								elseif($calendar5->month == 11 && $calendar5->day > 30)
								{
									Session::set_flash('error', $calendar5->month.' 月は 1 ～ 30 日の間で入力してください');
								}

								else
								{
									if ($calendar5 and $calendar5->save())
									{
										Session::set_flash('success', '予定を追加しました #'.$calendar5->id.'.');

										Response::redirect('calendar5');
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
			$this->template->content = View::forge('calendar5/create');
		} else {
			Response::redirect('login/index');
		}

	}

	public function action_edit($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar5');

			if ( ! $calendar5 = Model_calendar5::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar5');
			}
			$val = Model_calendar5::validate('edit');

			if ($val->run())
			{
				$calendar5->name = Input::post('name');
				$calendar5->year = Input::post('year');
				$calendar5->month = Input::post('month');
				$calendar5->day = Input::post('day');
				$calendar5->time = Input::post('time');
				$calendar5->title = Input::post('title');
				$calendar5->text = Input::post('text');

				if ($calendar5->save())
				{
					Session::set_flash('success', '更新しました #' . $id);

					Response::redirect('calendar5');
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
					$calendar5->name = $val->validated('name');
					$calendar5->year = $val->validated('year');
					$calendar5->month = $val->validated('month');
					$calendar5->day = $val->validated('day');
					$calendar5->time = $val->validated('time');
					$calendar5->title = $val->validated('title');
					$calendar5->text = $val->validated('text');

					Session::set_flash('error', $val->error());
				}

				$this->template->set_global('calendar5', $calendar5, false);
			}

			$this->template->title = "編集";
			$this->template->content = View::forge('calendar5/edit');
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_delete($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar5');

			if ($calendar5 = Model_calendar5::find($id))
			{
				$calendar5->delete();

				Session::set_flash('success', '削除しました #'.$id);
			}

			else
			{
				Session::set_flash('error', '削除に失敗しました #'.$id);
			}
			Response::redirect('calendar5');
		} else {
			Response::redirect('login/index');
		}
	}
}
