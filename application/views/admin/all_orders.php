<table class='table table-hover' style='background:#fff'>
	<tr class='success'>
		<td>ID Заказа</td>
		<td>Статус заказа</td>
		<td>Сумма заказа</td>
		<td>Дата поступления заказа</td>
		<td>Дата изменения статуса</td>
		<td>Просмотреть</td>
	</tr>
	<?foreach($data['orders'] as $v):?>
		<tr>
			<td><?=$v['id']?></td>
			<td><?=$data['status'][$v['status']]?></td>
			<td><?=$v['summa']?></td>
			<td><?=date('d.m.Y',$v['data_insert'])?></td>
			<td><?=date('d.m.Y',$v['date_change_order'])?> грн</td>
			<td><a href="/admin/order/view/<?=$v['id']?>">Просмотреть</a></td>
		</tr>
	<?endforeach?>
</table>