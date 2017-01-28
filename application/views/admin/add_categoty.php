
	<form action='' method='post'>
		<div class='col-md-12 col-xs-12 col-lg-12'>
			<div class="form-group">
				<label for="exampleInputEmail1">Название категории</label>
			</div>
		</div>
		<div class='col-md-6 col-xs-12 col-lg-6'>
			<div class="form-group">
				<input type="text" name='title_data' class="form-control"  placeholder="Название категории">
		  </div>
		</div>
		<div class='col-md-6 col-xs-12 col-lg-3'>
			<button type="submit" class="btn btn-success">Отправить</button>
		</div>
	</form>

<table  class='table table-hover table-bordered' id='category'>
    <thead>
       <tr class='danger'>
           <td>Название</td>
		   <td>Изменить</td>
        </tr>
    </thead>
     <tbody>
			<? foreach($data as $key => $value){?>
				<tr>
					<td><?=$value['title']?></td>
					<td><a href=''>Изменить</a></td>
				</tr>
			<?}?>
     </tbody>
</table>
