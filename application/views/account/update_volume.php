<?
if($data[1] > 0)
echo "<p  class='alert alert-success'>$conf_upd_success</p>";
?>
<form action='' method='post'>
    <label for="vol" class="col-sm-1 control-label"><?=$conf_vol?></label>
    <div class="col-sm-2">
      <input type="number" min=1 step='1' value='<?=$data[0]['vol']?>' name='vol' class="form-control" id="vol">
    </div>
    <label for="issue" class="col-sm-2 control-label"><?=$conf_iss?></label>
    <div class="col-sm-2">
      <input type="number"  min=1  value='<?=$data[0]['issue']?>' step='1' name='issue' class="form-control" >
	  <input type="hidden"   value='<?=$data[0]['id']?>' step='1' name='id'>
    </div>
	<label for="year" class="col-sm-1 control-label"><?=$conf_year?></label>
    <div class="col-sm-2">
	  <select class="form-control" name='year'>
	  <? for($i = 1950; $i <= date('Y');$i++):?>
	  <?if($i == $data[0]['year']):?>
	  <option value='<?=$i?>' selected><?=$i?></option>
		<?continue;endif?>
		<option value='<?=$i?>'><?=$i?></option>
	  <?endfor?>
	  </select>
    </div>
	 <div class="col-sm-2">
      <input type="submit" class="form-control btn btn-primary"  value='<?=$conf_save?>'>
    </div>
  </div>
 </form>