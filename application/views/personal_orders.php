<div class='col-md-3  col-xs-12 col-sm-12' style='margin-bottom:10px'>
<?php include "account_menu.php"?>

	<div class='top_sales hidden-sm hidden-xs'> 
			<?php include "top_sales.php"?>
		<div style='clear:both'></div>
	</div>
</div>

    <div class="col-xs-12 col-sm-8 col-md-9 " style='background:#fff'>
		<table class='table table-hover'>
			<tr>
				<td>Номер заказа</td>
				<td>Дата заказа</td>
				<td>Сумма заказа</td>
				<td>Статус заказа</td>
				<td>Просмотреть корзину</td>
			</tr>
			<?php foreach($data['orders'] as $k => $v):?>
			<tr>
				<td><?=$v['id']?></td>
				<td><?=date("d.m.Y",$v['data_insert'])?></td>
				<td><?=$v['summa']?> грн</td>
				<td><?=$data['status'][$v['status']]?></td>
				<td><a href='/personal/orders/view/<?=$v['id']?>'>Просмотреть корзину</a></td>
			</tr>
			<?php endforeach?>
		</table>
	</div>
