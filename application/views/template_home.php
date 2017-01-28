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
</style>
<script src="/js/her.js" type="text/javascript"></script> 


<div class='col-md-9 col-xs-12 col-sm-12'>
	<div class='sort' style=''>
					<?php include "view_sort.php"?>
	</div>
	<div style='clear:both'></div>
		<ul class="products-grid row">
				
<?php foreach($data['items'] as $key => $value):?>
		
		<div class="item first col-xs-12 col-md-4 cols-sm-6">
			<div class="grid_wrap"> 
				<a href="/product/view/art/<?=$value['id']?>" class="product-image">
					<img   style='height:100%' src="/<?=$value['pictures']?>" alt="Fegry">
				</a>
				<div class="product-shop">
					<h2 class="product-name"><a href="/view/<?=$value['id']?>"><?=$value['title']?></a></h2>
					<div class="desc_grid"><?php $sizes  = explode(",",$value['size']);?>
						
						<p class='p_slice'><?=strip_tags($value['slise'])?></p>
						<p class='p_description'><?=mb_substr(strip_tags($value['description']),0,280,'UTF-8');?>...</p>
						<a href=''>Подробнее</a>
					</div>
					<div class='vvv'>
					<div class='sizes'>
						Выбирете размер : <select id="sss<?=$value['id']?>">
						<?php foreach($sizes as $k => $v):?>
							<option><?=$v?></option>
						<?php endforeach?>
						</select>
						</div>
					<div class="price-box"> <span class="price"><?php if($value['discount']*1 > 0) echo round((((100-$value['discount'])/100)*$value['price_roz']));else echo $value['price_roz'] ?>&nbsp;грн</span> </span>  
						<?php if($value['discount']*1 > 0): ?><span class="old-price"><span class="price"><?=$value['price_roz']?>&nbsp;руб</span></span><?php endif ?>
					</div>  
					<div class="actions">
						<?php if($value['in_sklad']*1 == 0): ?><div class="bt outstock">Нет в наличии</div> <?php endif ?>
						<?php if($value['in_sklad']*1  > 0): ?>
							<button type="button" title="В Корзину" class="button btn-cart addtocart"  onclick="add_basket(<?=$value['id']?>,'<?=str_replace("\"",'',($value['title']))?>',this)"><span><span>В Корзину</span></span></button>
						<?php endif ?>
					</div>
					</div>
				</div>
				<?php if($value['discount']*1 > 0): ?><div class="label-product"> <span class="new"><?=$value['discount']?> %</span> </div><?php endif ?>
			</div>
		</div>

<?php endforeach ?>
<div class="clr">&nbsp;</div>
</ul>
</div>


<script type="text/javascript">
 
</script>
