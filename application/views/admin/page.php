<div class='col-md-12'>
	<table class='table table-hover'>
		<?php foreach($data as $k => $v): ?>
			<tr>
				<td><a href="edit_page/page/<?=$v['title_page']?>"><?=$v['title_ru']?></a></td>
			</tr>
		<?php endforeach?>
	</table>
</div>