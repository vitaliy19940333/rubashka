<?php
class Model_Journals extends Model
{	
	private static $instance;	// экземпляр класса
	private $msql;				// драйвер БД

	
	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Model_Journals();
			
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = model_Msql::Instance();
	}
	
	
	public function getJournalByid($id)
	{
		$sql = "SELECT frequency.lang_". $_SESSION['lang']."  as frequency,publisher_eng,view,publisher_URL,abbr_eng,orig_title,orig_abbr,e_issn,p_issn,start_year,license_type,url_journal,publisher_orig,publisher_orig,editor_in_chief,email,description,cover,foreign_members,english_article,review,agreement,payment,site_lang,open_access,status_journal.id as id_stat,alpha2,basic_disciplines,status_".$_SESSION['lang']." as status,date_added,journals.id,`title_eng`,`start_year`,`base`,`GSJP_VALUE`,country.lang_".$_SESSION['lang']." as country,basic_discipline.title_".$_SESSION['lang']." as discipline
					FROM journals,country,basic_discipline,status_journal,frequency
					WHERE journals.country=country.alpha2 AND basic_discipline.id=journals.basic_disciplines AND journals.frequency=frequency.id AND status_journal.id=journals.status AND journals.id=$id";
		
		$journal =  $this->msql->Select($sql);
		$journal[0]['publisher_URL'] = $this->parse_link($journal[0]['publisher_URL']);
		$journal[0]['url_journal'] = $this->parse_link($journal[0]['url_journal']);
		return $journal;
	}
	
	
	function parse_link($link)
	{
		if(strpos($link, 'http://') !== 0) {
			$link = 'http://' . $link;
		}
		
		return $link;
	}
	
	function getInfo($id)
	{
		$sql = "SELECT * from journals WHERE id=$id";
		$journal =  $this->msql->Select($sql);
		$journal[0]['publisher_URL'] = $this->parse_link($journal[0]['publisher_URL']);
		$journal[0]['url_journal'] = $this->parse_link($journal[0]['url_journal']);
		return $journal[0];
	}
	
	public function getAllFrequency()
	{
		return $this->msql->Select("SELECT * FROM frequency");
	}
	
	
	public function getStatus()
	{
		return $this->msql->Select("SELECT * FROM status_journal");
	}
	
	public function UpdateStatus($id,$id_stat)
	{
		return $this->msql->Update('journals',array('status'=>$id_stat),"id=$id");
	}
	
	//Расчет GSJP Value
	public function calc_value_gsjp($data)
	{
		$value = 0;
		$value+= 4*(($data['foreign_members']*1)/100);
		$value+= 4*(($data['english_article']*1)/100);
		switch($data['review'])
		{
			case 'd' : $value+=3;break;
			case 's' : $value+=1.5;break;
			case 'o' : $value+=0.5;break;
		}
		$value+= ($data['open_access'])*1+1;
		$value+= ($data['agreement'])*1+1;
		if(strlen($data['e_issn']) > 3)
			$value+=2;
		else
			$value+=1;
		$old_journal = date('Y') - $data['start_year']*1;
		if($old_journal > 20) $value+=3;
		elseif($old_journal > 9) $value+=2;
		elseif($old_journal > 5) $value+=1;
		else $value+=0.5;
		if($data['payment']) $value+=1;
		else $value+=2;
		foreach($this->getAllDiscipline() as $key => $val)
		{
			if( $val['id'] == $data['basic_disciplines'])
			{
				switch($val['title_en'])
				{
					case "Interdisciplinary" : $value+=3;break;
					case "Applied" : $value+=3;break;
					case "Formal" : $value+=1;break;
					case "Social" : $value+=1;break;
					case "Physical" : $value+=2;break;
					case "Life" : $value+=2;break;
				}
			}
		}
		
		if(strlen(trim($data['url_journal'])) > 3) $value+= 2;
		else $value+= 1;
		
		switch(($data['site_lang'])*1)
		{
			case 3 : $value+=3;break;
			case 2 : $value+=2;break;
			case 1: $value+=1;break;
		}
		return $value;
	}
	
	public function getAllDiscipline()
	{
			return $this->msql->Select("SELECT * FROM basic_discipline");
	}
	
	public function getStatusJournal($id)
	{
		$sql = ("SELECT status_journal.id,status_en FROM status_journal,journals WHERE journals.status = status_journal.id AND journals.id=$id");
		return $this->msql->Select($sql)[0];
	}
	
	public function getallCountry()
	{
		return $this->msql->Select("SELECT * FROM country");
	}
	
	
	public function uploadImage($file,$last_file = '')
	{
		$path = 'images/cover/';
		$link = uniqid().$this->translit($file['name']);
		if(is_uploaded_file($file['tmp_name']))
		{
			if(move_uploaded_file($file['tmp_name'],$path.$link))
			{
				if(is_file($last_file))
					unlink($last_file);
				return $path.$link;
			}else
					return $last_file;
		}else{
			return $last_file;
		}
	}
	
	public function Update($obj,$id)
	{
		return $this->msql->Update("journals",$obj,"id=$id");
	}
	
	public function getAllArticle($id)
	{
		$model_volume = Model_volume::Instance();
		return $model_volume->gettAllArtInVol($id);
	}
	
	function countJournals()
	{
		return $this->msql->Select("SELECT count(*) as cou FROM journals");
	}
	
	function countArticle()
	{
		return $this->msql->Select("SELECT count(*) as cou FROM article");
	}
	
	function getStatisticaFromDiscipline()
	{
		return $this->msql->Select("SELECT article.id, title_ru, title_en, COUNT( title_ru ) AS alls, SUM( article.view )  as sommo
									FROM article, journals, volumes, basic_discipline
									WHERE journals.id = volumes.id_journal
									AND volumes.id = article.issue
									AND journals.basic_disciplines = basic_discipline.id
									GROUP BY title_ru");
										}


	function getStatistica()
	{
		$statist['indexing']['count'] = $this->msql->Select("SELECT count(id) as id FROM journals WHERE base=1")[0];
		$statist['support']['count'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE base=2")[0];
		$statist['publishing']['count'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE base=3")[0];
		
		$statist['indexing']['issn'] = $this->msql->Select("SELECT count(id) as id FROM journals WHERE e_issn != \"\" AND base=1")[0];
		$statist['support']['issn'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE e_issn != \"\" AND base=2")[0];
		$statist['publishing']['issn'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE e_issn != \"\" AND base=3")[0];
		
		$statist['indexing']['site'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE url_journal != \"\" AND base=1")[0];
		$statist['support']['site'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE url_journal != \"\" AND base=2")[0];
		$statist['publishing']['site'] = $this->msql->Select("SELECT count(id)  as id FROM journals WHERE url_journal != \"\" AND base=3")[0];
		
		$statist['indexing']['val'] = $this->msql->Select("SELECT avg(GSJP_VALUE)  as val FROM journals WHERE base=1")[0];
		$statist['support']['val'] = $this->msql->Select("SELECT avg(GSJP_VALUE)  as val FROM journals WHERE base=2")[0];
		$statist['publishing']['val'] = $this->msql->Select("SELECT avg(GSJP_VALUE)  as val FROM journals WHERE base=3")[0];
		
		return $statist;
	}
	
	function getCountJournalsIssue()
	{
		return $this->msql->Select("SELECT article.id FROM journals,volumes,article WHERE journals.id=".$_SESSION['journals']." AND journals.id=volumes.id_journal AND volumes.id=article.issue ");
	}
	
	function getCountJournalsArticle()
	{
		return $this->msql->Select("SELECT volumes.id FROM journals,volumes WHERE journals.id=".$_SESSION['journals']." AND journals.id=volumes.id_journal");
	}
	
	
	public function translit($str)
	{
		$translit = array(
		   
					'а' => 'a',   'б' => 'b',   'в' => 'v',
		  
					'г' => 'g',   'д' => 'd',   'е' => 'e',
		  
					'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
		  
					'и' => 'i',   'й' => 'j',   'к' => 'k',
		  
					'л' => 'l',   'м' => 'm',   'н' => 'n',
		  
					'о' => 'o',   'п' => 'p',   'р' => 'r',
		  
					'с' => 's',   'т' => 't',   'у' => 'u',
		  
					'ф' => 'f',   'х' => 'x',   'ц' => 'c',
		  
					'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
		  
					'ь' => 'bb',  'ы' => 'y',   'ъ' => '\'\'',
		  
					'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
				  
		  
					'А' => 'A',   'Б' => 'B',   'В' => 'V',
		  
					'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
		  
					'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',
		  
					'И' => 'I',   'Й' => 'J',   'К' => 'K',
		  
					'Л' => 'L',   'М' => 'M',   'Н' => 'N',
		  
					'О' => 'O',   'П' => 'P',   'Р' => 'R',
		  
					'С' => 'S',   'Т' => 'T',   'У' => 'U',
		  
					'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',
		  
					'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',
		  
					'Ь' => 'bb',  'Ы' => 'Y',   'Ъ' => '\'\'',
		  
					'Э' => 'E',   'Ю' => 'YU',  'Я' => 'YA',' ' => '__', '№' => 'nomer',"~"=>"tild"
				);
				return strtr($str,$translit);
		}
	
}
