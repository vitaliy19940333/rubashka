<style>
.view_static_page
{
	    background: #fff;
    padding: 14px;
    margin: 15px 0px;
}
.view_static_page img
{
	width:100%;
	max-width:200px;
	margin-bottom:24px;
}
.view_static_page h1
{
	 margin-bottom: 25px;
    font-weight: 300;
    display: block;
    font-size: 24px;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 0px;
    padding-top: 5px;
}
.view_static_page p{
	    margin-top: 0px;
    margin-bottom: 15px;
    line-height: 21px;
	    margin: 0 0 10px;
		font-weight: 300;
		    font-family: 'Lato', sans-serif;
		
    position: relative;
    color: #222222;
    font-size: 14px;
}
.page_image
{
	text-align:center;
}
</style>

<div class='col-md-12 col-sm-12 col-xs-12 view_static_page'>
	<div class='col-md-9 col-xs-12 col-sm-4'>
	<h1><?=$data['items']['title_'.$_SESSION['lang']]?></h1>
	<?=preg_replace('/<img(?:\\s[^<>]*)?>/i', '', $data['items']['lang_'.$_SESSION['lang']])?>
	</div>
		<?php foreach($data['src'] as $key => $value):?>
	<div class='col-md-3 col-xs-6 col-sm-6 page_image'>
		<img <?=$value?> alt="<?=$data['title_'.$_SESSION['lang']]?>" />
	</div>	
<?php endforeach;?>
	
</div>



