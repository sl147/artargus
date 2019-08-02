<?php include 'views/layouts/headerAdmin.php';?>
<h1 align="center">Перегляд запитів клієнтів</h1><br>
<table class="table table-responsive table-bordered table-striped table-hover">
	<thead>
		<tr class='info'>
			<th class="text-center">id</th>
			<th class="text-center">Ім'я</th>
			<th class="text-center">телефон</th>
			<th class="text-center">e-mail</th>
			<th class="text-center">тема</th>
			<th class="text-center">робота</th>
			<th class="text-center">автор</th>
		</tr>		
	</thead>
	<tbody>
		<?php foreach ($requestList as $item) :?>
		<tr>
			<td><?= $item['id']?></td>
			<td><?= $item['name']?></td>
			<td><?= $item['tel']?></td>
			<td><?= $item['email']?></td>
			<td><?= $item['tema']?></td>
			<td><?= $item['name_FA']?></td>
			<td><?= $item['log_FA']?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php include 'views/layouts/footerAdmin.php';?>