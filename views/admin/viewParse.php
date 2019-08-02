<?php include 'views/layouts/headerAdmin.php';?>
<div class="row-fluid">

	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
	<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
		<table class="admTable table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">id</th>
					<th class="text-center">Код</th>
					<th class="text-center">Назва</th>
					<th class="text-center">артикул</th>
					<th class="text-center">ціна наша</th>
					<th class="text-center">ціна Роса</th>
				</tr>	
			</thead>
			<tbody>
				<?foreach ($parserList as $item) :?>
				<tr>
					<td class="text-center"><?= $item['id']?>       </td>
					<td class="text-center"><?= $item['kod_t']?>    </td>
					<td class="text-center"><?= $item['name']?>     </td>
					<td class="text-center"><?= $item['article']?>  </td>
					<td class="text-center"><?= $item['price']?>    </td>
					<td class="text-center"><?= $item['priceParse']?></td>				
				</tr>
				<?endforeach;?>
			</tbody>	
		</table>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	</div>
</div>	
<?php include 'views/layouts/footerAdmin.php';?>