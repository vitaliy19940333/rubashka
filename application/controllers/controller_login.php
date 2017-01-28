<?php
class Controller_Login extends Controller
{
	
	public function __construct()
	{
		parent::__construct("");
		$this->model = Model_Users::Instance();
		$this->model->ClearSessions();
	}
	function action_index()
	{
		//$data["login_status"] = "";

		if($this->isPost() && isset($_POST['password']))
		{
			$login = $_POST['login'];
			$password =$_POST['password'];
			
			/*
			Производим аутентификацию, сравнивая полученные значения со значениями прописанными в коде.
			Логин и пароль должны храниться в БД, причем пароль должен быть захеширован.
			*/
			if($user = $this->model->Login($_POST['login'], $_POST['password'], isset($_POST['remember'])))
			{
				$data["login_status"] = "Hello ".$user['name'];
			}
			else
			{
				$data["login_status"] = "access_denied";
			}
		}
		else
		{
			$data["login_status"] = "";
		}
		
		if(($this->model->Can('all'))){
			header("LOCATION: /admin");
		}
		
		$this->view->generate('', 'login_view.php', $data);
	}
	
}
