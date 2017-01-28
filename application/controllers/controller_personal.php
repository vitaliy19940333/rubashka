<?php
class Controller_Personal extends Controller
{
	private $user;
	
	
	public function __construct()
	{
		parent:: __construct();
		$this->user = Model_Users::Instance();
	}

	public function action_index()
	{
		if(isset($_SESSION['u_id']))
			$this->action_info();
		else{
			$data = $this->m_mysql->Select("SELECT * FROM static_content WHERE title_page='personal'");
			$data['meta']['meta_descr'] = "";
			$data['meta']['meta_key'] = "";
			$data['meta']['title'] = 'Личный кабинет';
			$this->view->generate('repsonal.php', 'template_view.php',$data);
		}
	}
	
	
	private   function generate_password($number)
	{
		$arr = array('a','b','c','d','e','f',
					 'g','h','i','j','k','l',
					 'm','n','o','p','r','s',
					 't','u','v','x','y','z',
					 'A','B','C','D','E','F',
					 'G','H','I','J','K','L',
					 'M','N','O','P','R','S',
					 'T','U','V','X','Y','Z',
					 '1','2','3','4','5','6',
					 '7','8','9','0','.',',',
					 '(',')','[',']','!','?',
					 '&','^','%','@','*','$',
					 '<','>','/','|','+','-',
					 '{','}','`','~');
		// Генерируем пароль
		$pass = "";
		for($i = 0; $i < $number; $i++)
		{
		  // Вычисляем случайный индекс массива
		  $index = rand(0, count($arr) - 1);
		  $pass .= $arr[$index];
		}
		return $pass;
	 }
	
	public function action_forgotten()
	{
		if(isset($_SESSION['u_id']))
			$this->action_info();
		else{
					if($this->isPost())
		{
			$email =  trim(stripslashes(strip_tags($_POST['email_registers'])));
			
			$data = $this->m_mysql->Select("SELECT * FROM users WHERE login='$email'");
			if(count($data) > 0 AND (strlen($email) > 3))
			{
				
				$passwords = $this->generate_password(8);
				$password['password'] = md5($passwords);
				if($this->m_mysql->Update('users',$password,'id_user='.$data[0]['id_user']))
				{
					$to  = $email;
						


						$message = ' 
						<html> 
							<head> 
								<title>Ваш новый пароль</title> 
							</head> 
							<body> 
								<p><b>Пароль</b> : '.$passwords.'</p> 
							</body> 
						</html>';
						
			$from = 'vitala_boris@mail';
			$subject = "Восстановление пароля"; 
			$subject ="=?utf-8?B?".base64_encode($subject)."?=";
			$headers = "From: ".$from."\r\nReply-to:$from\r\nContent-type: text/plain; charset=utf-8\r\n";
			

						if(mail($to,$subject,$message,$headers))
							$data['massage'] = 'Новый пароль отправлен вам на почту';
						else
							$data['massage'] = 'Ошибка';
				}
			}
			else
				$data['massage'] = 'Ошибка';
		
		
		}
		$data['meta']['meta_descr'] = "";
		$data['meta']['meta_key'] = "";
		$data['meta']['title'] = 'Восстановление пароля';
		$this->view->generate('forgotten.php', 'template_view.php',$data);
		}

	}
	
	
	public function action_saveData()
	{
		if(!isset($_SESSION['u_id']))
			header("LOCATION: /personal");
		else{
			if($this->isPost())
			{

				$first_name = trim(stripslashes(strip_tags($_POST['first_name'])));
				$last_name = trim(stripslashes(strip_tags($_POST['last_name'])));
				$email = trim(stripslashes(strip_tags($_POST['email'])));
				$phone = trim(stripslashes(strip_tags($_POST['phone'])));
				$password = trim(stripslashes(strip_tags($_POST['password'])));
				$password_confirmation = trim(stripslashes(strip_tags($_POST['password_confirmation'])));
				$error = false;
				if( (strlen($first_name) < 2) OR (strlen($last_name) < 2) OR (strlen($email) < 2) OR (strlen($password) < 2))
				{
					$error = true;
					$massage = 'Заполните все поля';
				}
				if($password_confirmation != $password)
				{
					$error = true;
					$massage = 'Пароли не совпадают';
				}
				
				
				
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$error = true;
					$massage = 'E-mail указан не верно';
				}
				
				if(!$error)
				{
					$object['login'] = $email;
					$object['password'] = md5($password);
					$object['name'] = $first_name." ".$last_name;
					$object['id_role'] = 2;
					$object['id_users_info'] = 2;
					$object['phone'] = $phone;
					$object['data_reg'] = time();
				if($this->m_mysql->Update('users',$object,'id_user='.$_SESSION['u_id']) > 0)
					$massage = 'Данные сохранены';
				else
					$massage = 'Такой E-mail уже существует';
				}
				$this->action_info($massage);
			}
		}
	}
	
	public function action_login()
	{
		if(!isset($_SESSION['u_id']))
		{
			$object['email'] =  trim(stripslashes(strip_tags($_POST['email'])));
			$object['password'] =  trim(stripslashes(strip_tags($_POST['password'])));
			$data = $this->user->Login($object['email'], $object['password'], $remember = true);
			if(empty($data))
			{
				$data['massage'] = 'Такого пользователя не существует';
				header("LOCATION: /personal");
			}else{
				$_SESSION['u_id'] = $data['id_user'];
				header("LOCATION: /personal");
			}
		}	
		else{
			header("LOCATION: /personal/info");
		}
		
	}
	
	
	
	public function action_orders()
	{
				$cart = Model_Cart::Instance();
				$data['top_item'] =  $this->m_mysql->Select("SELECT * FROM em_items ORDER BY count_sale DESC LIMIT 3");
			if(isset(Route::$param['view']))
			{
				$id = Route::$param['view']*1;
				$data['basket'] =  $this->m_mysql->Select("SELECT basket,summa FROM em_orders WHERE id_client=".$_SESSION['u_id']." AND id=".$id);
				$data['bakset'] = $cart->getInfoCartFROM($data['basket'][0]['basket']);
				//echo "<pre>";
				//print_r($data);
				$this->view->generate('personal_order.php', 'template_view.php',$data);
			}
			else{
				
				$data['orders'] = $this->m_mysql->Select("SELECT * FROM em_orders WHERE id_client=".$_SESSION['u_id']);
				$cart = Model_Cart::Instance();
				$data['status'] = $cart->getStatusOrder();
				$this->view->generate('personal_orders.php', 'template_view.php',$data);
			}
			
	}
	
	
	
	public function action_logout()
	{
		if(isset($_SESSION['u_id']))
		{
			session_destroy();
			header("LOCATION: /home");
		}else{
			header("LOCATION: /404");
		}
	}
	
	public function action_info($massage = "")
	{
		if(!isset($_SESSION['u_id']))
			header("LOCATION: /home");
		$data['top_item'] =  $this->m_mysql->Select("SELECT * FROM em_items ORDER BY count_sale DESC LIMIT 3");
		$data['user'] = $this->m_mysql->Select("SELECT * FROM users WHERE id_user=".$_SESSION['u_id']);
		$data['user'] = $data['user'][0];
		$this->view->generate('personal_view.php', 'template_view.php',$data);
	}
	
	
	
	public function action_register()
	{
		if(isset($_SESSION['u_id']))
		{
			$this->action_info();
		}else
		{
					if($this->isPost())
		{

			$first_name = trim(stripslashes(strip_tags($_POST['first_name'])));
			$last_name = trim(stripslashes(strip_tags($_POST['last_name'])));
			$email = trim(stripslashes(strip_tags($_POST['email'])));
			$phone = trim(stripslashes(strip_tags($_POST['phone'])));
			$password = trim(stripslashes(strip_tags($_POST['password'])));
			$password_confirmation = trim(stripslashes(strip_tags($_POST['password_confirmation'])));
			$error = false;
			if( (strlen($first_name) < 2) OR (strlen($last_name) < 2) OR (strlen($email) < 2) OR (strlen($password) < 2))
			{
				$error = true;
				$massage = 'Заполните все поля';
			}
			if($password_confirmation != $password)
			{
				$error = true;
				$massage = 'Пароли не совпадают';
			}
			
			
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$error = true;
				$massage = 'E-mail указан не верно';
			}
			
			if(!$error)
			{
				$object['login'] = $email;
			$object['password'] = md5($password);
			$object['name'] = $first_name."  ".$last_name;
			$object['id_role'] = 2;
			$object['id_users_info'] = 2;
			$object['phone'] = $phone;
			$object['data_reg'] = time();
			if($this->m_mysql->Insert('users',$object) > 0)
				$massage = 'Вы успешно зарегистрировались';
			else
				$massage = 'Такой E-mail уже существует';
			}
			
		}
		
		$data['meta']['meta_descr'] = "";
		$data['meta']['meta_key'] = "";
		$data['meta']['title'] = 'Регистрация';
		$this->view->generate('register_from.php', 'template_view.php',$massage);
		}
			

	}

}