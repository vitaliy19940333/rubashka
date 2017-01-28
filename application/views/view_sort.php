
	<div class='col-md-6 col-sm-12 col-xs-12' >
		<div>
			<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Сортировать: 
			<select class="form-control"  name='sort' id='sort' style='max-width:220px; display:inline-block'>
				<option value="NONE" selected="selected">По умолчанию</option>
				<option value="titleASC">Название (А - Я)</option>
				<option value="titleDESC">Название (Я - А)</option>
				<option value="priceASC">Сначала подешевле</option>
				<option value="priceDESC">Сначала подороже</option>
			</select>
		</div>
	</div>
	
	
	<div class='col-md-4 col-sm-12 col-xs-12'>
		<div class='pull-right'>
			На 1 стр. тов. :
			<select onchange="location = this.value;">
			<?php foreach($data['in_one_list'] as $v):?>
				<option value="/catalog/index/pages/<?=$v?>" <?php if($v == $_SESSION['count_pages']) echo "selected=selected"?>><?=$v?></option>
			<? endforeach ?>
			</select>
		</div>
	</div>
	
	<div class='col-md-2 hidden-xs hidden-sm'>
		<div>
			Вид: <a href="#" id='view_list'  onclick='return false'><i class="fa fa-list-ul" aria-hidden="true"></i></a> <a href="#" id='view_grid' onclick='return false'><i class="fa fa-table" aria-hidden="true"></i></a>
		</div>
	</div>

<script>
$("document").ready(function()
{

			
});
</script>