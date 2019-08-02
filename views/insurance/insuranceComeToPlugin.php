<?php include 'views/layouts/headerAdmin.php';?>
<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<h2 class="text-center"><?= $title?></h2>
	<table class="table table-responsive table-bordered table-striped table-hover">
		<thead>
			<tr class='success'>
				<th class="text-center">id</th>
				<th class="text-center">ref</th>
				<th class="text-center">ІР</th>
				<th class="text-center">дата</th>
			</tr>					
		</thead>
		<tbody>
			<?php foreach ($lists as $list) :?>
				<tr>
					<td class="text-center">
						<?=$list['id']?>
					</td>
					<td class="text-center">
						<?=$list['ref']?>
					</td>
					<td class="text-center">
						<?=$list['ip']?>
					</td>
					<td class="text-center">
						<?=$list['dateToPlugin']?>
					</td>
				</tr>
			<?php endforeach; ?>					
		</tbody>				
	</table>
	<?php if ($total > Insurance::SHOWCOMMENT_BY_DEFAULT) :?>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	<?php endif; ?>	
</div>
<?php include 'views/layouts/footerAdmin.php';?>