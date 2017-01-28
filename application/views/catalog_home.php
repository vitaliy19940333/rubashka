<style>
#mi-slider{
	display:block;
}
</style>
<script src="/js/her.js" type="text/javascript"></script> 
<div class='col-md-12 col-xs-12 col-sm-12'>
		
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
<div class='col-md-12 col-xs-12 col-sm-12'>

	<div style='clear:both'></div>
		<ul class="products-grid row" style='text-align:center'>		
<?php foreach($data['items'] as $key => $value):?>
		
		<div class="item first col-xs-12 col-md-3 cols-sm-6">
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
<div class="clr">&nbsp;</div></div>