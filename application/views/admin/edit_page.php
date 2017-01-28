<form action='' method='post'>
	<h1><?=$data[0]['title_ru']?></h1>
	<textarea name='consist_ru'><?=$data[0]['lang_ru']?></textarea>
<h1><?=$data[0]['title_en']?></h1>
	<textarea name='consist_ua'><?=$data[0]['lang_ua']?></textarea>
	<input class='btn btn-primary' type='submit'>
</form>
<script>
CKEDITOR.replace('consist_ru');
CKEDITOR.replace('consist_ua');
</script>