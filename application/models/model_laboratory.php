<?php
class Model_Laboratory extends Model
{
	static public function intro($title)
	{
		$model = Model_Msql::Instance();
		$laboratories = $model->Select("SELECT * FROM $title ORDER BY id DESC");
		foreach($laboratories as $attr => $laboratory)
		{
			preg_match_all('/src=".*?"/', $laboratory['lang_ru'], $result, PREG_PATTERN_ORDER);
			$laboratories[$attr]['img']= $result[0][0];
		}
		return $laboratories;
	}
	
	static public function getOne($id)
	{
		$model = Model_Msql::Instance();
		$laboratories = $model->Select("SELECT * FROM laboratory WHERE id='$id'");
		return $laboratories[0];
	}
	
	static public function getAllSrc($title,$id)
	{
		$src = array();
		$model = Model_Msql::Instance();
		$laboratories = $model->Select("SELECT * FROM static_content WHERE title_page='$id'");
		preg_match_all('/src=".*?"/', $laboratories[0]['lang_ru'], $result, PREG_PATTERN_ORDER);
		for($i = 0; $i < count($result[0]); $i++)
			$src[]= $result[0][$i];
		return $src;
	}
	

}
?>