<style>
label
{
	text-align:left !important;
}
</style>
<?
if(isset($data['result_add']))
{
	if($data['result_add'])
	{
		echo "<p class='alert alert-success'>Login : ".$data['result_add'][0]." ;<br />   Password : ".$data['result_add'][1]."</p>";
	}
		
	else
		echo "<br /><p class='alert alert-danger'>".$err_add."</p>";
}
?><form id='add_journal' class="form-horizontal" role="form" method='post' enctype='multipart/form-data'>
  <div class="form-group">
    <label for="TitleEng" class="col-sm-12 control-label"><?=$TitleEng?></label>
    <div class="col-sm-12">
      <input type="text" name='TitleEng' value='<?=$data['info']['title_eng']?>' class="form-control" id="TitleEng">
    </div>
  </div>
  <div class="form-group">
    <label for="TitleOriginal" class="col-sm-12 control-label"><?=$TitleOriginal?></label>
    <div class="col-sm-12">
      <input type="text" class="form-control" name='TitleOriginal' id="TitleOriginal" value='<?=$data['info']['orig_title']?>'>
    </div>
  </div>
     <div class="form-group">
    <label for="abrEng" class="col-sm-6 control-label"><?=$abrEng?></label>
	<label for="abrOrig" class="col-sm-6 control-label"><?=$abrOrig?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
      <input type="text" class="form-control"  name='abrEng'  id="abrEng" value='<?=$data['info']['abbr_eng']?>'>
    </div>
    <div class="col-sm-6">
     <input type="text" class="form-control" name='abrOrig'  id="abrOrig" value='<?=$data['info']['orig_abbr']?>'>
    </div>
  </div>
   <div class="form-group">
    <label for="e_issn" class="col-sm-2 control-label">E-ISSN</label>
	 <div class="col-sm-4">
      <input type="text" class="form-control" id="e_issn" name='e_issn' value='<?=$data['info']['e_issn']?>'>
    </div>
	<label for="p_issn" class="col-sm-2 control-label">P-ISSN</label>
	<div class="col-sm-4">
      <input type="text" class="form-control" id="p_issn" name='p_issn' value='<?=$data['info']['p_issn']?>'>
    </div>
  </div>
   <div class="form-group">
    <label for="discipline_select" class="col-sm-6 control-label"><?=$discipline_select?></label>
	<label for="country_select" class="col-sm-6 control-label"><?=$country_select?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
		<select class="form-control" id="discipline_select" name='discipline_select'>
			<?foreach($data['discipline_all'] as $key => $value):?>
			<?if($data['info']['basic_disciplines'] == $value['id']):?>
				<option value='<?=$value['id']?>' selected><?=$value['title_'.$_SESSION['lang']]?></option>
			<?continue;endif;?>
				<option value='<?=$value['id']?>'><?=$value['title_'.$_SESSION['lang']]?></option>
			<?endforeach?>
		</select>
    </div>
    <div class="col-sm-6">
     <select class="form-control" id="country" name='country'>
			<?foreach($data['country'] as $key => $value):?>
			<?if($data['info']['country'] ==$value['alpha2']):?>
				<option value='<?=$value['alpha2']?>' selected><?=$value['lang_'.$_SESSION['lang']]?></option>
			<?continue;endif;?>
				<option value='<?=$value['alpha2']?>'><?=$value['lang_'.$_SESSION['lang']]?></option>
			<?endforeach?>
	</select>
    </div>
  </div>
   <div class="form-group">
    <label for="start_year" class="col-sm-6 control-label"><?=$start_year?></label>
	<label for="frequency" class="col-sm-6 control-label"><?=$frequency?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
		<input type="number" min='1850' max='<?=date("Y")?>' class="form-control" id="start_year" name='start_year' value='<?=$data['info']['start_year']?>'>
    </div>
    <div class="col-sm-6">
		<select class="form-control" id="frequency" name='frequency'>
			<?foreach($data['frequency'] as $key => $value):?>
			<?if($data['info']['frequency'] ==$value['id']):?>
				<option value='<?=$value['id']?>' selected><?=$value['lang_'.$_SESSION['lang']]?></option>
			<?continue;endif;?>
				<option value='<?=$value['id']?>'><?=$value['lang_'.$_SESSION['lang']]?></option>
			<?endforeach?>
		</select>
    </div>
  </div>
  <div class="form-group">
    <label for="license_type_select" class="col-sm-6 control-label"><?=$license_type_select?> Creative Commons </label>
	<label for="open_access_select" class="col-sm-6 control-label"><?=$open_access_select?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
		<select class="form-control" id="license_type" name='license_type'>
			<option value='CC-BY'>CC-BY</option>
			<option value='C-BY-SA'>CC-BY-SA</option>
			<option value='CC-BY-ND'>CC-BY-ND</option>
			<option value='CC-BY-NC-'>CC-BY-NC-SA</option>
			<option value='CC-NC-N'>CC-NC-ND</option>
			<option value='Another'>Another</option>
			<option value='<?=$data['info']['license_type']?>' selected><?=$data['info']['license_type']?></option>
		</select>
    </div>
    <div class="col-sm-6">
     <select class="form-control" id="open_access" name='open_access'>
			<?if(!$data['info']['open_access']) $checked = 'selected';?>
			<option value='1'>YES</option>
			<option value='2' <?=$checked?>>NO</option>
	</select>
    </div>
  </div>
  <div class="form-group">
    <label for="url_journal" class="col-sm-6 control-label"><?=$url_journal?></label>
	<label for="multylang" class="col-sm-6 control-label"><?=$multylang?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
		<input type="text" class="form-control" id="url_journal" name='url_journal' value='<?=$data['info']['url_journal']?>'>
    </div>
    <div class="col-sm-6">
		<input type="number" min='1' step='1' class="form-control" id="multylang" name='multylang' value='<?=$data['info']['site_lang']?>'>
    </div>
  </div>
   <div class="form-group">
    <label for="publishTitleEng" class="col-sm-12 control-label"><?=$publishTitleEng?></label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="publishTitleEng" name='publishTitleEng' value='<?=$data['info']['publisher_eng']?>'>
    </div>
  </div>
  <div class="form-group">
    <label for="publishTitleOrig" class="col-sm-12 control-label"><?=$publishTitleOrig?></label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="publishTitleOrig" name='publishTitleOrig'  value='<?=$data['info']['publisher_orig']?>'>
    </div>
  </div>
   <div class="form-group">
    <label for="editor_chief" class="col-sm-6 control-label"><?=$editor_chief?></label>
	<label for="email" class="col-sm-6 control-label"><?=$email_c?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
		<input type="text" class="form-control" id="editor_chief" name='editor_chief' value='<?=$data['info']['editor_in_chief']?>'>
    </div>
    <div class="col-sm-6">
		<input type="text" class="form-control" id="email" name='email' value='<?=$data['info']['email']?>'>
    </div>
 </div>
 <div class="form-group">
    <label for="url_publish" class="col-sm-6 control-label"><?=$url_publish?></label>
	<label for="permiss" class="col-sm-6 control-label"><?=$permiss?></label>
  </div>
  <div class="form-group">
    <div class="col-sm-6">
		<input type="text" class="form-control" id="url_publish"  name='url_publish'  value='<?=$data['info']['publisher_URL']?>'>
    </div>
    <div class="col-sm-6">
     <input type="number" min='1' max='100' step='1' class="form-control" id="procent_publish"  name='procent_publish' value='<?=$data['info']['foreign_members']?>'>
    </div>
  </div>
   <div class="form-group">
    <label for="license_agreement" class="col-sm-5 control-label"><?=$license_agreement?> ?</label>
	 <div class="col-sm-1">
	 <?if($data['info']['agreement']) $check = 'checked';?>
		<input type="checkbox" class="form-control" id="license_agreement" name='license_agreement' <?=$check?>>
    </div>
	 <label for="peyment_article" class="col-sm-5 control-label"><?=$peyment_article?></label>
	 <div class="col-sm-1">
	  <?if($data['info']['payment']) $check_peym = 'checked';?>
		<input type="checkbox" class="form-control" id="peyment_article" name='peyment_article' <?=$check_peym?>>
    </div>
  </div>
  <div class="form-group">
    <label for="review" class="col-sm-6 control-label"><?=$review?></label>
	<label for="eng_article" class="col-sm-6 control-label"><?=$eng_article?></label>
  </div>
   <div class="form-group">
    <div class="col-sm-6">
		 <select class="form-control" id="review" name='review'>
			<? foreach($data['review'] as $key => $value):?>
			<?if($data['info']['review'] == $key):?>
				<option value='<?=$key?>' selected><?=$value?></option>
			<?continue;endif;?>
			<option value='<?=$key?>'><?=$value?></option>
			<?endforeach;?>
		</select>
    </div>
    <div class="col-sm-6">
		<input type="text" class="form-control" id="eng_article" name='eng_article'  value='<?=$data['info']['english_article']?>'>
    </div>
  </div>
  <div class="form-group">
	 <label for="description" class="col-sm-12 control-label"><?=$description?></label>
  </div>
  <div class="form-group">
	 <div class="col-sm-12">
		<textarea id='description' class="form-control" rows='5' id= "description" name='description'><?=$data['info']['description']?></textarea>
	</div>
  </div>
  <div class='form-group'>
	  <div class="col-sm-12" id='result'>
	</div>
  </div>
   <div class="form-group">
    <div class="col-sm-3">
		<label>Cover</label>
    </div>
    <div class="col-sm-4">
		<input type="file" id='cover_journal' class="form-control"  name='cover'>
		<input type="hidden" id='last_cover' class="form-control"  name='last_cover' value='<?=$data['info']['cover']?>'>
    </div>
	<div class='col-sm-5'>
		 <button name='insertjournal' type="submit" class="btn btn-success"><?=$conf_save?></button>
	</div>
 </div>
</form>
<script>
		$("#add_journal").on("submit",function(){

			var cover = document.getElementById("cover_journal");
			var lastcover = document.getElementById("last_cover");
			var jpgs = cover.value.substr(-3);
			var flag_cover = false;
			if(jpgs == "jpg"  || jpgs == "gif"  || jpgs == "png" || jpgs == "JPG"  || jpgs == "GIF"  || jpgs == "PNG")
			{
				flag_cover = true;
			}
			else if(cover.value.substr(-4) == "JPEG" || cover.value.substr(-4) == "jpeg")
				flag_cover = true;
			else if(cover.value.length == 0 && lastcover.value.length > 4)
				flag_cover = true;
			if(!flag_cover)
			{
				result.innerHTML="";
				result.innerHTML="<p class='alert alert-danger'>Обложка должны иметь один из следующих форматов : jpg/jpeg/png/gif</p>";
				return false;
			}
	});
</script>