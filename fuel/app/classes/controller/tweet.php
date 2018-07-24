<?php

class Controller_Tweet extends Controller_Template
{

	public function action_index()
	{
		if (Auth::check()) {	
			$data["subnav"] = array('index'=> 'active' );
			$this->template->title = 'Tweet &raquo; Index';
			$this->template->content = View::forge('tweet/index', $data);
		}
		else{
			Response::redirect('/login');
		}
	}
}
