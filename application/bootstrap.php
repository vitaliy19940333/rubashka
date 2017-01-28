<?php
// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

class Controller_Nav extends Controller
{
	public static $tree;
	public static $Instance;
	public $menu_link;
	
	public  static function  Instance()
	{
		if(self::$Instance == null)
			self::$Instance = new Controller_Nav();
		return self::$Instance;
	}
	
	public function __construct()
	{
		parent::__construct();
		$allLink = $this->m_mysql->Select("Select * from navigation");
		$this->view_cat($this->parentChild($allLink));
		
		//Получаем подготовленный массив с данными
		$cat  = $this->getCat(); 

		//Создаем древовидное меню
		$tree = $this->getTree($cat);
		
		$this->menu_link = $this->showCat($tree);
		
	}	
	
	
	//Получаем массив нашего меню из БД в виде массива
	public function getCat(){
		$this->model = Model_Users::Instance();
		
		if(($this->model->Can('all')))
			$admim_menu_show = 'admin';
		else{
			$admim_menu_show = 'us';
		}
			
		$allLink = $this->m_mysql->Select("Select * from navigation WHERE category='$admim_menu_show'");
		
		//Создаем масив где ключ массива является ID меню
		$cat = array();
		foreach($allLink as $key => $value)
			$cat[$value['id']] = $value;
		
		return $cat;
	}

	
	
	//Функция построения дерева из массива
	public function getTree($dataset) {
		$tree = array();

		foreach ($dataset as $id => &$node) {    
			//Если нет вложений
			if (!$node['parent_id']){
				$tree[$id] = &$node;
			}else{ 
				//Если есть потомки то перебераем массив
				$dataset[$node['parent_id']]['childs'][$id] = &$node;
			}
		}
		return $tree;
	}
	
	//Шаблон для вывода меню в виде дерева
	public function tplMenu($category,$link){
		$link.=str_replace(" ","","/".$category['link']);
	
		$menu = '<li>
			<a href="'.$link .'" title="">'. 
			$category['lang_'.$_SESSION['lang']].'</a>';
			
			if(isset($category['childs'])){
				$menu .= '<ul>'. $this->showCat($category['childs'],$link) .'</ul>';
			}
		$menu .= '</li>';
		
		return $menu;
	}
	
	/**
	* Рекурсивно считываем наш шаблон
	**/
	public function showCat($data,$link=''){
		$string = '';
		
		foreach($data as $item){
			$string .= $this->tplMenu($item,$link);
		}
		return $string;
	}
		
	
	public function bread_crumbs($path)
	{
		if(($this->model->Can('all')))
			$admim_menu_show = 'admin';
		else{
			$admim_menu_show = 'users';
		}
		return $result = $this->m_mysql->Select("SELECT * FROM navigation WHERE  category='$admim_menu_show' AND (link='".$path[0]."' OR link='".$path[1]."' OR link='".$path[2]."') LIMIT 3");
	}
	
	private function parentChild($result)
	{
				$rows = array();
				foreach($result as $key => $value)
				{
					if(empty([$value['parent_id']])) {
						$rows[$value['parent_id']] = array();
					}
						$rows[$value['parent_id']][] = $value;
				}
				return $rows;
	}
			
			
	private function view_cat($arr,$parent_id = 0) {

		if(empty($arr[$parent_id])) {
			return;
		}
		self::$tree = self::$tree.'<ul>';
		for($i = 0; $i < count($arr[$parent_id]);$i++) {
			if($parent_id != 0)
				self::$tree = self::$tree."<li><a href=http://".$_SERVER['SERVER_NAME']."/".$arr[0][$parent_id-1]['link']."/".$arr[$parent_id][$i]['link'].">".$arr[$parent_id][$i]['lang_'.$_SESSION['lang']]."</a>";
			else
				self::$tree = self::$tree."<li><a href=http://".$_SERVER['SERVER_NAME']."/".$arr[0][$i]['link'].">".$arr[$parent_id][$i]['lang_'.$_SESSION['lang']]."</a>";
			$this->view_cat($arr,$arr[$parent_id][$i]['id']);
			self::$tree = self::$tree.'</li>';
		}
		self::$tree = self::$tree.'</ul>';
	}
}


function __autoload($name)
{
	//echo __FILE__;
	@include 'models/'.strtolower($name).'.php';
	@include 'controllers/'.strtolower($name).'.php';
}
require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
