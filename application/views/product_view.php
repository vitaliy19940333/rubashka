<script src='/js/jquery.elevateZoom-3.0.8.min.js'></script>
<script src="/js/her.js" type="text/javascript"></script> 

<style>
.left-block{
	    background: #fff;
    padding-bottom: 56px;
}
.content{
	    padding-left: 12px;
}
.bask
{
	    padding-left: 12px;
}
.items_in_basket{
	padding-left: 12px;
	padding-right: 10px;
	clear:both;
}

	.left-block .header
	{
		    background: #30616d;
		    text-align: center;
		    color: #fff;
		    padding: 10px 0px;
		    font-family: Arial,serif;
		    font-size: 18px;
		    font-weight: normal;
		    line-height: normal;
		    text-transform: uppercase;
		    margin-bottom: 10px;
	}
	.content .count{
		    border-bottom: 1px solid #dddddd;
		    padding-bottom: 10px;
		    margin-bottom: 16px;
		    font-size: 13px;
		    line-height: 20px;
		    color: #777;
		    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	}
	.block-cart  {
		    border-bottom: 1px solid #dddddd;
		    padding-bottom: 10px;
		    margin-bottom: 17px;
	}
	.count strong
	{
		color:#000;
	}
	.bask
	{
		    font-size: 13px;
    line-height: 16px;
    color: #2d2328;
    font-weight: normal;
    text-transform: uppercase;
    margin-bottom: 14px;
	   font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	}
	 .product-control-buttons {
    float: right;
    margin-bottom: -20px;
        overflow: hidden;
    position: relative;
    margin-bottom: 5px;
    height: 19px;
}
 .btn-remove, .block .btn-edit {
    float: right;
        display: inline-block;
    overflow: hidden;
    margin-left: 13px;
    font-size: 0;
    text-indent: -999px;
    text-decoration: none !important;
        color: #383838;
}
.product-image {
    float: left;
    width: 68px;
    line-height: 68px;
    vertical-align: middle;
    font-size: 0px;
    text-align: center;
    height: 68px;
    background: #fff;
    margin-right: 10px;
}
.product-image img {
    vertical-align: middle;
    line-height: 68px;
    max-width: 60px;
    max-height: 60px;
}
.product-name {
    padding-right: 20px;
    word-wrap: break-word;
    margin-left: 10px;
    display: block;
    overflow: hidden;
}
.items-view h1
{
	       font-size: 22px;
    line-height: 22px;
    font-weight: bold;
    color: #777;
    margin-top: 0;
    padding-bottom: 12px
}
.items-view{
	padding: 2px 22px;
}

.price
{    color: #6ebabd;
    font-weight: normal;
    font-size: 24px;
    line-height: 24px;
    padding-bottom: 11px;
    padding-top: 10px;
}
.product-options-bottom 
{
	    border: 1px solid #DBDBDB;
    padding: 12px;
    padding-top: 10px;
    background: #fbfbfb;
}
.sizez{
	    margin-right: 7px;
    color: #3a3a3a;
    padding: 8px;
    float: r;
    margin-left: 20px;
    padding-top: 5px !important;
}
#zoomz{
	    position: relative;
    height: auto;
    
   
    overflow: hidden;
        overflow: inherit;
   
	    max-width: 90%;
}
.view_prod
{
	    margin-top: 25px;
}
.description{
	text-align:justify;
    font-size: 15px;
}
.box-collateral{
	background: #fff;
    /* text-align: center; */
    border-top: 1px solid #fff !important;
    margin-top: 12px;
    background: #FBFBFB;
    border: 1px solid #DDDDDD;
    font-size: 14px;
    line-height: 18px;
    color: #3A3A3A;
    padding: 12px 15px;
    margin-bottom: 15px;
    position: relative;
}

.item h1
{        margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;
}
.block-image
{
	    padding: 24px;
    background: #fff;
    background: #fff;
    box-shadow: 5px 5px 5px rgba(0,0,0,0.05);
    padding: 26px 30px;
    position: relative;
}
.item
{
	background:#fff;
	padding:10px;
}
.article span
{
	    color: green;
    font-weight: 600;
}
.item h2
{
	    margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 20px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;
	
    margin-top: 10px;
    border-bottom: 1px solid #ebebeb;
    margin-bottom: 7px;
}
</style>


<div class="row view_prod">
	<div class="col-md-3 col-xs-12 col-sm-4 hidden-xs hidden-sm">
		<div class="left-block">
			<div class="header">
				<p>КОРЗИНА</p>
			</div>
			<div id='renderher_left_basket'>
			<div class="content">
				<p class='count'> В корзине : <strong><span></span> товаров </strong></p>
				<p class='summ'> Всего к оплате:  <strong><span></span> грн </strong></p>
				<div class="block-cart actions">
					<button type="button" title="В корзину" id="product-buy" onclick='location = "/cart/view"' class="button btn-cart addtocart"><span><span>Перейти в корзину</span></span></button>
				</div>
				
			</div>
			
			<p class='bask'>ТОВАРЫ В КОРЗИНЕ</p>
			<div class='items_in_basket'>
				<table style='text-align:center' class='table table-hover renderher'>

				</table>
			</div>
			</div>
		</div>
	</div>
	<div class="col-md-9 col-xs-12 col-sm-12 item" >
		<div class='col-md-12 col-xs-12 col-sm-12'><h1><?=$data[0]['title']?></h1></div>
		<div class='col-md-4 col-xs-12 col-sm-6 block-image'>
			<img id='zoomz'  src='/<?=$data[0]['pictures']?>' alt='<?=$data[0]['title']?>' data-zoom-image="/<?=$data[0]['pictures']?>">
		</div>
		<div class='col-md-8 col-xs-12 col-sm-6'>
			<h2>ОПИСАНИЕ</h2>
			<div class='article'>
				<p>Артикул: <span><?=$data[0]['article']?></span></p>
			</div>
			<div class="price-box"> <span class="price"><?php if($data[0]['discount']*1 > 0) echo round((((100-$data[0]['discount'])/100)*$data[0]['price_roz']));else echo $data[0]['price_roz'] ?>&nbsp;грн</span> </span>  
						<?php if($data[0]['discount']*1 > 0): ?><span class="old-price"><span class="price"><?=$data[0]['price_roz']?>&nbsp;грн</span></span><?php endif ?>
			</div>  
			<div class='description' >
				<?php if( strlen($data[0]['description']) < 22) echo  $data[0]['slise']; else echo $data[0]['description'];?>
			</div>
		</div>
		<div class='col-md-8 col-xs-12 col-sm-12'>
			<form  class='view_form' action="/cart_items" method="post">
                  <input type="hidden" name="variant_id" value="<?=$data[0]['id']?>"/>   
        			<div class="product-options-bottom m_hide">
			          <div class="add-to-cart" style='border-top:1px solid #fff !important;'>
			            <div class="qty-block">
			           
			            <div class="sizez qty-block">
			              <label for="qty">Рамер:</label>
			              	<?php $sizes  = explode(";",$data[0]['size']); ?>
				              <select name="size" id="sss<?=$data[0]['id']?>">
				              	<?php foreach ($sizes as $key => $value):?>
				              		<option value='<?=$value?>'><?=$value?></option>
				              <?php endforeach?>
							  <option value='complect_<?=$data[0]['complect']?>'>Ростовка(<?=$data[0]['complect']?>)</option>
				              </select>
			            </div>
						<?php if($data[0]['in_sklad']*1 == 0){ ?><div class="bt outstock">Нет в наличии</div> <?php } else{ ?>
			            <button type="button" title="В корзину" id="product-buy" class="button btn-cart addtocart mybnt"  onclick="add_basket(<?=$data[0]['id']?>,'<?=str_replace("\"",'',($data[0]['title']))?>',this,'view')"><span><span>В корзину</span></span></button>
						<?php }?>
					 </div>
       				 </div>
				</form>
		</div>
		<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="small,round,line,horizontal,counter,theme=04" data-services="odnoklassniki,facebook,twitter,google,moimir,vkontakte"></div>
	</div>
	<div class='col-md-12 hidden-xs hidden-sm'>
		<?php include "recomend.php"?>
	</div>
</div>

</div>


<script>$("#zoomz").elevateZoom({
	
	
	scrollZoom : true,
	zoomWindowOffetx: -50
	
	
	
	});</script>
	
	<script>
	
	$('document').ready(function(){
		var elementary = $(".basket span.count").text();
		var elementary2 = $(".basket span.summ").text();
		$("p.count span").text(elementary);
		$("p.summ span").text(elementary2);
		$.ajax({
						type : 'POST',
						url : '/ajax/getBasket',
						data : {'fdsf':'ew'},
						success : function(data) {
								Handlebars.registerHelper('link', function(text, url) {
							  url = Handlebars.escapeExpression(url);      //экранирование выражения
							  text = Handlebars.escapeExpression(text);
							  var r = parseInt(text)*parseInt(url);
							  return new Handlebars.SafeString(r);
							});
							var sour = $("#entry-template").html();
							var template = Handlebars.compile(sour);
							var rr = JSON.parse(data);
							var o = { 
										test: rr.items,  
										bla: rr.summ 
									}
									
									

					
							var elem = template(o);
							$("#renderher").html(elem);
							$(".renderher").html(elem);
						}
	});
	});
					
	</script>

