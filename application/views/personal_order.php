<br/ >
<div class='col-md-3  col-xs-12 col-sm-12' style='margin-bottom:10px'>
<?php include "account_menu.php"?>

	<div class='top_sales hidden-sm hidden-xs'> 
			<?php include "top_sales.php"?>
		<div style='clear:both'></div>
	</div>
</div>

    <div class="col-xs-12 col-sm-8 col-md-9 " style='background:#fff'>
		<!--<div class='col-md-6'>
	<form class="form-horizontal" action='/cart/order_form' method='post' id='order' role="form">
	  <div class="form-group">
		<label for="name" class="col-sm-4 control-label">Фамилия Имя: *</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control" id="name" name='name' placeholder="Введите ваше имя">
		</div>
	  </div>
	  <div class="form-group">
		<label for="email" class="col-sm-4 control-label">Пароль: *</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control" id="email" name='email' placeholder="E-mail">
		</div>
	  </div>
	 <div class="form-group">
		<label for="phone" class="col-sm-4 control-label">Телефон: *</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control" id="phone" name='phone' placeholder="Ваш телефон">
		</div>
	  </div>
	  <div class="form-group">
		<label for="phone" class="col-sm-4 control-label">Комментарии к заказу: *</label>
		<div class="col-sm-8">
			<textarea class="form-control" id="description" name='description'>
			</textarea>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-danger pull-right">Отправить</button>
		</div>
	  </div>
	</form>
</div>-->
<div class='col-md-12'>
		<table class='table table-bordered' id='cart'>
		<tr>
			<td colspan='4' style='border-bottom: 1px solid #ACA8A8;
color: #21739A;
font: 18px Arial,sans-serif;
letter-spacing: 1px;
padding-bottom: 10px;'><h4>Ваш заказ</h4></td>
		</tr>
		<?foreach($data['bakset'] as $key=>$value): if($key === 'summ') continue;?>
			<tr>
				<td rowspan='2'><img style='max-width:70px' src="/<?=$value['pictures']?>" alt='' title='<?=$value['title']?>'></td>
				<td colspan='3'><a href='/product/view/art/<?=$value['id']?>'><?=$value['title']?> (Размер <?=$value['size']?>)</a></td>
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
