<?php include 'views/layouts/headerAdmin.php';?>

<h2 class="text-center">Редагування метатегів</h2>
<div class="row-fluid">
<!-- 	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div> -->
	<div class="col-lg-12 col-md-11 col-sm-12 col-xs-12">
		<table class="table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">url</th>
					<th class="text-center">title</th>
					<th class="text-center">description</th>
					<th class="text-center">keywords</th>
					<th class="text-center">follow</th>
					<th></th>
				</tr>					
			</thead>
			<tbody>
				<?php foreach ($MTlist as $item) :?>
				<tr>
					<td class='text-center'><a href='<?= $item['url_name']?>' target='_blank'><?= $item['url_name']?></a></td>
					<td class='text-center'><?= $item['title']?></td>
					<td class='text-center'><?= $item['descr']?></td>
					<td class='text-center'><?= $item['keywords']?></td>
					<td class='text-center'><?= $item['follow']?></td>
					<td>
						<a class="btn btn-default btn-lg" href="/metaTags/<?=$item["id"]?>" title="редагувати запис">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>					
		</tbody>
	</table>
	<div class="text-center">
		<a href="/metaTagsNew" class='btn btn-info'>Додати новий мета тег</a>
	</div>
</div>
</div>			

<?php include 'views/layouts/footerAdmin.php';?>