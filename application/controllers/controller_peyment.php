<?php
class Controller_Peyment extends Controller
{

	
	public function action_index()
	{
		
		$data['src'] = Model_Laboratory::getAllSrc('static_content','peyment');
		$data['items'] = $this->m_mysql->Select("SELECT * FROM static_content WHERE title_page='peyment'");
		$data['items'] = $data['items'][0];
		$data['meta']['meta_descr'] = $data['items']['meta_descr'];
		$data['meta']['meta_key'] = $data['items']['meta_key'];
		$data['meta']['title'] = $data['items']['title_ru'];
		$this->view->generate('peyment.php', 'template_view.php',$data);
	}
	
	
}