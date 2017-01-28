<?php require_once "config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<meta name="description" content="<?=$data['meta']['meta_descr']?>" />
    <meta name="keywords" content="<?=$data['meta']['meta_key']?>" />
	<title><?=strip_tags($data['meta']['title'])?>  | <?=$title_site?></title>
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/font-awesome/css/font-awesome.css" >
	<link rel="stylesheet" href="/css/media.css" >
	<link rel="stylesheet" href="/css/slider.css" >
	<link rel="stylesheet" href="/css/media.css" >
	<link rel="stylesheet" href="/css/normalize.css" />
	<link rel="stylesheet" href="/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="/css/ion.rangeSlider.skinFlat.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/css/slick/slick-theme.css">
	<script src="/js/jquery.min.js" type="text/javascript"></script> 
	<script src="/js/bootstrap.min.js" type="text/javascript"></script> 
	<script src="/js/menu.js" type="text/javascript"></script> 
	<script src="/js/modernizr.custom.63321.js"></script>
	<script src="/js/ion.rangeSlider.js"></script>
	<script src="/js/handlebars.js"></script>
	<script src="/js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/callback.css">
	<script src="/js/callback.js" type="text/javascript"></script> 
</head>
	<body>
	<style>
	#opovewanie{ background: #125682;
    text-align-last: center;
    color: #fff;
    padding: 3px 0px;
    font-size: 15px;
    position: fixed;
    width: 100%;
    z-index: 999999;
    }
	#mi-slider{
		display:none;
	}
	</style>
<div id="popup">
    <form id="contact_form_fast" role="form" method="post">
        <h3>Мы вам скоро перезвоним !</h3>
		<div id='for_hide'>
			<input type="text" name="fio"  placeholder="Как к вам обращаться?">
			<input type="text" name="tel" id='tel' class="required" placeholder="Контакный телефон (обязательно)">

			<textarea name="message" placeholder="В какое время вам можно звонить ?" rows="5"></textarea>
			</div>
			<a href="#" class="btn button form_submit">Заказать</a>
    </form>
</div>
	<header class='main' >
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-12 col-sm-12">
					<a href='/home'><img style='height: 54px;' id='logo' src='/images/logo.png'></a>
				</div>
				<div class="col-md-3 col-xs-12 col-sm-12 hidden-sm hidden-xs" style='text-align:center'>
					<p><i class="fa fa-phone-square" aria-hidden="true"></i> +38 (063) 050 - 50 - 50</p>
					<button style='width:100%' id="callback" class="btn btn-success">Заказать звонок</button>
				</div>
				<div class="col-md-3 col-xs-12 col-sm-6 hidden-xs ">
					<p><i class="fa fa-phone-square" aria-hidden="true"></i> +38 (063) 76 - 31 - 493</p>
						<?php include "fieladsearch.php" ?>	   
				</div>
				<div class="col-md-3 col-xs-12 col-sm-6">
					<div class='pull-right basket'>
						<a href="" style='color:#000' onclick='return false;'><i class="fa fa-2x fa-shopping-cart" aria-hidden="true"></i> </a>: <span class='count'><?=@Controller_Ajax::action_getCountInCart()?></span> товаров - <span class='summ'><?=@1*(Controller_Ajax::action_getSummInCart())?></span> грн
					</div>
					<div id='wrap_basket'>
					<?php include "basket.php"?>
				</div>
				</div>
				
			</div>
		</div>
	</header>
	
	<div class='nav'>
		<p  style='background:#005387'><a id="touch-menu"  class="mobile-menu" href="#"><i class="icon-reorder"></i>Menu </a> <a id='show_search' onclick='return false;' style='color:#fff;padding:4px' href="#" class='pull-right'><i class="fa fa-2x fa-search" aria-hidden="true"></i></a></p>
		<nav>
			<div class="container">
				<ul class="menu">
					<?=$menu?>
				</ul>
			</div>
		</nav>
	</div>
	
	
	<div class='container'>
		<div class='row'>
			<div class='col-md-12' style='height:0px'>
				
			</div>
		</div>
	</div>


	<div id="mi-slider" class="mi-slider hidden-xs">
		<?php include "recr_slider.php"?>
	</div>
	
	
	<div class='col-md-12' style='display:none' id='seacrh-hide'>
		<?php include "fieladsearch.php" ?>
	</div>
	
	<div class="container">
		<div class='row'>
			<div class='col-md-12 col-xs-12 col-sm-12'>
			<?php include $content_view?>
			</div>
		</div>
	</div>
	
	 <style type="text/css">

    .slider {
    width: 100%;
    margin: 10px auto;
	}

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }
  </style>

  
	<?php include "footer.php"?>
	
	<script src="/css/slick/slick.js" type="text/javascript" charset="utf-8"></script>
	<script src="/js/jquery.catslider.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90997348-1', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>