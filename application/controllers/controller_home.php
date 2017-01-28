<?php
class Controller_Home extends Controller
{

	function action_index()
	{
		$data = $this->m_mysql->Select("SELECT * FROM em_items");
		
		$data['count_zapis_all'] = count($data);
		
		$data['count_zapis_in_one_page'] = 12;
		
		$data['count_pages'] = ceil($data['count_zapis_all']/$data['count_zapis_in_one_page']);
		
		$data['count_show_pages '] =10;
		
		if(isset(Route::$param['page']))
		{
			
		}else{
			Route::$param['page'] = 1;
		}
		
		$data['active'] = Route::$param['page'] ;
		
		  if ($data['count_pages'] > 1) {     
			$data['left'] = $data['active'] - 1;
			
			$data['right'] = $data['count_pages'] - $data['active'];
			
			if ($data['left'] < floor($data['count_show_pages '] / 2)) $data['start'] = 1;
			
			else $data['start'] =$data['active'] - floor($data['count_show_pages '] / 2);
			
			$data['end'] =  $data['start'] + $data['count_show_pages '] - 1;
			
			if ($data['end'] > $data['count_pages']) 
			{
			  $data['start'] -= ($data['end'] -  $data['count_pages']);
			  
			  $data['end']= $data['count_pages'];
			  
			  if ($data['start'] < 1) $data['start'] = 1;
			}
		}
		
		$data['category'] = $this->m_mysql->Select("SELECT * FROM em_category");
		$data['sleeve'] = $this->m_mysql->Select("SELECT * FROM em_sleeve");
		$data['kind'] = $this->m_mysql->Select("SELECT * FROM em_kind");
		$data['sewing'] = $this->m_mysql->Select("SELECT * FROM em_sewing");
		$data['items'] = $this->m_mysql->Select("SELECT * FROM em_items   ORDER BY date_add DESC LIMIT 20");
		$data['meta']['meta_descr'] = 'Мужские рубашки, школьные рубашки, детские рубашки, подростковые рубашки, интернет-магазин rubaha.com.ua - Одесса 7км';
		$data['meta']['meta_key'] = 'интернет магазин мужские рубашки и аксессуары, купить рубашки мужские s, m, l. xl, xxl 
										недорого в одессе, продажа сорочек онлайн, классические рубашки и сорочки для мужчин, рубашки больших размеров, приталенные рубашки, рубашки под джинсы, офисная рубашка, детские рубашки, бабочки, галстуки, аксессуары, цена, фото, красивые, стильные
										';
		$data['meta']['title'] = 'Главная';
		$this->view->generate('catalog_home.php', 'template_view.php', $data);
	}

}