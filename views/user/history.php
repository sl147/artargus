<?php include 'views/layouts/header.php';?>
<h2 class="text-center">Замовлення</h2>

<div class='table-responsive tabOrder'>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class='success tabOrder'>
				<th class="text-center">Дата</th>
				<th class="text-center">Замовлення</th>
				<th class="text-center">Перевізник</th>
				<th class="text-center">адреса</th>
				<th class="text-center">отримувач</th>
				<th class="text-center">примітки</th>
				<th class="text-center">статус вик</th>
				<th></th>
			</tr>			
		</thead>
		
		<tbody class='tabOrder'>
			<?php foreach ($orderList as $item) :?>
				<tr>
					<td><?= $item['date_ord']?></td>
					<td><?= $item['orderid']?></td>
					<td><?= $item['deliver']?></td>
					<td><?= $item['adres']?></td>
					<td><?= $item['name'].' '.$item['surname']?></td>
					<td><?= $item['note']?></td>
					<td><?= $item['status']?></td>
					<td>
						<a href="/look/<?= $item['id_ord']?>" title="переглянути ордер" class="btn btn-default btn-lg">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>			
		</tbody>
			
</table>
</div>
<?php include 'views/layouts/footer.php';?>