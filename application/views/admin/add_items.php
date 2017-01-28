<style>
label{
	text-align:left !important;
}

h1{
	font-size: 20px;
	border-bottom: 1px solid #EEE;
	margin-bottom: px;
	padding-bottom: 14px;
	color: #C62727;
}
</style>
<h1>Форма добавления товара</h1>
	<form action='' method='post'  role='form' class='form-horizontal' enctype="multipart/form-data">
	   <div class="form-group">
		<label for="title" class="col-sm-6 control-label">Название</label>
		<label for="code" class="col-sm-6 control-label">Код товара</label>
	   </div>
	   <div class="form-group">
		<div class="col-sm-6">
			<input type="text" class="form-control" id="title" name='title'>
		</div>
	  
		<div class="col-sm-6">
			<input type="text" class="form-control" id="code" name='code'>
		</div>
		</div>
	   <div class="form-group">
		<label for="category" class="col-sm-6 control-label">Категория</label>
		<label for="sleeve" class="col-sm-6 control-label">Рукав</label>
	   </div>
	   <div class="form-group">
		<div class="col-sm-6">
			<select class="form-control" id="category" name='category'>
			<?foreach($data['category'] as $key=>$value):?>
				<option value='<?=$value['id']?>'><?=$value['title']?></option>
			<?endforeach?>
			</select>
		</div>
		<div class="col-sm-6">
			<select class="form-control" id="sleeve" name='sleeve'>
				<?foreach($data['sleeve'] as $key=>$value):?>
					<option value='<?=$value['id']?>'><?=$value['title']?></option>
				<?endforeach?>
			</select>
		</div>
		</div>
	   <div class='form-group'>
			<label for="category" class="col-sm-1 control-label">Пошив</label>
			<div class='col-sm-5'>
			<?foreach($data['sewing'] as $key => $value):?>
				<input type='checkbox' name='sewing<?=$value['id']?>'> <?=$value['title']?><br />
			<?endforeach?>
			</div>
			<label for="sleeve" class="col-sm-1 control-label">Вид</label>
			<div class="col-sm-5">
				
				<?foreach($data['kind'] as $key => $value):?>
					<input type='checkbox' name='kind<?=$value['id']?>'> <?=$value['title']?><br />
				<?endforeach?>
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Цена оптовая</label>
			<label for="category" class="col-sm-6 control-label">Цена розничная</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="price_opt" name='price_opt'>
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="price_roz" name='price_roz'>
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Количество на складе</label>
			<label for="category" class="col-sm-6 control-label">Скидка в процентах</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="count_in_sklad" name='count_in_sklad'>
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="discount" name='discount'>
			</div>
		</div>
		
	
		
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Фото товара</label>
			<label for="category" class="col-sm-6 control-label">Размеры (указывать через двоеточие ;)</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="file" class="form-control" id="pictures" name='pictures'>
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="sizes" name='sizes'>
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Короткое описание ( 2 -4 слова)</label>
			<label for="category" class="col-sm-6 control-label">В 1 ростовке кол-во</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="slice" name='slice'>
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="complect" name='complect'>
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-12 control-label">Описание</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-12'>
					<textarea name='description'></textarea>
				<script>
				CKEDITOR.replace('description');
				</script>
			</div>
		</div>
		<input type='submit' class='btn btn-danger pull-right' value='Добавить'>
		<div style='clear:both'></div>
	 </form>
	 
	 <table class='table table-hover table-bordered'>
		<tr class='success'>
			<td>Картинка</td>
			<td>Название</td>
			<td>Код</td>
			<td>Цена опт </td>
			<td>Цена роз</td>
			<td>Остаток</td>
			<td>Скидка</td>
			<td>Продано</td>
		</tr>
	 <?php foreach($data['items'] as $k => $v):?>
		<tr>
			<td><a href='/admin/update/id/<?=$v['id']?>'><img width='45px' src='/../<?=$v['pictures']?>'></a></td>
			<td><?=$v['title']?></td>
			<td><?=$v['article']?></td>
			<td><?=$v['price_opt']?></td>
			<td><?=$v['price_roz']?></td>
			<td><?=$v['in_sklad']?></td>
			<td><?=$v['discount']?></td>
			<td><?=$v['count_sale']?></td>
		</tr>
	 <?php endforeach ?>
	 </table>