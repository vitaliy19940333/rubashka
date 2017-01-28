<?php
class Controller_Catalog extends Controller
{

	function action_index()
	{
		if(isset(Route::$param['pages']))
			$_SESSION['count_pages'] = Route::$param['pages'];
		$ajax = new Controller_Ajax();
		
		$all_items = $this->m_mysql->Select("SELECT * FROM em_items ".$ajax->getWhere());
		$data['count_fields'] = count($all_items);
		
		$pagination = new Model_Pagination(count($all_items));
		
		$page = isset(Route::$param['page']) ? Route::$param['page'] : 1;
		
		$start = ($page-1)*($pagination->limit) ;
		
		$data['pagination'] = $pagination->get();
		$data['category'] = $this->m_mysql->Select("SELECT * FROM em_category");
		$data['sleeve'] = $this->m_mysql->Select("SELECT * FROM em_sleeve");
		$data['kind'] = $this->m_mysql->Select("SELECT * FROM em_kind");
		$data['sewing'] = $this->m_mysql->Select("SELECT * FROM em_sewing");
		
		$curs = $this->m_mysql->Select("SELECT `value_kurs` FROM curs ORDER BY id  DESC LIMIT 1;");
		$curs = $curs[0]['value_kurs'];
		
		$data['min'] = $this->m_mysql->Select("SELECT MIN(price_roz) FROM em_items");
		$data['min'] = $data['min'][0];
		
		
		$data['max'] = $this->m_mysql->Select("SELECT MAX(price_opt) FROM em_items");
		$data['max'] = $data['max'][0];
		
		$data['in_one_list'] = array(12,24,36,48,60,100);
		$ajax->formylFilter($data);
		$data['items'] = $this->m_mysql->Select("SELECT * FROM em_items ".$ajax->getWhere()." ORDER BY date_add DESC LIMIT ".$start.",".$pagination->limit);
		 
		$data['top_item'] =  $this->m_mysql->Select("SELECT * FROM em_items ORDER BY count_sale DESC LIMIT 1");
		
		$data['pag_from'] = $start+1;
		$data['pag_to'] = $start+count($data['items']);
	
		$data['meta']['meta_descr'] = "Мужские рубашки, школьные рубашки, детские рубашки, подростковые рубашки, интернет-магазин rubaha.com.ua - Одесса 7км - рубашки оптом и в розницу";
		$data['meta']['meta_key'] = "рубашки мужские,рубашки школьные, купить рубашку мужскую, интернет-магазин рубашек,
										рубашки, рубаха, цена, интернет магазин сорочек, рубашки мужские s, m, l, xl, xxl";
		$data['meta']['title'] = 'Каталог рубашек';
		
		$this->view->generate('catalog_view.php', 'template_view.php', $data);
	}
	
	function action_basket()
	{
		if($this->isPost()) 
		{ 
			$id =$_POST['id']*1;
			$sizes = $_POST['size'];

			if(!empty($_SESSION['cart'][$id."_".$sizes])) 
			$_SESSION['cart'][$id."_".$sizes] += 1; 
			else 
				$_SESSION['cart'][$id."_".$sizes] = 1; 
		}
		$this->action_index();
	}

}


