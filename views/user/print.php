<?php include 'views/layouts/headerPrint.php';?>
<h4 class='text-center'>ЗАМОВЛЕННЯ <?= $order['orderid']?></h4>
<div class="zam">
<table class="table table-responsive table-bordered table-striped table-hover">
	<tr class="success">
		<td class="zamtd">замовник</td>
		<td class="zamtd"><?= $order['name']." ".$order['surname']?></td>	
	</tr>
	<tr class="success">
		<td class="zamtd">тел</td>
		<td class="zamtd"><?= $order['phone']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">email</td>
		<td class="zamtd"><?= $order['email']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">адреса</td>
		<td class="zamtd"><?= $order['adres']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">перевізник</td>
		<td class="zamtd"><?= $order['nameDelivery']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">Склад перевізника</td>
		<td class="zamtd"><?= $order['sklad']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">Дата відправки</td>
		<td class="zamtd"><?= $order['delivdate']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">Декларація</td>
		<td class="zamtd"><?= $order['delivdecl']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">спосіб оплати</td>
		<td class="zamtd"><?= $order['namePay']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">примітки</td>
		<td class="zamtd"><?= $order['note']?></td>	
	</tr>

	<tr class="success">
		<td class="zamtd">статус</td>
		<td class="zamtd"><?= $order['nameStatus']?></td>	
	</tr>

</table>
<table class="table table-responsive table-bordered table-striped table-hover">
<tr class='success'>
<thead>
	<tr>
		<th class="text-center">Код</th>
		<th class="text-center">Найменування</th>
		<th class="text-center">артикул</th>
		<th class="text-center">ціна</th>
		<th class="text-center">к-сть</th>
		<th class="text-center">сума грн</th>		
	</tr>
	<tbody>
<?php foreach ($orderTab as $item) :?>
<tr>
	<td><?= $item['kod_t']?></td>
	<td><?= $item['name']?></td>
	<td><?= $item['article']?></td>
	<td><?= number_format($item['price'], 2, '.', '')?></td>
	<td class="text-center"><?= $item['q']?></td>
	<td><?= number_format($item['suma'], 2, '.', '')?></td>
</tr>
<?php endforeach; ?>
<tr>
	<td></td>
	<td colspan='3'>Всього</td>
	<td class="text-center"><?= $orderSum['qq']?></td>
	<td><?= number_format($orderSum['suma'], 2, '.', '')?></td>
</tr>
</tbody>
</thead>	
</tr>	
</table>
</div>