<style>
.sizes {
    display: inline-block;
    background: #4c4c4c;
    /* height: 14px; */
    /* width: 20px; */
    padding: 3px 6px;
    color: #fff;
	height:28px;
	margin-bottom:10px;
}
.filters span
{
	    color: #fff;
    background: rgba(204, 204, 204, 0.38);
    padding: 4px;
    border-radius: 2px;
    font-size: 11px;
	margin-right:4px;
}
.filters a{
	color:#0a2127;
}
.filters a:hover{
	text-decoration:none;
}
#pagination
{
	text-align: center;
}
.img_new
{
	width: 15%;
    position: absolute;
    top: -2px;
    left: 10px;
    max-width: 60px;
}
</style>
<script src="/js/her.js" type="text/javascript"></script> 
<br />

<div class='col-md-3  col-xs-12 col-sm-12' style='margin-bottom:10px'>
	<div class='top_sales hidden-sm hidden-xs'> 
			<?php include "top_sales.php"?>
		<div style='clear:both'></div>
	</div>
	<?php include "filter.php"?>
</div>
<div class='col-md-9 col-xs-12 col-sm-12'>
	<div class='filters' style=' margin: 0 0 10px;background: #30616D;padding: 15px 20px 15px 20px;color: #fff;'>
	
	</div>
	<p class='count_fielsa' style='    font-weight: normal;
    display: inline-block;
    padding-top: 0px;    font-size: 13px;
    line-height: 20px;
    color: #777;    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;'>Показаны <span><?=$data['pag_from']?>-<?=$data['pag_to']?></span> из <?=$data['count_fields']?></p>
	<div class='sort' style='display:none;'>
					<?php include "view_sort.php"?>
					
	</div>
	<div style='clear:both'></div>
		<ul class="products-grid row" style='text-align:center'>		
<?php foreach($data['items'] as $key => $value):?>
		
		<div class="item first col-xs-12 col-md-4 cols-sm-6">
			<div class="grid_wrap"> 
				<a href="/product/view/art/<?=$value['id']?>" class="product-image">
					<img   style='height:100%' src="/<?=$value['pictures']?>" alt="<?=$value['title']?>">
				</a>
				<div class="product-shop">
					<h2 class="product-name"><a href="/product/view/art/<?=$value['id']?>"><?=$value['title']?> <?=$value['article']?></a></h2>
					<div class="desc_grid"><?php $sizes  = explode(";",$value['size']);?>
						
						<p class='p_slice'><?=strip_tags($value['slise'])?></p>
						<p class='p_description'><?=mb_substr(strip_tags($value['description']),0,280,'UTF-8');?>...</p>
						<a href='/product/view/art/<?=$value['id']?>'>Подробнее</a>
					</div>
					<div class='vvv'>
					<div class='sizes'>
					<form action='/catalog/basket' method='post'>
						Размер : <select name='size'  id="sss<?=$value['id']?>">
						<?php foreach($sizes as $k => $v):?>
							<option value='<?=$v?>'><?=$v?></option>
						<?php endforeach?>
						<option value='complect_<?=$value['complect']?>'>Ростовка(<?=$value['complect']?>)</option>
						</select>
						</div>
					<div class="price-box"> <span class="price"><?php if($value['discount']*1 > 0) echo round((((100-$value['discount'])/100)*$value['price_roz']));else echo round($value['price_roz']) ?>&nbsp;грн</span> </span>  
						<?php if($value['discount']*1 > 0): ?><span class="old-price"><span class="price"><?=$value['price_roz']?>&nbsp;грн</span></span><?php endif ?>
					</div>  
					<div class="actions">
						<?php if($value['in_sklad']*1 == 0): ?><div class="bt outstock">Нет в наличии</div> <?php endif ?>
						<?php if($value['in_sklad']*1  > 0): ?>
							<input type='hidden' value='<?=$value['id']?>' name='id'>
							<button type="submit" title="В Корзину" class="button btn-cart addtocart"  onclick="add_basket(<?=$value['id']?>,'<?=str_replace("\"",'',($value['title']))?>',this)"><span><span>В Корзину</span></span></button>
						<?php endif ?>
					</div>
					</form>
					</div>
				</div>
				<?php if($value['discount']*1 > 0): ?><div class="label-product"> <span class="new"><?=$value['discount']?> %</span> </div><?php endif ?>
			</div>
			<?php if((time() - $value['date_add']) < 86400*2) :?>
				<img style='width:70px'  class='img_new' src='/img/new.gif'>
			<?php endif;?>
		</div>

<?php endforeach ?>
<div class="clr">&nbsp;</div>
</ul>
<div id='pagination' ><?=$data['pagination']?></div>
</div>


<script id="items" type="text/x-handlebars-template">
{{#each test}}
<div class="item first col-xs-12 col-md-4 cols-sm-6">
			<div class="grid_wrap"> 
				<a href="/product/view/art/{{id}}" class="product-image">
					<img   style='height:100%' src="/{{pictures}}" alt="{{title}}">
				</a>
				<div class="product-shop">
					<h2 class="product-name"><a  href="/product/view/art/{{id}}">{{title}} {{article}}</a></h2>
					<div class="desc_grid">
						
						<p class='p_slice'>{{slise}}</p>
						<div class='p_description'>{{STRREPLACE description}}...</div>
						<a href='/product/view/art/{{id}}'>Подробнее</a>
					</div>
					<div class='vvv'>
					<div class='sizes'>
							Размер : <select id="sss{{id}}">
							{{PODD size}}
							<option value='complect_{{complect}}'>Ростовка({{complect}})</option>
						</select>
						</div>
					<div class="price-box"> <span class="price">
					{{PISATCENU discount price_roz}}
					
					&nbsp;грн</span> 
						
						<span class="old-price"><span class="price">{{OLDCENA discount price_roz}}</span></span>
						</div>
						
						<div class="actions">
						<div class="bt {{ESTNASKLADE in_sklad}} outstock">Нет в наличии</div>
							<button type="button" title="В Корзину" class="button {{ESTNASKLADEe in_sklad}}btn-cart addtocart"  onclick="add_basket({{id}},'{{title}}',this)"><span><span>В Корзину</span></span></button>
						</div>
					</div>  
					</div>
					<div class="label-product {{DISCOUNT discount price_roz}} "> <span class="new">{{discount}} %</span> </div>
				</div>
				<img style='width:70px'  class='img_new {{DROWNEW date_add}}' src='/img/new.gif'>
				
			</div>
		{{/each}}
		
</script>


<script id="cetegor" type="text/x-handlebars-template">
	{{APPENHTMLFROOB kind "kind"}}
	{{APPENHTMLFROOB category "category"}}
	{{APPENHTMLFROOB sleeve "sleeve"}}
	{{APPENHTMLFROOB sewing "sewing"}}
</script>


<script type="text/javascript">


</script>
