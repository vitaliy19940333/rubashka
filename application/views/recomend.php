<?php if(is_array($data['pohogie_tov'])): ?>
  <div class='recomend' style='background: #fff; margin-bottom: 8px;'>
		<div class='col-md-12'>
			<h1 style='    text-transform: uppercase;border-bottom: 1px solid #9a3c3c;color: #005387;'>Похожие товары</h1>
			<section class="variable slider">
			<?php foreach($data['pohogie_tov'] as $k => $v):?>
				<div>
				 <a href='/product/view/art/<?=$v['id']?>'> <img style='width:100px !important' src="/<?=$v['pictures']?>" alt="<?=$v['slise']?>"></a>
				 <p style='text-align:center'><?=$v['article']?></p>
				</div>
			<?php endforeach?>
			 </section>
	</div>
</div>
<?php endif?>
<script>
$(document).ready(function(){
		
		$(".variable").slick({
			
			
			variableWidth: true,
			autoplay: true,

			infinite: true,
			dots: true,
			slidesToShow: <?=(count($data['pohogie_tov'])-1)?>,
			slidesToScroll: 1
		});
});
</script>