<Style>
.price_filter
{
	display:none;
}
</style>
<button style='width:100%;background:#30616d;color:#fff;    font-family: Arial,serif;
    font-size: 18px;
    font-weight: normal;
    line-height: normal;
    text-transform: uppercase;
    color: #fff;
    margin: 0;' type='submit' id='toogleFiltr'   class='btn'> ФИЛЬТРЫ   <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> </button>
<div id='filtr' class='left' style='width:100%'>
	<div class='left-sort'>
		<div id="navmenu">
		<header class='price_filter'> 
					<h1>Цена</h1>
				</header>
				<div class='price_filter' id='price_filter'>
				<form method='post' action='/catalog' id='filter_summ'>
					C: <input type="number" name='price_from' min=1 id='slider_from'  class="form-control" value=""  /> ПО :<input type="number"  name='price_to' class="form-control" id='slider_to' value=""  />
					<button type='button' id="ranges"  class='btn btn-success'>OK</button>
					<input  type="text" data-min="<?=$data['min']['MIN(price_opt)']?>"  data-max="<?=$data['max']['MAX(price_roz)']?>" id="range" value="" name="range" />
					</form>

				</div>
						<form method='post' action='/catalog' id='filter_items'>
						
							<header>
								<h1>Категория</h1>
							</header>
							<ul>
								<? foreach($data['category'] as $value):?>
									<li><input type='checkbox' name='category<?=$value['id']?>'  value='<?=$value['id']?>' class="form-control" style='width: 30%;display: inline-block;vertical-align: middle;height:24px;margin:0px;'><?=$value['title']?></li></li>
								<?endforeach?>
							</ul>
							<header>				
								<h1>Рукав</h1>
							</header>
								<ul>
									<? foreach($data['sleeve'] as $value):?>
										<li><input type='checkbox' name='sleeve<?=$value['id']?>' value='<?=$value['id']?>' class="form-control" style='width: 30%;display: inline-block;vertical-align: middle;height:24px;margin:0px;'><?=$value['title']?></li></li>
									<?endforeach?>
								</ul>
							<header>
								<h1>Пошив</h1>
							</header>
							<ul>
								<? foreach($data['sewing'] as $value):?>
									<li><input type='checkbox' name='sewing<?=$value['id']?>' value='<?=$value['id']?>' class="form-control" style='width: 30%;display: inline-block;vertical-align: middle;height:24px;margin:0px;'><?=$value['title']?></li></li>
								<?endforeach?>
							</ul>
							<header>
								<h1>Вид</h1>
							</header>
							<ul>
								<? foreach($data['kind'] as $value):?>
									<li><input type='checkbox' name='kind<?=$value['id']?>' value='<?=$value['id']?>' class="form-control" style='width: 30%;display: inline-block;vertical-align: middle;height:24px;margin:0px;'><?=$value['title']?></li></li>
								<?endforeach?>
							</ul>
							<ul>
								<button type='submit' id='btnFilter' class='btn btn-default'>Применить</button>
							</ul>
							
						</form>
		</div>
	</div>
</div>