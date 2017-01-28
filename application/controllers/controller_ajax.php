<?php
class Controller_Ajax extends Controller
{
	
	public $Model_Users;
	public $Model_msql;
	function __construct()
	{
		parent::__construct();
		$this->Model_Users = Model_Users::Instance();
		$this->Model_msql = Model_Msql::Instance();
	}
	
	
	private function clear($data)
	{
		return htmlspecialchars(strip_tags(stripslashes($data)));
	}
	
	
	public function action_sendMassage(){
		
		if($this->isPost())
		{
			$to = $this->clear($_POST['email']);
			$name = $this->clear($_POST['fio']);
			$massage = $this->clear($_POST['massage_from_site']);
			
			 $mail = new Model_Mail($to); // Создаём экземпляр класса
				$mail->setFromName("EMERSON - интернет-магазин рубашек в широком ассортименте"); // Устанавливаем имя в обратном адресе
			if ($mail->send("emerson-odessa@mail.ru", "Письмо с интернет-магазина rubaha.com.ua", $massage."<br />"."Автор :".$name)) echo true;
				else echo false;
		}
	}
	
	
	public function action_sendMassageFast(){
		
		if($this->isPost())
		{
			$number = $this->clear($_POST['tel']);
			$name = $this->clear($_POST['fio']);
			$massage = $this->clear($_POST['message']);
			
			 $mail = new Model_Mail('vitala_boris@mail.ru'); // Создаём экземпляр класса
			$mail->setFromName("EMERSON - интернет-магазин рубашек в широком ассортименте"); // Устанавливаем имя в обратном адресе
			$massages = "<h1>ПЕРЕЗВОНИТЕ МНЕ !!!!</h1>";
			$massages .= "<p>Тел: $number</p>";
			$massages .= $massage;
			if ($mail->send("emerson-odessa@mail.ru", "Письмо с интернет-магазина rubaha.com.ua", $massages."<br />"."Автор :".$name)) echo true;
				else echo false;
		}
	}
	
	
	public  function formylFilter()
	{
		
		$data['category'] = $this->m_mysql->Select("SELECT * FROM em_category");
		$data['sleeve'] = $this->m_mysql->Select("SELECT * FROM em_sleeve");
		$data['kind'] = $this->m_mysql->Select("SELECT * FROM em_kind");
		$data['sewing'] = $this->m_mysql->Select("SELECT * FROM em_sewing");
		
		
		foreach($_SESSION['filter'] as $key => $value)
		{
			unset($_SESSION['filter'][$key][0]);
				unset($_SESSION['filter'][$key][1]);
				unset($_SESSION['filter'][$key][2]);
				unset($_SESSION['filter'][$key][3]);
				unset($_SESSION['filter'][$key][4]);
				unset($_SESSION['filter'][$key][5]);
				unset($_SESSION['filter'][$key][6]);
			if(!is_array($value)) continue;
			foreach($value as $k => $v)
			{
				foreach($data[$key] as $kkkk => $vvvv)
				{
					if($v == $vvvv['id'])
							$_SESSION['filter'][$key][$v] = $vvvv['title'];
				}
						
			}
			
		}
		return $_SESSION['filter'];
	}
	
	public function action_getAutoComplete()
	{
		$string = trim(strip_tags($_POST['string']));
		$data = $this->m_mysql->Select("SELECT DISTINCT title,article FROM em_items WHERE article LIKE \"$string%\" OR title LIKE \"$string%\" GROUP BY title LIMIT 5");
		echo json_encode($data);
	}
	function action_get()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$user  = $this->Model_Users->Login($_POST['login'], $_POST['password'], isset($_POST['remember']));
		if(isset($user['name']))
		{
			$_SESSION['journals'] = $user['id_journal'];
			echo "WELCOME ". $user['name'];
		
			echo "<script>setTimeout(re,2000);function re(){location.href='/home';}</script>";
		}
		else
			echo "Error";
	}
	
	function action_addView()
	{
		$id = $_POST['data']*1;
		$object['view'] = "view+1";
		$this->Model_msql->Select("UPDATE article SET view=view+1 WHERE id=$id");
	}
	
	function action_addViewJournal()
	{
		$id = $_POST['data']*1;
		echo $id;
		$object['view'] = "view+1";
		$this->Model_msql->Select("UPDATE journals SET view=view+1 WHERE id=$id");
	}
	
	static function action_getCountInCart()
	{
		$list_id = $_SESSION['cart'];
		$count = 0;
		if(!is_array($list_id))
			return 0;
		foreach($list_id as $key => $value)
		{
			if($value == 0)
				unset($_SESSION['cart'][$key]);
			$count += $value;
		}
			return $count;
	}
	
	
	static function action_getSummInCart()
	{
		$summ = 0;
		$model = Model_Msql::Instance();
		if(is_array($_SESSION['cart']))
			foreach($_SESSION['cart'] as $key => $value)
			{
				$ids = explode("_",$key);
				$items = $model->Select("SELECT * FROM em_items WHERE id=".$ids[0]);
				//$items[0]['sizesss'] = $ids[1];
				$items[0]['count'] = $value;
				if($items[0]['discount'] > 0 )
					$items[0]['end_price'] = round((100-$items[0]['discount'])/100*$items[0]['price_roz']);
				else
					$items[0]['end_price'] = $items[0]['price_roz'];
				
				
				$datas['items'][] = $items[0];
				$summ+= $items[0]['end_price']*$items[0]['count'];
			}
		else
			$summ = 0;
		return $summ;
	}
	
	
	public function action_getUserEmail()
	{
		$email = stripslashes(strip_tags($_POST['email']));
		$data = $this->m_mysql->Select("SELECT * FROM users WHERE login='$email'");
		if(count($data) > 0 AND (strlen($email) > 3))
			echo 'true';
		else
			echo 'false';
		
	}
	
	public function action_getBasket()
	{
		$summ = 0;
		foreach($_SESSION['cart'] as $key => $value)
		{
			$ids = explode("_",$key);
			$items = $this->m_mysql->Select("SELECT * FROM em_items WHERE id=".$ids[0]);
			$items[0]['sizesss'] = $ids[1];
			$items[0]['count'] = $value;
			if($items[0]['discount'] > 0 )
				$items[0]['end_price'] = round((100-$items[0]['discount'])/100*$items[0]['price_roz']);
			else
				$items[0]['end_price'] = $items[0]['price_roz'];
			
			
			$datas['items'][] = $items[0];
			$summ+= $items[0]['end_price']*$items[0]['count'];
			$summ2+= $items[0]['count'];
		}
		$datas['allitems'] = $summ2;
		$datas['summ'] = $summ;
		 $datas = json_encode($datas);
		echo $datas;
	}

	function action_InsertBasket()
	{
		if(isset($_POST['insertBasket'])) 
		{ 
			$id =$_POST['insertBasket']*1;
			$sizes = $_POST['size'];
			$sizes = explode("_",$sizes);
			if($sizes[0] == "complect")
				$counter = $sizes[1];
			else
				$counter = 1;
			
			$sizes = $sizes[0];
			if(!empty($_SESSION['cart'][$id."_".$sizes])) 
				$_SESSION['cart'][$id."_".$sizes] += $counter; 
			else 
				$_SESSION['cart'][$id."_".$sizes] = $counter; 
		}
		
		if(empty(Route::$param['get']))
			$this->action_getBasket();

	}
	
	
	function action_unsetCart(){
		$Model_Cart = Model_Cart::Instance();
		$data = explode("_",$_POST['id']);
		$Model_Cart->unsetFromBasket($data[0],$data[1]);
	}
	
	
	public function getWhere()
	{
		$price_from = $_POST['price_from']*1-1;
		
		
		if(!empty($_POST['price_to']))
		{
			$price_to = $_POST['price_to']*1+1;
		}
			
		else{
			$price_to = 999999999;
		}
		
		$sql = " WHERE id > 0";
		
		$sql.= " AND (price_roz >= $price_from) AND (price_roz <= $price_to)";
		
		foreach($_POST as $key => $value)
		{
			if(strpos($key,'category') !==false)
				$category[] = $value;
			
			if(strpos($key,'sleeve') !==false)
				$sleeve[] = $value;
			
			if(strpos($key,'sewing') !==false)
				$sewing[] = $value;
			
			if(strpos($key,'kind') !==false)
				$kind[] = $value;
			
		}
		if(!empty($category))
		{
			$category = implode(",",$category);
			$sql.=" AND category IN ($category)";
			$_SESSION['filter']['category'] = explode(",",$category);
		
		}else{
			unset($_SESSION['filter']['category']);
		}
		
		
		if(!empty($sleeve))
		{
			$sleeve = implode(",",$sleeve);
			$sql.=" AND sleeve IN ($sleeve)";
			$_SESSION['filter']['sleeve'] = explode(",",$sleeve);
		}else{
			unset($_SESSION['filter']['sleeve']);
		}
		
		
		if(!empty($sewing))
		{
			$sql.=" AND (";
			
			foreach($sewing as $value)
				
				$or.=" sewing LIKE '%$value%' OR";
				
			$or = substr($or,0,-2).")";
		
			$sql.= $or."";
			$_SESSION['filter']['sewing'] = $sewing;
		}else{
			unset($_SESSION['filter']['sewing']);
		}
		
		
		if(!empty($kind))
		{
			$or= "";
			$sql.=" AND (";
			foreach($kind as $value)
			
				$or.=" kind LIKE '%$value%' OR";
				
			$or = substr($or,0,-2).")";
			$sql.= $or."";
			$_SESSION['filter']['kind'] =$kind;
		}else
			unset($_SESSION['filter']['kind']);
		
		
		$_SESSION['filter']['price_to'] = $price_to;
		$_SESSION['filter']['price_from'] = $price_from;
	
		return $sql;
	}
	
	
	function action_getItems()
	{
		
		
		

		if(isset(Route::$param['pages']))
			$_SESSION['count_pages'] = Route::$param['pages'];
		
		switch($_POST['sort'])
		{
			case 'NONE' : $ORDERBY = "ORDER BY date_add DESC";break;
			case 'titleDESC' : $ORDERBY = " ORDER BY title DESC";break;
			case 'titleASC' : $ORDERBY = " ORDER BY title  ASC";break;
			case 'priceASC' : $ORDERBY = " ORDER BY  price_roz  ASC";break;
			case 'priceDESC' : $ORDERBY = " ORDER BY  price_roz  DESC";break;
		}
		
		//echo ("SELECT * FROM em_items ".$this->getWhere().  $ORDERBY);
		
		$all_items = $this->m_mysql->Select("SELECT * FROM em_items ".$this->getWhere().  $ORDERBY);
		$data['count_fields'] = count($all_items);
		
		$pagination = new Model_Pagination(count($all_items));
		
		$page = isset(Route::$param['page']) ? Route::$param['page'] : 1;
		
		$start = ($page-1)*($pagination->limit) ;
		
		$data['pagination'] = $pagination->get();
		
		//$this->formylFilter($data);
		
		$data['items'] = $this->m_mysql->Select("SELECT * FROM em_items ".$this->getWhere(). $ORDERBY." LIMIT ".$start.",".$pagination->limit);
		
		
		$data['pag_from'] = $start+1;
		$data['pag_to'] = $start+count($data['items']);
		
		$curs = $this->m_mysql->Select("SELECT `value_kurs` FROM curs ORDER BY id  DESC LIMIT 1;");
		$curs = $curs[0];
		
		foreach($data['items'] as $key => $value)
		{
			if($key == 'size')
				$data['items'][$key]['size'] = explode(";",$value['size']);
		}
		
		$data['filter'] = json_encode($this->formylFilter());
//	sleep(1);
		return json_encode($data);
	}
}
