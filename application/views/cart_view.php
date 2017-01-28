<div class='col-md-12'>
	<form method='post' action='/cart/update'>
	<table style=' text-align:center   background: #fff;' class='table table-striped table-bordered table-hover' id='cart'>
		<tr>
			<td colspan='5' style='padding: 8px 0px;border-bottom: 1px solid #ACA8A8;
color: #21739A;
font: 18px Arial,sans-serif;
letter-spacing: 1px;
padding-bottom: 10px;'><h4 style='    background: #30616d;
    color: #fff;
    text-align: center;
    padding: 17px;
    font-family: Arial,serif;
    font-size: 18px;
    font-weight: normal;
    line-height: normal;
    text-transform: uppercase;
    color: #fff;
    margin: 0;'>Ваш заказ</h4></td>
		</tr>
		<tr class="success">
			<td>Картинка</td>
			<td>Название (Размер)</td>
			<td>Цена</td>
			<td>Кол-во</td>
			<td>Сумма</td>
		</tr>
		<?foreach($data['items'] as $key=>$value): if($key === 'summ') continue;?>
			<tr>
				<td rowspan='1'><img style='max-width:50px' src="/<?=$value['pictures']?>" alt='' title='<?=$value['title']?>'></td>
				<td colspan='1'><a href='/product/view/art/<?=$value['id']?>'><?=$value['title']?> (Размер <?=$value['size']?>)</a></td>

				<td><?=$value['end_price']?> грн.</td>
				<td><input  style='max-width:30px'  name='<?=$value['id']?>_<?=$value['size']?>'  type='number'  value='<?=$_SESSION['cart'][$value['id']."_".$value['size']]?>'>
					<a  style='max-width:30px' class='btn btn-sm btn-danger' href='/cart/delete/id/<?=$value['id']?>/size/<?=$value['size']?>'><span class="glyphicon glyphicon-remove"></span></a>
					<button style='max-width:30px' type='submit' class='btn btn-sm btn-primary' name='recentr'><span style='max-width:30px' class="glyphicon glyphicon-refresh"></span></button>
				</td>
				<td><?=$value['count']*$value['end_price']?> грн</td>
			</tr>
			
		<?endforeach?>
	</table>
	<?php if($data['summ'] < 1500): ?>
		<p class='alert alert-danger' style='text-align:center'>Согласно с <a href="/delivery">нашими условиями работы</a>, сумма минимального заказа  должна составлять не менее  <strong>1500 грн</strong></p>
	<?php endif;?>
	<?php if($data['summ'] >= 1500): ?>
	<div style='        width: 350px;
    float: right;
    background: #323232;
    color: #fff;
    padding: 18px;
    max-width: 100%;
    text-align: center;'>
		<p class='total'><span class='pull-left'>К ОПЛАТЕ</p> <span class='pull-right'><?=$data['summ']?> ГРН </span></p><hr />
			<button type="sumbit" title="ОФОРМИТЬ ЗАКАЗ" class="button btn-cart addtocart" ><span><span>ОФОРМИТЬ ЗАКАЗ</span></span></button>
	</div>
	<?php endif;?>
	</form>
</div>