<?php
class Controller_Search extends Controller
{
	public $stringSearch;
	
	public function action_index()
	{
		if($this->isPost())
			$string = trim(strip_tags($_POST['search']));
		elseif(isset(Route::$param['article']))
			$string = trim(stripslashes(strip_tags(Route::$param['article'])));
		else
			header("LOCATION: /home");
		
		$data['query'] = $string;
		$data['items'] = $this->m_mysql->Select("SELECT * FROM em_items WHERE article LIKE \"$string%\" OR title LIKE \"%$string%\"");
		$data['top_item'] =  $this->m_mysql->Select("SELECT * FROM em_items ORDER BY count_sale DESC LIMIT 3");		
		$data['meta']['meta_descr'] = "Поиск мужских рубашек, дестких рубашек,  школьных рубашек";
		$data['meta']['meta_key'] = "рубашки, сорочки, галстуки, бабочки, десткие рубашки, рубашки детский сад";
		$data['meta']['title'] = 'Поиск в интернет-магазине Emerson';
		
		$this->view->generate('search.php', 'template_view.php', $data);
	}
}