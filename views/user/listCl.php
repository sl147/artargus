<?php include 'views/layouts/headerAdmin.php';?>
<h4 class='text-center'>ЗАМОВЛЕННЯ <?= $order['orderid']?></h4>
<div class="zam">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-1 col-sm-1 col-xs-0 col-lg-2"></div>
			<div class="col-md-9 col-sm-10 col-xs-12 col-lg-8">

				<table class="table table-responsive table-bordered table-striped table-hover">
					<tr>
						<td class="success zamtd">отримувач</td>
						<td class="zamtd"><?= $order['name']." ".$order['surname']?></td>	
						<td class="success zamtd">телефон</td>
						<td class="zamtd"><?= $order['phone']?></td>	
					</tr>

					<tr>
						<td class="success zamtd">email</td>
						<td class="zamtd"><?= $order['email']?></td>	
						<td class="success zamtd">адреса</td>
						<td class="zamtd"><?= $order['adres']?></td>	
					</tr>

					<tr>
						<td class="success zamtd">перевізник</td>
						<td class="zamtd"><?= $order['nameDelivery']?></td>	
						<td class="success zamtd">Склад перевізника</td>
						<td class="zamtd"><?= $order['sklad']?></td>	
					</tr>

					<tr>
						<td class="success zamtd">Дата відправки</td>
						<td class="zamtd"><?= $order['delivdate']?></td>	
						<td class="success zamtd">Декларація</td>
						<td class="zamtd"><?= $order['delivdecl']?></td>	
					</tr>

					<tr>
						<td class="success zamtd">спосіб оплати</td>
						<td class="zamtd"><?= $order['namePay']?></td>	
						<td class="success zamtd">примітки</td>
						<td class="zamtd"><?= $order['note']?></td>	
					</tr>

					<tr>
						<td class="success zamtd">статус</td>
						<td class="zamtd"><?= $order['nameStatus']?></td>
						<td class="success"></td>	
						<td></td>
					</tr>

				</table>
			</div>
		</div>
	</div>
	<table class="table table-responsive table-bordered table-striped table-hover">
		<thead>
			<tr class='success'>
				<th class="text-center zamtd">№</th>
				<th class="text-center zamtd">код</th>
				<th class="text-center zamtd">артикул</th>
				<th class="text-center zamtd">найменування</th>		
				<th class="text-center zamtd">ціна</th>
				<th class="text-center zamtd">к-сть</th>
				<th class="text-center zamtd">сума грн</th>		
			</tr>
			<tbody>
				<?php foreach ($orderTab as $item) :?>
					<tr>
						<td class="text-center">
							<?= $item['nom']?>
						</td>
						<td class="text-center">
							<?= $item['kod_t']?>
						</td>
						<td class="text-center">
							<?= $item['article']?>
						</td>
						<td>
							<?= $item['name']?>
						</td>	
						<td class="text-right">
							<?= number_format($item['price'], 2, '.', '')?>
							</td>
						<td class="text-center">
							<?= $item['quantity']?>
							</td>
						<td class="text-right">
							<?= number_format($item['suma'], 2, '.', '')?>
						</td>
					</tr>
				<?php endforeach; ?>
				<tr class='success'>
					<td colspan='3'></td>
					<td colspan='2'>Всього</td>
					<td class="text-center">
						<?= $orderSum['qq']?>
					</td>
					<td class="text-right">
						<?= number_format($orderSum['suma'], 2, '.', '')?>
					</td>
				</tr>
			</tbody>
		</thead>	
	</table>
	<?php include 'views/layouts/footerAdmin.php';?>