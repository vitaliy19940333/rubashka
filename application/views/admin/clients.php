<table class='table table-hover'>
	<tr class='success'>
		<td>Имя клиента </td>
		<td>Телефон</td>
		<td>E-mail</td>
		<td>Купил на сумму</td>
		<td>Зарегистрировался</td>
	</tr>
	<?php foreach($data as $key => $value):?>
	<tr>
		<td><?=$value['name']?></td>
		<td><?=$value['phone']?></td>
		<td><?=$value['login']?></td>
		<td><?=$value['SUM(summa)']?> грн</td>
		<td><?=date('d.m.Y',$value['data_reg'])?></td>
	</tr>
	<?php endforeach;?>
</table>