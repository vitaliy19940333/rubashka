<?php

class Controller_Admin extends Controller
{
	
	/*
	В конструкторе создаем модель для работы с пользователями
	И очищаем устаревшие сессии
	А так же проверям права доступа
	Если зашел не админ,то инклюдим шаблон ошибки
	*/
	
	public function __construct()
	{
		parent::__construct();
		
		$this->model = Model_Users::Instance();
		
		if(!($this->model->Can('all')))
			header("LOCATION: 404");
	}
	
	
	function action_orders()
	{
		$cart = Model_Cart::Instance();
		$data['status'] = $cart->getStatusOrder();
		$data['orders'] = $this->m_mysql->Select("SELECT * FROM em_orders");
		$this->view->generate("all_orders.php","admin/template_view.php",$data);
	}
	
	function action_order()
	{
		$clients = Model_Clients::Instance();
		$id = Route::$param['view']*1;
		$model_cart = Model_Cart::Instance();
		$data['basket'] =  $this->m_mysql->Select("SELECT status,id_client,basket,summa FROM em_orders WHERE id=".$id);
		if($this->isPost())
		{
			$id = $_POST['id_Zakaza']*1;
			$status['status'] = $_POST['status'];
			$status['date_change_order'] = time();
			$this->m_mysql->Update("em_orders",$status,"id=$id");
			
			
			if($status['status'] == 'finish')
			{
				$model_cart->IncreaseSale($data['basket'][0]['basket'],'+');
			}
			if($status['status'] == 'back')
			{
				$model_cart->IncreaseSale($data['basket'][0]['basket'],'-');
			}
		}
		
		
		$data['status'] = $model_cart->getStatusOrder();
		$data['bakset'] = $model_cart->getInfoCartFROM($data['basket'][0]['basket']);
		$data['info'] = $clients->getInfoClients($data['basket'][0]['id_client'],$id);
		$this->view->generate("order_view.php","admin/template_view.php",$data);
	}
	
	
	
	public function action_clients()
	{
		$clients = Model_Clients::Instance();
		$list = $clients->getListClients();
		$this->view->generate('clients.php', 'admin/template_view.php', $list);
	}
	
	public function action_curs()
	{
		if(isset($_POST['curs']))
		{
			$curs = $_POST['curs'];
			$obj['value_kurs'] = $curs;
			$obj['data_add'] = time();
				$curs_last = $this->m_mysql->Select("SELECT * FROM curs ORDER BY id DESC LIMIT 1;");
				$curs_last = $curs_last[0]['value_kurs'];
			if($sql = $this->m_mysql->Insert('curs',$obj))
			{
				$objs['price_roz'] = "price_roz*$curs";
				$sql = $this->m_mysql->SELECT("UPDATE em_items SET price_roz=ROUND(price_roz/$curs_last*$curs) WHERE id>0");
				$sql = $this->m_mysql->SELECT("UPDATE em_items SET price_opt=ROUND(price_opt/$curs_last*$curs) WHERE id>0");
			}
		}
		$data = $this->m_mysql->Select("SELECT * FROM curs ORDER BY id DESC");
		$this->view->generate('curs.php', 'admin/template_view.php', $data);
	}
	
	public function action_index()
	{
		$this->view->generate('add_categoty.php', 'admin/template_view.php', $data);
	}
	
	
	public function action_category()
	{
		if($this->isPost())
		{
			$category['title'] = $_POST['title_data'];
			$this->m_mysql->Insert("em_category",$category);
		}
			$data = $this->m_mysql->Select("SELECT * FROM em_category");
	
		$this->view->generate('add_categoty.php', 'admin/template_view.php', $data);
	}
	
	public function action_sleeve()
	{
		if($this->isPost())
		{
			$category['title'] = $_POST['title_data'];
			$this->m_mysql->Insert("em_sleeve",$category);
		}
			$data = $this->m_mysql->Select("SELECT * FROM em_sleeve");
	
		$this->view->generate('add_categoty.php', 'admin/template_view.php', $data);
	}
	
	public function action_kind()
	{
		if($this->isPost())
		{
			$category['title'] = $_POST['title_data'];
			$this->m_mysql->Insert("em_kind",$category);
		}
			$data = $this->m_mysql->Select("SELECT * FROM em_kind");
	
		$this->view->generate('add_categoty.php', 'admin/template_view.php', $data);
	}
	
	public function action_sewing()
	{
		if($this->isPost())
		{
			$category['title'] = $_POST['title_data'];
			$this->m_mysql->Insert("em_sewing",$category);
		}
			$data = $this->m_mysql->Select("SELECT * FROM em_sewing");

	
		$this->view->generate('add_categoty.php', 'admin/template_view.php', $data);
	}
	
	
	public function action_items()
	{
		$data['category'] = $this->m_mysql->Select("SELECT * FROM em_category");
		$data['sleeve'] = $this->m_mysql->Select("SELECT * FROM em_sleeve");
		$data['kind'] = $this->m_mysql->Select("SELECT * FROM em_kind");
		$data['sewing'] = $this->m_mysql->Select("SELECT * FROM em_sewing");
		
		if($this->isPost())
		{
			$curs_last = $this->m_mysql->Select("SELECT * FROM curs ORDER BY id DESC LIMIT 1;");
			$curs_last = $curs_last[0]['value_kurs'];
			$pictures = $_FILES['pictures'];
			$link = Model_Image::resize($pictures);
			$items['pictures'] = $link;
			$items['article'] = $_POST['code'];
			$items['category'] =  $_POST['category'];
			$items['sleeve'] = $_POST['sleeve'];
			
			foreach($_POST as $key => $value){
					if(strpos($key,'sewing') !==false)
						$items['sewing'].= substr($key,-1).";";
			}
			
			$items['sewing'] = substr($items['sewing'],0,-1);
			
			foreach($_POST as $key => $value){
					if(strpos($key,'kind') !==false)
						$items['kind'].= substr($key,-1).";";
			}
			
			$items['kind'] = substr($items['kind'],0,-1);
			$items['price_roz'] = $_POST['price_roz']*$curs_last;
			$items['price_opt'] = $_POST['price_opt']*$curs_last;
			$items['title'] = $_POST['title'];
			$items['size'] = $_POST['sizes'];
			$items['description'] = $_POST['description'];
			$items['in_sklad'] = $_POST['count_in_sklad'];
			$items['discount'] = $_POST['discount'];
			$items['slise'] = $_POST['slice'];
			$items['date_add'] = time();
			$items['complect'] = $_POST['complect'];
			
			$this->m_mysql->Insert("em_items",$items);
		}
		$data['items'] = $this->m_mysql->Select("SELECT * FROM em_items");
		
		$this->view->generate("add_items.php","admin/template_view.php",$data);
	}
	
	
	public function action_update(){
		
		$data['category'] = $this->m_mysql->Select("SELECT * FROM em_category");
		$data['sleeve'] = $this->m_mysql->Select("SELECT * FROM em_sleeve");
		$data['kind'] = $this->m_mysql->Select("SELECT * FROM em_kind");
		$data['sewing'] = $this->m_mysql->Select("SELECT * FROM em_sewing");
		$id = Route::$param['id'];
		$item = $this->m_mysql->Select("SELECT * FROM em_items WHERE id=".$id);
		$data['item'] = $item[0];
		$this->view->generate("update_item.php","admin/template_view.php",$data);
		
		
		if($this->isPost())
		{
			$pictures = $_FILES['pictures'];
			if(is_uploaded_file($pictures['tmp_name']))
			{
				$link = Model_Image::resize($pictures);
				@unlink($_POST['link']);
			}
				
			else
				$link = $_POST['link'];
			
			$items['pictures'] = $link;
			$items['article'] = $_POST['code'];
			$items['category'] =  $_POST['category'];
			$items['sleeve'] = $_POST['sleeve'];
			
			foreach($_POST as $key => $value){
					if(strpos($key,'sewing') !==false)
						$items['sewing'].= substr($key,-1).";";
			}
			
			$items['sewing'] = substr($items['sewing'],0,-1);
			
			foreach($_POST as $key => $value){
					if(strpos($key,'kind') !==false)
						$items['kind'].= substr($key,-1).";";
			}
			$curs_last = $this->m_mysql->Select("SELECT * FROM curs ORDER BY id DESC LIMIT 1;");
				$curs_last = $curs_last[0]['value_kurs'];
			$items['kind'] = substr($items['kind'],0,-1);
			$items['price_roz'] = $_POST['price_roz'];
			$items['price_opt'] = $_POST['price_opt'];
			$items['title'] = $_POST['title'];
			$items['size'] = $_POST['sizes'];
			$items['description'] = $_POST['description'];
			$items['in_sklad'] = $_POST['count_in_sklad'];
			$items['discount'] = $_POST['discount'];
			$items['meta_descr'] = $_POST['meta_descr'];
			$items['meta_keyword'] = $_POST['meta_keywords'];
			$items['slise'] = $_POST['slice'];			
			$this->m_mysql->Update("em_items",$items,'id='.$_POST['id']);
		}
		
	}
	
	
	public function action_edit_page()
	{
		$model = new Model_Page();
		
		
		if(isset(Route::$param['page']))
		{
			if($this->isPost())
			{
				$data['lang_ua'] = trim($_POST['consist_ua']);
				$data['lang_ru'] = trim($_POST['consist_ru']);

				$model->Update($data['lang_ru'],$data['lang_ua'],Route::$param['page']);
				
			}

			$data = $model->Get(Route::$param['page']);

			$this->view->generate('edit_page.php', 'admin/template_view.php',$data);
		}else{
			
			$data = $this->m_mysql->Select("Select * FROM static_content");
			$this->view->generate('page.php', 'admin/template_view.php',$data);
		}
		
	}
	

	
	// Действие для разлогинивания администратора
	function action_logout()
	{
		session_start();
		session_destroy();
		header('Location:/');
	}

}
