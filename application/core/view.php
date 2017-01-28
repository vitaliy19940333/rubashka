<?php

class View
{
	
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	*/
	function generate($content_view, $template_view, $data = null,$bread = null)
	{
		
		$nav = Controller_Nav::Instance();
		$menu = $nav->menu_link;
		$bred_crumb = $nav->bread_crumbs(array(route::$path[0],route::$path[1],route::$path[2]));
		
		$count_bread = count($bred_crumb);
		if(Route::$param['id'])
			$bred_crumb[$count_bread] = $bread;
		if($count_bread == 0)
		{
			$bred_crumb[0]['lang_ru'] = 'Главная';
			$bred_crumb[0]['lang_en'] = 'Home';
			$bred_crumb[0]['link'] = '/home';
		}
	/*
		
		if(is_array($data)) {
			
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		
		/*
		динамически подключаем общий шаблон (вид),
		внутри которого будет встраиваться вид
		для отображения контента конкретной страницы.
		*/
		include 'application/views/'.$template_view;
	}
	
}
