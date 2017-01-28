
	<form action='' method='post'>
		<div class='col-md-12 col-xs-12 col-lg-12'>
			<div class="form-group">
				<label for="exampleInputEmail1">Курс</label>
			</div>
		</div>
		<div class='col-md-6 col-xs-12 col-lg-6'>
			<div class="form-group">
				<input type="text" name='curs' class="form-control"  placeholder="Название категории">
		  </div>
		</div>
		<div class='col-md-6 col-xs-12 col-lg-3'>
			<button type="submit" class="btn btn-success">Отправить</button>
		</div>
	</form>

<table  class='table table-hover table-bordered' id='category'>
    <thead>
       <tr class='danger'>
           <td>#</td>
		   <td>Курс</td>
		   <td>Дата появления</td>
        </tr>
    </thead>
     <tbody>
			<? foreach($data as $key => $value){?>
				<tr>
					<td><?=$value['id']?></td>
					<td><?=$value['value_kurs']?></td>
					<td><?=date('d.m.Y',$value['data_add'])?></td>
				</tr>
			<?}?>
     </tbody>
</table>
