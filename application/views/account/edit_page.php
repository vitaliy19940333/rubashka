<form action='' method='post'>
	<h1><?=$data[0]['title_ru']?></h1>
	<textarea name='consist_ru'><?=$data[0]['lang_ru']?></textarea>
<h1><?=$data[0]['title_ua']?></h1>
	<textarea name='consist_ua'><?=$data[0]['lang_ua']?></textarea>
	<input type='submit'>
</form>
<script>
CKEDITOR.replace('consist_ru');
CKEDITOR.replace('consist_ua');
</script>