<?php require_once "config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
	<title><?=strip_tags($bred_crumb[max(array_keys($bred_crumb))]['lang_'.$_SESSION['lang']]." | ".$title_site)?></title>
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
	<script src="/js/common.js"></script>
	<script type='text/javascript' src='/js/ckeditor/ckeditor.js'></script>
</head>
	<body>

	
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
		<div class='col-md-12 left' style='background:#fff'>
		<?php include $content_view ?>
		</div>
		</div>
	</div>
	
	
	


  
	<?php include "/../footer.php"?>
	
	<script src="css/slick/slick.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.catslider.js"></script>
	</body>
</html>