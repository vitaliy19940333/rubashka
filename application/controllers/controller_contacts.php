<?php
class Controller_Contacts extends Controller
{

	public function action_index()
	{
		$data['top_item'] =  $this->m_mysql->Select("SELECT * FROM em_items ORDER BY count_sale DESC LIMIT 3");
		$data['meta']['title'] = 'Обратная связь';
		//$data = $this->m_mysql->Select("SELECT * FROM static_content WHERE title_page='contacts'");
		$this->view->generate('contact_view.php', 'template_view.php',$data);
	}

}