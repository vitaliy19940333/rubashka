<?
if($data['result'] == true)
	echo "<p class='alert alert-success'>$success_add</p>";
?>
<form id='add_issue' class="form-horizontal" role="form" method='post'>
	<div class="form-group">
		<label for="vol" class="col-sm-2 control-label"><?=$conf_iss?> : </label>
		<div class="col-sm-3">
		 <select name='select_vol_iss' id='select_vol_iss' class="form-control">
			<?foreach($data['vol'] as $key => $value):?>
			<option value='<?=$value['id']?>'><?=$conf_vol." ".$value['vol']." ".$conf_iss." ".$value['issue']?></option>
			<?endforeach?>
		 </select>
		</div>
		<label for="vol" class="col-sm-1 control-label">DOI:</label>
		<div class="col-sm-6">
			<input type='text' name='doi' id='doi' class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="vol" class="col-sm-12 control-label"><?=$conf_title?> : </label>
		<div class="col-sm-12">
			<input type='text' name='article_title' id='article_title' class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="vol" class="col-sm-12 control-label"><?=$conf_Authors." (".$semicomas.")" ?> : </label>
		<div class="col-sm-12">
			<input type='text' name='athours' id='athours' class="form-control" placeholder='Борис В.В; Анитова З.И; Алексеев В.М.'>
		</div>
	</div>
	<div class="form-group">
		<label for="vol" class="col-sm-12 control-label"><?=$conf_key_words." (".$semicomas.")" ?> : </label>
		<div class="col-sm-12">
			<input type='text' name='key_words' id='key_words' class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="vol" class="col-sm-12 control-label"><?=$conf_link ?> : </label>
		<div class="col-sm-12">
			<input type='text' name='link' id='link' class="form-control" value='http://' placeholder='http://'>
		</div>
	</div>
	<div class="form-group">
		<label for="vol" class="col-sm-12 control-label"><?=$conf_abstract?> : </label>
		<div class="col-sm-12">
			<textarea name='abstract' id='abstract' class="form-control">
				
			</textarea>
		</div>
	</div>
	<button type='submit' class='btn btn-success pull-right'><?=$conf_add?></button>
</form>
 