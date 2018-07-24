<?php
class Controller_Logout extends Controller
{
    public function action_index()
    {
		if (Auth::check()) {	
	        $auth = Auth::instance();
	        $auth->logout();
	        Response::redirect('/login');
		}
		else{
			Response::redirect('/login');
		}
    }
}