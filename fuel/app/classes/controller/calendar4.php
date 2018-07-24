<?php
class Controller_Calendar4 extends Controller_Template
{

	public function action_index()
	{
		if (Auth::check()) {	
			$data['calendar4s'] = Model_Calendar4::find('all', array(
													    'order_by' => array('Day' => 'asc'),
												));
			$this->template->title = "カレンダー";
			$this->template->content = View::forge('calendar4/index', $data);
		} else {
			Response::redirect('login/index');
		}


	}

	public function action_view($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar4');

			if ( ! $data['calendar4'] = Model_Calendar4::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar4');
			}

			$this->template->title = "詳細";
			$this->template->content = View::forge('calendar4/view', $data);
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_create()
	{
		if (Auth::check()) {	
			if (Input::method() == 'POST')
			{
				$val = Model_Calendar4::validate('create');

				if ($val->run())
				{
					$calendar4 = Model_Calendar4::forge(array(
						'name' => Input::post('name'),
						'year' => Input::post('year'),
						'month' => Input::post('month'),
						'day' => Input::post('day'),
						'time' => Input::post('time'),
						'title' => Input::post('title'),
						'text' => Input::post('text'),
					));

					if ($calendar4 and $calendar4->save())
					{
						Session::set_flash('success', '予定を追加しました #'.$calendar4->id.'.');

						Response::redirect('calendar4');
					}
					else
					{
						Session::set_flash('error', '追加に失敗しました');
					}
				}
				else
				{
					Session::set_flash('error', $val->error());
				}
			}

			$this->template->title = "予定登録";
			$this->template->content = View::forge('calendar4/create');
		} else {
			Response::redirect('login/index');
		}

	}

	public function action_edit($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar4');

			if ( ! $calendar4 = Model_Calendar4::find($id))
			{
				Session::set_flash('error', '予定が見つかりませんでした #'.$id);
				Response::redirect('calendar4');
			}
			$val = Model_Calendar4::validate('edit');

			if ($val->run())
			{
				$calendar4->name = Input::post('name');
				$calendar4->year = Input::post('year');
				$calendar4->month = Input::post('month');
				$calendar4->day = Input::post('day');
				$calendar4->time = Input::post('time');
				$calendar4->title = Input::post('title');
				$calendar4->text = Input::post('text');

				if ($calendar4->save())
				{
					Session::set_flash('success', '更新しました #' . $id);

					Response::redirect('calendar4');
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
					$calendar4->name = $val->validated('name');
					$calendar4->year = $val->validated('year');
					$calendar4->month = $val->validated('month');
					$calendar4->day = $val->validated('day');
					$calendar4->time = $val->validated('time');
					$calendar4->title = $val->validated('title');
					$calendar4->text = $val->validated('text');

					Session::set_flash('error', $val->error());
				}

				$this->template->set_global('calendar4', $calendar4, false);
			}

			$this->template->title = "編集";
			$this->template->content = View::forge('calendar4/edit');
		} else {
			Response::redirect('login/index');
		}
	}

	public function action_delete($id = null)
	{
		if (Auth::check()) {	
			is_null($id) and Response::redirect('calendar4');

			if ($calendar4 = Model_Calendar4::find($id))
			{
				$calendar4->delete();

				Session::set_flash('success', '削除しました #'.$id);
			}

			else
			{
				Session::set_flash('error', '削除に失敗しました #'.$id);
			}
			Response::redirect('calendar4');
		} else {
			Response::redirect('login/index');
		}
	}
}
