<br/ >
<div class="col-xs-12 col-sm-8 col-md-5 " style='background:#fff'>
<table class='table table-bordered' id='cart'>
		<tr>
			<td colspan='4' style='border-bottom: 1px solid #ACA8A8;
color: #21739A;
font: 18px Arial,sans-serif;
letter-spacing: 1px;
padding-bottom: 10px;'><h4>Информация о заказчике</h4></td>
		</tr>
		<tr>
			<td>ID ЗАКАЗА</td>
			<td><?=$data['info']['id_Zakaza']?></td>
		</tr>
		<tr>
			<td>Имя</td>
			<td><?=$data['info']['name']?></td>
		</tr>
		<tr>
			<td>Телефон</td>
			<td><?=$data['info']['phone']?></td>
		</tr>
		<tr>
			<td>E-Mail</td>
			<td><?=$data['info']['email']?></td>
		</tr>
		<tr>
			<td>Адрес доставки</td>
			<td><?=$data['info']['userAdress']?></td>
		</tr>
		<tr>
			<td>Примечание</td>
			<td><?=$data['info']['description']?></td>
		</tr>
		<tr>
			<td>Статус заказа</td>
			<td><?=$data['status'][$data['info']['status']]?></td>
		</tr>
		<tr>
			<td>Дата появления  заказа</td>
			<td><?=date('d.m.Y H:i',$data['info']['data_insert'])?></td>
		</tr>
		<tr>
			<td>Дата изменения  статуса</td>
			<td><?=date('d.m.Y H:i',$data['info']['date_change_order'])?></td>
		</tr>
		<?php if($data['info']['status'] != 'finish'):?>
		<tr>
			<td>Изменить статус на</td>
			<td>
				<form action="/admin/order/view/<?=$data['info']['id_Zakaza']?>" method='post'>
				<select name='status'>
				<?php foreach($data['status'] as $k=>$v):?>
					<option value='<?=$k?>' <?php if($data['info']['status'] == $k) echo 'selected=selected';?>><?=$v?></option>
				<?php endforeach;?>
				</select>
				<input type='hidden' name='id_Zakaza' value='<?=$data['info']['id_Zakaza']?>'>
				<input type='submit' class='btn btn-success' value='OK'>
				</form>
			</td>
		</tr>
		<?php endif;?>
		<?php if($data['info']['status'] == 'finish'):?>
			<tr>
			<form action="/admin/order/view/<?=$data['info']['id_Zakaza']?>" method='post'>
				<input type='hidden' name='id_Zakaza' value='<?=$data['info']['id_Zakaza']?>'>
				<input type='hidden' name='status' value='back'>
				<td>Сделать возварат</td>
				<td><input type='submit' class='btn btn-success' value='OK'></td>
			</form>
			</tr>
		<?php endif;?>
	</table>
</div>
    <div class="col-xs-12 col-sm-8 col-md-7 " style='background:#fff'>

<div class='col-md-12'>
		<table class='table table-bordered' id='cart'>
		<tr>
			<td colspan='4' style='border-bottom: 1px solid #ACA8A8;
color: #21739A;
font: 18px Arial,sans-serif;
letter-spacing: 1px;
padding-bottom: 10px;'><h4>Корзина</h4></td>
		</tr>
		<?foreach($data['bakset'] as $key=>$value): if($key === 'summ') continue;?>
			<tr>
				<td rowspan='2'><img style='max-width:70px' src="/<?=$value['pictures']?>" alt='' title='<?=$value['title']?>'></td>
				<td colspan='3'><a href='/product/view/art/<?=$value['id']?>'><?=$value['title']?> (Размер <?=$value['size']?>)</a> <?=$value['article']?></td>
			</tr>
			<tr>
				<td><?=$value['price_roz']?> грн.</td>
				<td><?=$value['count']?> шт.
	
				</td>
				<td><?=$value['count']*$value['price_roz']?> грн</td>
			</tr>
			
		<?endforeach?>
		<tr class='warning'>
			<td colspan='4'>Итого: <span style='font-weight:bold;font-size:18px' class='pull-right'><?=$data['basket'][0]['summa']?> грн</span></td>
		</tr>
	</table>
</div>

<script>
$("#cart tr:even").css('background','');
</script>
	</div>
