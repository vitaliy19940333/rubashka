<?php extract($data);?>
<?php echo $massage;?>
<table width='100%'>
<form action='' method='post'>
	<tr>
		<td width='25%'>Заголовок на русском</td>
		<td><input type='text' name='name_ru' value='<?=$name_ru?>'></td>
	</tr>
	<tr>
		<td>Заголовок на украинском</td>
		<td><input type='text' name='name_ua' value='<?=$name_ua?>'></td>
	</tr>
	<tr>
		<td colspan='2'>Содержание записи на русском</td>
	</tr>
	<tr>
		<td colspan='2'>
			<textarea name='contain_ru'><?=$lang_ru?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan='2'>Содержание записи на украинском</td>
	</tr>
	<tr>
		<td colspan='2'>
			<textarea name='contain_ua'><?=$lang_ua?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='center'>
			<input type='submit' value='Добавить запись' name='insert'>
		</td>
	</tr>
</form>
</table>
<script>
CKEDITOR.replace('contain_ru');
CKEDITOR.replace('contain_ua');
</script>
<table class='table table-hover'>
	<tr align='center'>
		<td>Все записи конслультация</td>
	</tr>
<?php $i = 0; foreach($all as $k => $v):?>
	<tr>
		<td><a href='/admin/news/edit/<?=$v['id']?>'><?=++$i.").".$v['name_'.$_SESSION['lang']]?></a></td>
	</tr>
<?php endforeach?>
</table>