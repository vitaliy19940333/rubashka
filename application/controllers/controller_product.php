<?php

class Controller_Product extends Controller
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
		
	}
	
	public function action_index()
	{
		$this->view-->generate('product_view.php','template_view.php');
	}
	
	public function action_view()
	{
		$id = Route::$param['art'];
		$data = $this->m_mysql->Select("SELECT * FROM em_items WHERE id=$id");
		$article = $data[0]['article'];
		$article = explode("-",$article);
		$article = $article[0];
		$data['pohogie_tov'] = $this->m_mysql->Select("Select * FROM em_items WHERE article LIKE '$article-%'");
		$data['meta']['meta_descr'] = $data[0]['slise']." Размеры:".$data[0]['size'];
		$data['meta']['meta_key'] = $data[0]['title'].',рубашки, галстуки, купить рубашку, рубашки оптом';
		$data['meta']['title'] = $data[0]['title'];
		$data['top_item'] =  $this->m_mysql->Select("SELECT * FROM em_items ORDER BY count_sale DESC LIMIT 3");
		$this->view->generate('product_view.php', 'template_view.php', $data);
	}
}
