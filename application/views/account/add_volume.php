<form id='add_volume' class="form-horizontal" role="form" method='post'>
  <div class="form-group">
    <label for="vol" class="col-sm-1 control-label"><?=$conf_vol?></label>
    <div class="col-sm-2">
      <input type="number" min=1 step='1' value='1' name='vol' class="form-control" id="vol">
    </div>
    <label for="issue" class="col-sm-2 control-label"><?=$conf_iss?></label>
    <div class="col-sm-2">
      <input type="number"  min=1  value='1' step='1' name='issue' class="form-control" >
    </div>
	<label for="year" class="col-sm-1 control-label"><?=$conf_year?></label>
    <div class="col-sm-2">
	  <select class="form-control" name='year'>
	   <? for($i = date('Y'); $i >=1950;$i--):?>
		<option value='<?=$i?>'><?=$i?></option>
	  <?endfor?>
	  </select>
    </div>
	 <div class="col-sm-2">
      <input type="submit" class="form-control btn btn-primary"  value='<?=$conf_add?>'>
    </div>
  </div>
 </form>
 <table id='list_val' class='table table-hover'>
	<tr class='title'>
		<td>#</td>
		<td><?=$conf_year?></td>
		<td><?=$conf_vol?></td>
		<td><?=$conf_iss?></td>
		<td>Действия</td>
	</tr>
	<?$i = 0;foreach($data['vol'] as $key => $value):?>
	<tr>
		<td><?=++$i?></td>
		<td><?=$value['year']?></td>
		<td><?=$value['vol']?></td>
		<td><?=$value['issue']?></td>
		<td><a href='/myprofile/volume/update/<?=$value['id']?>'>Изменить</a>/<a  onclick='return control_yes()' href='/myprofile/volume/delete/<?=$value['id']?>'>Удалить</a></td>
	</tr>
	<?endforeach?>
 </table>
 <script>
	$("#list_val tr:even").addClass("active");
	function control_yes()
	{
		
		return confirm("<?=$conf_delete ?>");
	}
 </script>
