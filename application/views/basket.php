<style>
.table_wrap
{
	height:100%;
	max-height:300px;
	    overflow: scroll;
		overflow-x:hidden; 
}
</style>

<div id="basket_box">
<h1 style='    padding: 13px;
    background: #30616d;
    background: #323232;
    color: #fff;
    font-size: 14px;
    width: 100%;'>Всего к оплате <span class='pull-right'></span></h1>
	<div class='table_wrap'>
	<table style='text-align:center' class='table table-hover renderher' id='renderher'>

	</table>
	</div>
	<div style='text-align: center;
    padding: 6px;
    background: #323232;'> <a href="/cart/view"><button type="button" title="В Корзину" class="button btn-cart addtocart" ><span><span>В Корзину</span></span></button></a></div>
</div>
<script id="entry-template" type="text/x-handlebars-template">
{{#if test}}
{{#each test}}
		<tr>
			<td><a href='/product/view/art/{{id}}'><img  style='width:40px' src="/{{pictures}}" alt="Felintano"></a></td>
			<td><b>{{title}}</b><br>Размер : {{sizesss}}<br /> <span class='cultu'>{{count}}</span> шт x {{end_price}} = <span class='summo'>{{link count end_price }}</span>грн</td>
			<td  class='removs' ><p class='id_hid id{{id}}_{{sizesss}} hidden'>{{id}}_{{sizesss}}</p><b><i class="fa fa-2x fa-window-close" aria-hidden="true"></i></b></td>
		</tr>
		{{/each}}
		{{/if}}
		{{#unless license}}
			<p>Ваша корзина пуста</p>
		{{/unless}}
</script>