<?php
class Controller_Lang extends Controller
{

	function action_ru()
	{
		$_SESSION['lang'] = 'ru';
		header("LOCATION: ". $_SERVER['HTTP_REFERER']."");
	}
	
	function action_en()
	{
		$_SESSION['lang'] = 'en';
		header("LOCATION: ". $_SERVER['HTTP_REFERER']."");
	}

}