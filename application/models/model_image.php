<?php
class Model_Image extends Model
{
	// Функция изменения размера
	// Изменяет размер изображения в зависимости от type:
	//	type = 1 - эскиз
	// 	type = 2 - большое изображение
	//	rotate - поворот на количество градусов (желательно использовать значение 90, 180, 270)
	//	quality - качество изображения (по умолчанию 75%)
	
	public 	static function resize($file, $type = 2, $rotate = null, $quality = null)
	{
		echo $file['name'];
		$types = array('image/gif', 'image/png', 'image/jpeg');
		// Максимальный размер файла
		$size = 1024000*99;
		
		
		//if (!in_array($file['type'], $types))
		//	die('<p>Запрещённый тип файла. <a href="?">Попробовать другой файл?</a></p>');

	// Проверяем размер файла
		//if ($_FILES['picture']['size'] > $size)
			//die('<p>Слишком большой размер файла. <a href="?">Попробовать другой файл?</a></p>');
	
		$tmp_path = 'images/items/tmp/';
		$path = 'images/items/';

		// Ограничение по ширине в пикселях
		$max_thumb_size = 200;
		$max_size = 800;
	
		// Качество изображения по умолчанию
		if ($quality == null)
			$quality = 100;

		// Cоздаём исходное изображение на основе исходного файла
		if ($file['type'] == 'image/jpeg')
			$source = imagecreatefromjpeg($file['tmp_name']);
		elseif ($file['type'] == 'image/png')
			$source = imagecreatefrompng($file['tmp_name']);
		elseif ($file['type'] == 'image/gif')
			$source = imagecreatefromgif($file['tmp_name']);
		else
			return false;
			
		// Поворачиваем изображение
		if ($rotate != null)
			$src = imagerotate($source, $rotate, 0);
		else
			$src = $source;

		// Определяем ширину и высоту изображения
		$w_src = imagesx($src); 
		$h_src = imagesy($src);

		// В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
		if ($type == 1)
			$w = $max_thumb_size;
		elseif ($type == 2)
			$w = $max_size;

		// Если ширина больше заданной
		if ($w_src > $w)
		{
			// Вычисление пропорций
			$ratio = $w_src/$w;
			$w_dest = round($w_src/$ratio);
			$h_dest = round($h_src/$ratio);

			// Создаём пустую картинку
			$dest = imagecreatetruecolor($w_dest, $h_dest);
			
			// Копируем старое изображение в новое с изменением параметров
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

			// Вывод картинки и очистка памяти
			imagejpeg($dest, $tmp_path . $file['name'], $quality);
			imagedestroy($dest);
			imagedestroy($src);

		//	return $file['name'];
		}
		else
		{
			// Вывод картинки и очистка памяти
			imagejpeg($src, $tmp_path . $file['name'], $quality);
			imagedestroy($src);

			
			//$name =  substr(uniqid(),0,6).$file['name'];
		}
		$names =  substr(uniqid(),0,6).$file['name'];
		// Загрузка файла и вывод сообщения
		if (!@copy($tmp_path . $file['name'], $path . $names))
			echo '<p>Что-то пошло не так.</p>';
		// Удаляем временный файл
		unlink($tmp_path.$file['name']);
		
			$watermark = imagecreatefrompng('img/watermark.png');   

			// получаем значения высоты и ширины водяного знака
			$watermark_width = imagesx($watermark);
			$watermark_height = imagesy($watermark);  

			// создаём jpg из оригинального изображения
			$image_path = $path.$names;
			$image = imagecreatefromjpeg($image_path);
			//если что-то пойдёт не так
			if ($image === false) {
				return false;
			}
			$size = getimagesize($image_path);
			// помещаем водяной знак на изображение
			$dest_x = $size[0] - $watermark_width;
			$dest_y = $size[1] - $watermark_height;

			imagealphablending($image, true);
			imagealphablending($watermark, true);
			// создаём новое изображение
			imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
			imagejpeg($image,$path.$names);
			// освобождаем память
			imagedestroy($image);
			imagedestroy($watermark);  
			return $path.$names;
	}
	
	
	public static function upload($file){
		$uploaddir = 'images/items/';
		// это папка, в которую будет загружаться картинка
		$apend=date('mdHis').rand(100,1000).'.jpg'; 
		// это имя, которое будет присвоенно изображению 
		$uploadfile = "$uploaddir$apend"; 
		//в переменную $uploadfile будет входить папка и имя изображения

		// В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
		// И проходит ли изображение по весу. В нашем случае до 512 Кб
		if(($file['type'] == 'image/gif' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/png') && ($file['size'] != 0 and $file['size']<=9048000)) 
		{ 
		// Указываем максимальный вес загружаемого файла. Сейчас до 512 Кб 
		  if (move_uploaded_file($file['tmp_name'], $uploadfile)) 
		   { 
		   //Здесь идет процесс загрузки изображения 
		   $size = getimagesize($uploadfile); 
		   // с помощью этой функции мы можем получить размер пикселей изображения 
			 if ($size[0] < 111501 && $size[1]<111501) 
			 { 
			 // если размер изображения не более 500 пикселей по ширине и не более 1500 по  высоте 
			 return array(true,$uploadfile); 
			 } else {
			 return "Загружаемое изображение превышает допустимые нормы (ширина не более - 500; высота не более 1500)"; 
			 unlink($uploadfile); 
			 // удаление файла 
			 } 
		   } else {
		   return "Файл не загружен, вернитеcь и попробуйте еще раз";
		   } 
		} else { 
		return "Размер файла не должен превышать 2Мб  и файл должен быть одним из форматов: jpg;jpeg;png;gif";
		} return "fsdfsd";
	}
	
	public static function uploadMaterials($file){
		$uploaddir = 'materials/';
		// это папка, в которую будет загружаться картинка
		$apend=date('Ymd').rand(100,1000); 
		// это имя, которое будет присвоенно изображению 
		$uploadfile = "$uploaddir$apend"; 
		//в переменную $uploadfile будет входить папка и имя изображения

		// В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
		// И проходит ли изображение по весу. В нашем случае до 512 Кб
		if(($file['size']<=8048000)) 
		{ 
		// Указываем максимальный вес загружаемого файла. Сейчас до 512 Кб 
		  if (move_uploaded_file($file['tmp_name'], $uploadfile.'.'.$file['name'])) 
		  { 
			return array(true,$uploadfile.".".$file['name']); 
		  }else
			 return "Файл не загружен попробуйте еще раз";
			 // удаление файла 
		}else{
		  return "Размер файла не должен превышать 8Мб  и файл должен быть одним из форматов: jpg;jpeg;png;gif";
		} 
	
	}
}
?>