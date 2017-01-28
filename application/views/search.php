<script src="/js/her.js" type="text/javascript"></script> 
<br /><div class='col-md-3  col-xs-12 col-sm-12' style='margin-bottom:10px'>
	<div class='top_sales hidden-sm hidden-xs'> 
			<?php include "top_sales.php"?>
		<div style='clear:both'></div>
	</div>
</div>
<div class='col-md-9 col-xs-12 col-sm-12'>
	<div class='filters' style='    margin: 0 0 10px;
    background: #30616D;
    padding: 15px 20px 15px 20px;
    color: #fff;'>

		По запросу <strong>«<?=$data['query']?>»</strong>, найдено <?=count($data['items'])?> совпадений
	</div>
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
