<?php
class Model_Cart extends Model
{	
	private static $instance;	// экземпляр класса
	private $m_ysql;				// драйвер БД

	
	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Model_Cart();
			
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->m_ysql = model_Msql::Instance();
	}
	
	
	//Выборка товара по id
	public	function getItemsById($id)
	{
		
		$list_id = $this->parseSessionCart($id);
			
		$sql = "SELECT * FROM em_items WHERE id IN($list_id)";
		
		return $this->m_ysql->Select($sql);
			
	}
	
	
	public function parseSessionCartFROM($sess)
	{
		$list_id = array();
		
		//$sess = explode(";",$sess);
		foreach($sess as $key => $count)
		{
			$ids = explode("_",$count);
			$list_id[] = $ids[0]; 
		}
		return implode(",",$list_id);		
	}
	
	
	
	public function IncreaseSale($cart,$sign)
	{
		$cart = explode(";",$cart);
		foreach($cart as $k => $v)
		{
			$v = explode('_',$v);
			$sql = "UPDATE em_items SET count_sale=count_sale$sign".$v[2]." WHERE id=".$v[0];
			$this->m_ysql->Select($sql);
		}
	}
	
	public function getStatusOrder()
	{
		$data = ['new' => 'Новый','vobrabotke' => 'В обработке',
			'sent' => 'Отправлен',
			'finish' => 'Сделка завершена',
			'back' => 'Возврат'
		];
		
		return $data;
	}
	
	
		public	function getItemsByIdFrom($id)
	{
		$id = explode(";",$id);
		$list_id = $this->parseSessionCartFROM($id);
		
			
		$sql = "SELECT * FROM em_items WHERE id IN($list_id)";
		
		return $this->m_ysql->Select($sql);
			
	}
	
	
	
		public function getInfoCartFROM($sess)
	{
	
		$data = $this->getItemsByIdFrom($sess);
	
		$new_data = array();
		
		
		foreach($data as $k => $v)
				$new_data[$v['id']] = $v;
		$end_data = array();
		
		$i = 0;
		$summ = 0;	
		$sess = explode(";",$sess);

		foreach($sess as $k => $v)
		{
			$ids= explode("_",$v);
			
			$id = $ids[0];
			$end_data[$i] = $new_data[$id];
			$end_data[$i]['size'] = $ids[1];
			$end_data[$i++]['count'] =$ids[2];
			$summ+= $new_data[$id]['price_roz']*$end_data[$i-1]['count'];
		}
		$end_data['summ'] = $summ;
		
		return $end_data;
		
	}
	
	
	
	public function getInfoCart($sess)
	{
		$summ = 0;
		foreach($_SESSION['cart'] as $key => $value)
		{
			$ids = explode("_",$key);
			$items = $this->m_ysql->Select("SELECT * FROM em_items WHERE id=".$ids[0]);
			$items[0]['size'] = $ids[1];
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
		
		return $datas;
		
	}

	//Парисинг сессии корзины
	public function parseSessionCart($sess)
	{
		$list_id = array();
		foreach($sess as $key => $count)
		{
			$ids = explode("_",$key);
			$list_id[] = $ids[0]; 
		}
			
		return implode(",",$list_id);		
	}
	
	function unsetFromBasket($id,$size)
	{
		
		///echo $id;echo $size;
		unset ($_SESSION['cart'][$id."_".urldecode($size)]);
	}
	
	//Обновление корзины
	function updateCart($cart,$new)
	{
			foreach($cart as $key=>$value)
			{
				$cart[$key] = $new[$key];
			}
			
			$_SESSION['cart'] = $cart;
			
			return;
	}

}
