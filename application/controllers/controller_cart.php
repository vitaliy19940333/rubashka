<?php
class Controller_Cart extends Controller
{
	
	public $Model_Cart;
	public $model_Msql;
	
	
	function __construct()
	{
		parent::__construct();
		$this->Model_Cart = Model_Cart::Instance();
		$this->model_Msql = model_Msql::Instance();
	}
	
	
	
	public function action_order()
	{
		$object['userName']        =   trim(htmlspecialchars(stripslashes($_POST['userName'])));
		$object['secondName']  =   trim(htmlspecialchars(stripslashes($_POST['secondName'])));
		$object['userEmail']       =   trim(htmlspecialchars(stripslashes($_POST['userEmail'])));
		$object['user_phone']      =   trim(htmlspecialchars(stripslashes($_POST['user_phone'])));
		$object['userAdress']      =   htmlspecialchars(stripslashes($_POST['userAdress']));
		$object['wishes']          =   htmlspecialchars(stripslashes($_POST['wishes']));
		
		$error  = false;
		if(!isset($_SESSION['u_id']))
		{
			if(strlen($object['userName']) < 2)
			{
				$error = true;
				$data['massage'] = 'Имя не может быть меньше 3 символов';
			}
			if(strlen($object['secondName']) < 2)
			{
				$error = true;
				$data['massage'] = 'Фамилия не может быть меньше 3 символов';
			}
			if(strlen($object['userEmail']) < 2)
			{
				$error = true;
				$data['massage'] = 'E-mail не может быть меньше 3 символов';
			}
			
			if((!preg_match("/^[0-9a-z_\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$/i", $object['userEmail'])))
			{
				$error = true;
				$data['massage'] = 'Вы ввели некорректный E-mail!';
			}
		}else{
			$objects['id_client'] = $_SESSION['u_id'];
		}
		
		
		if(strlen($object['userAdress']) < 9)
		{
			$error = true;
			$data['massage'] = 'Адрес может быть меньше 10 символов';
		}
		
		if(empty($_SESSION['cart']))
		{
			$error =  true;
			$data['massage'] = 'Ваша корзина пуста ! ';
		}
		
		if(!$error)
		{
			$objects['name'] = $object['userName']." ".$object['secondName'];
			$objects['email'] = $object['userEmail'];
			$objects['phone'] = $object['user_phone'];
			$objects['description'] = $object['userAdress'];
			
			$bask = "";
			foreach($_SESSION['cart'] as $key => $value)
			{
				$bask.= $key."_".$value.";";
			}
			$bask = substr($bask,0,-1);
			
			$objects['basket'] = $bask;
			$objects['date_change_order'] = time();
			$objects['data_insert'] = time();
			$objects['status']  = 'new';
			$objects['userAdress']  = $object['userAdress'];
			$ajax = new Controller_Ajax();
			$objects['summa'] = $ajax->action_getSummInCart();
			
			if($id = $this->model_Msql->Insert('em_orders',$objects))
			{
				unset($_SESSION['cart']);
				$data['massage'] = '<p class="alert alert-success">Номер вашего заказа '.$id.'! В ближайшее время с вами свяжется наш менеджер, для уточнения заказа.</p>';
			}
		}else
			$data['object'] = $object;
			
			
		
			$this->view->generate("order_view.php","template_view.php",$data);
		
		
		
	}
	
	
	
	
	
	
	public function action_view()
	{
		if(empty($_SESSION['cart']))
			header("LOCATION: /home");
		$data = $this->Model_Cart->getInfoCart($_SESSION['cart']);
		$data['meta']['meta_descr'] = 'Корзина rubaha.com.ua - Одесса 7км';
		$data['meta']['meta_key'] = 'детские рубашки, мужские рубашки, школьные рубашки, галстуки, бабочки';
		$data['meta']['title'] = 'Корзина';
			
		$this->view->generate("cart_view.php","template_view.php",$data);
	}
	
	public function action_delete()
	{
		$this->Model_Cart->unsetFromBasket(Route::$param['id'],Route::$param['size']);
		$this->action_view();
	}
	
	public function action_update()
	{
		
		if($this->isPost())
		{
			$this->Model_Cart->updateCart($_SESSION['cart'],$_POST);
			if(isset($_POST['recentr']))
				$this->action_view();
			else
			{
				$data['meta']['meta_descr'] = 'Оформление заказа rubaha.com.ua - Одесса 7км';
			$data['meta']['meta_key'] = 'детские рубашки, мужские рубашки, школьные рубашки, галстуки, бабочки';
			$data['meta']['title'] = 'Оформление заказа';
				$this->view->generate("order_view.php","template_view.php",$data);
			}
				
			
		}
	}
	
	public function action_order_form()
	{
		if($this->isPost())
		{
			$object['name'] = $this->clear($_POST['name']);
			$object['email'] = $this->clear($_POST['email']);
			$object['phone'] = $this->clear($_POST['phone']);
			$object['description'] = $this->clear($_POST['description']);
			$bask = "";
			foreach($_SESSION['cart'] as $key => $value)
			{
				$bask.= $key."_".$value.";";
			}
			$bask = substr($bask,0,-1);
			
			$object['basket'] = $bask;
			if($this->model_Msql->Insert('em_orders',$object))
				unset($_SESSION['cart']);
		}
		header("LOCATION: /home");
	}
	
	private function clear($data)
	{
		return stripslashes(strip_tags(trim($data)));
	}
	
}
?>
