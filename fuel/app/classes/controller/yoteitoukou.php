<?php
class Controller_Yoteitoukou extends Controller_Template
{

	public function action_index()
	{
		$data['yoteitoukous'] = Model_Yoteitoukou::find('all');
		$this->template->title = "Yoteitoukous";
		$this->template->content = View::forge('yoteitoukou/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('yoteitoukou');

		if ( ! $data['yoteitoukou'] = Model_Yoteitoukou::find($id))
		{
			Session::set_flash('error', 'Could not find yoteitoukou #'.$id);
			Response::redirect('yoteitoukou');
		}

		$this->template->title = "Yoteitoukou";
		$this->template->content = View::forge('yoteitoukou/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Yoteitoukou::validate('create');

			if ($val->run())
			{
				$yoteitoukou = Model_Yoteitoukou::forge(array(
					'body' => Input::post('body'),
					'ip' => Input::post('ip'),
				));

				if ($yoteitoukou and $yoteitoukou->save())
				{
					Session::set_flash('success', 'Added yoteitoukou #'.$yoteitoukou->id.'.');

					Response::redirect('yoteitoukou');
				}

				else
				{
					Session::set_flash('error', 'Could not save yoteitoukou.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Yoteitoukous";
		$this->template->content = View::forge('yoteitoukou/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('yoteitoukou');

		if ( ! $yoteitoukou = Model_Yoteitoukou::find($id))
		{
			Session::set_flash('error', 'Could not find yoteitoukou #'.$id);
			Response::redirect('yoteitoukou');
		}

		$val = Model_Yoteitoukou::validate('edit');

		if ($val->run())
		{
			$yoteitoukou->body = Input::post('body');
			$yoteitoukou->ip = Input::post('ip');

			if ($yoteitoukou->save())
			{
				Session::set_flash('success', 'Updated yoteitoukou #' . $id);

				Response::redirect('yoteitoukou');
			}

			else
			{
				Session::set_flash('error', 'Could not update yoteitoukou #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$yoteitoukou->body = $val->validated('body');
				$yoteitoukou->ip = $val->validated('ip');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('yoteitoukou', $yoteitoukou, false);
		}

		$this->template->title = "Yoteitoukous";
		$this->template->content = View::forge('yoteitoukou/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('yoteitoukou');

		if ($yoteitoukou = Model_Yoteitoukou::find($id))
		{
			$yoteitoukou->delete();

			Session::set_flash('success', 'Deleted yoteitoukou #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete yoteitoukou #'.$id);
		}

		Response::redirect('yoteitoukou');

	}

}
