<Style>
.article{
	    display: block;
    font-size: 12px;
    font-weight: bold;
    color: #3a3a3a;
    margin: 5px 0;
}
.article span
{
	    display: inline-block;
    font-size: 12px;
    font-weight: bold;
    color: #74b436;
    margin-left: 6px;
}
</style>
	<h2 style='       background: #30616d;
    color: #fff;
    text-align: left;
    padding-left: 14px;
    text-align: center;
    font-size: 14px;
    /* padding: 2px 0px; */
    margin: 0 0 0px;
    background: #30616D;
    padding: 8px 20px 8px 20px;
    color: #fff;'>ТОП ПРОДАЖ <img class=' pull- img_hit' style='width:100%;max-width:35px;height:35px' src='/img/hit.png'></h2>
<br />

<div class='item_top_sales' >
<?php  foreach($data['top_item'] as $k => $value):?>
<div class='col-md-4 col-xs-5'>
	<a href='/product/view/art/<?=$value['id']?>'><img style='max-width:100%'  src="/<?=$value['pictures']?>" alt="Fegry"></a>
</div>

<div class='col-md-8 col-xs-7' >
	<p><?=$value['title']?><p>
	<p class='article'>Артикул: <span><?=$value['article']?></span></p>
	<p><?=$value['slise']?><p>
	<div class="price-box"> <span class="price"><?php if($value['discount']*1 > 0) echo round((((100-$value['discount'])/100)*$value['price_roz']));else echo $value['price_roz'] ?>&nbsp;грн</span> </span>  
						<?php if($value['discount']*1 > 0): ?><span class="old-price"><span class="price"><?=$value['price_roz']?>&nbsp;руб</span></span><?php endif ?>
					</div>  
</div>
<div class='col-md-12 col-xs-12'>
	

</div>
 <div style='clear:both'></div><hr >
<?php endforeach?>
</div>