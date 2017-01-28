<?php
class Controller_Logout extends Controller
{


	public function action_index()
	{
		session_destroy();
	header("LOCATION: /home");
		
	}
	
}