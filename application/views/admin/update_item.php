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
<div class='col-md-12'>
<h1>Форма добавления товара</h1>
	<form action='' method='post'  role='form' class='form-horizontal' enctype="multipart/form-data">
	   <div class="form-group">
		<label for="title" class="col-sm-6 control-label">Название</label>
		<label for="code" class="col-sm-6 control-label">Код товара</label>
	   </div>
	   <div class="form-group">
		<div class="col-sm-6">
			<input type="text" class="form-control" id="title" name='title' value='<?=$data['item']['title']?>'>
		</div>
	  
		<div class="col-sm-6">
			<input type="text" class="form-control" id="code" name='code' value='<?=$data['item']['article']?>'>
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
				<option value='<?=$value['id']?>' <?php if($data['item']['category'] == $value['id']) echo "selected"?>><?=$value['title']?></option>
			<?endforeach?>
			</select>
		</div>
		<div class="col-sm-6">
			<select class="form-control" id="sleeve" name='sleeve'>
				<?foreach($data['sleeve'] as $key=>$value):?>
					<option value='<?=$value['id']?>' <?php if($data['item']['sleeve'] == $value['id']) echo "selected"?>><?=$value['title']?></option>
				<?endforeach?>
			</select>
		</div>
		</div>
	   <div class='form-group'>
			<label for="category" class="col-sm-1 control-label">Пошив</label>
			<div class='col-sm-5'>
			<?foreach($data['sewing'] as $key => $value):?>
				<input type='checkbox' name='sewing<?=$value['id']?>' <?php $ar = explode(";",$data['item']['sewing']);   if(in_array($value['id'],$ar)) echo 'checked=checked'  ?>> <?=$value['title']?><br />
			<?endforeach?>
			</div>
			<label for="sleeve" class="col-sm-1 control-label">Вид</label>
			<div class="col-sm-5">
				
				<?foreach($data['kind'] as $key => $value):?>
					<input type='checkbox' name='kind<?=$value['id']?>'  <?php $ar = explode(";",$data['item']['sewing']);   if(in_array($value['id'],$ar)) echo 'checked=checked'  ?>><?=$value['title']?><br />
				<?endforeach?>
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Цена оптовая</label>
			<label for="category" class="col-sm-6 control-label">Цена розничная</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="price_opt" name='price_opt' value='<?=$data['item']['price_opt']?>'> 
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="price_roz" name='price_roz' value='<?=$data['item']['price_roz']?>'> 
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Количество на складе</label>
			<label for="category" class="col-sm-6 control-label">Скидка в процентах</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="count_in_sklad" name='count_in_sklad'  value='<?=$data['item']['in_sklad']?>'> 
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="discount" name='discount' value='<?=$data['item']['discount']?>'> 
			</div>
		</div>
		
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">META DESCRIPTION</label>
			<label for="category" class="col-sm-6 control-label">META KEYWORDS</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="meta_descr" name='meta_descr'  value='<?=$data['item']['meta_descr']?>'> 
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="meta_keywords" name='meta_keywords'  value='<?=$data['item']['meta_keyword']?>'> 
		</div>
		</div>
		
		<div class='form-group'>
			<label for="category" class="col-sm-6 control-label">Фото товара</label>
			<label for="category" class="col-sm-6 control-label">Размеры (указывать через запятую)</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<input type="file" class="form-control" id="pictures" name='pictures'>
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="sizes" name='sizes' value='<?=$data['item']['size']?>'> 
				<input type="hidden" class="form-control" name='id' value='<?=$data['item']['id']?>'> 
				<input type="hidden" class="form-control" name='link' value='<?=$data['item']['pictures']?>'> 
			</div>
		</div>
		<div class='form-group'>
			<div class='col-sm-6'>
				<label for="category" class="col-sm-6 control-label">Короткое описание ( 5 -6 слов)</label>
			</div>
			<div class='col-sm-6'>
				<input type="text" class="form-control" id="slice" name='slice' <?=$data['item']['slise']?>>
			</div>
		</div>
		<div class='form-group'>
			<label for="category" class="col-sm-12 control-label">Примечание</label>
		</div>
		<div class='form-group'>
			<div class='col-sm-12'>
					<textarea name='description'><?=$data['item']['description']?></textarea>
				<script>
				CKEDITOR.replace('description');
				</script>
			</div>
		</div>
		<input type='submit' class='btn btn-danger pull-right' value='Сохранить'>
		<div style='clear:both'></div>
	 </form>
	 </div>