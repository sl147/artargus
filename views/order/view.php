<?php include 'views/layouts/header.php';?>
<?php if (!empty($orderOne)) :?>
<div class="zam table-responsive">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th class="text-center">№</th>
				<th class="text-center"></th>
				<th class="text-center">Найменування</th>
				<th class="text-center">артикул</th>
				<th class="text-center">ціна</th>
				<th class="text-center" style="width:60px;">к-сть</th>
				<th class="text-center">сума</th>
				<th></th>
			</tr>			
		</thead>
		<tbody>
<?php foreach ($orderTabOne as $item) :?>
		<tr>
			<td><?= $item['i']?></td>		
			<td>
				<?php if ($item['kodCol']) :?>				
				<div class="color_box" style="background:'.$item['kodCol'].';"></div>
				<?php else :?>
				<a class="fancybox" title="<?= $item['name']?>" href="<?= $item['foto']?>">
					<img class="fototovzam" alt="<?= $item['name']?>" src="<?= $item['foto']?>" />
				</a>
				<?php endif; ?>
			</td>
			<td class="text-left"><?= $item['name']?></td>
			<td class="text-center"><?= $item['article']?></td>
			<td><?= number_format($item['price'], 2, '.', '')?></td>
			<td class="text-center"><?= $item['q']?></td>
			<td class="text-right"><?= number_format($item['suma'], 2, '.', '')?></td>
			<td class="text-center">
				<a href='/basket/<?= $item["id"]?>' title="видалити товар з замовлення" class="btn btn-danger btn-sm">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
			</td>			
		</tr>
<?php endforeach; ?>
			<tr class="success">
				<td colspan="5" class="text-center">Всього</td>
				<td class="text-center" style="width:60px;"><?= $orderSum['qq']?></td>
				<td class="text-center"><?= $orderSum['suma']?></td>
				<td class="text-center"></td>
			</tr>
</tbody>
	</table>
</div>
<div class="text-center">
	<a class="btn btn-warning btn-sm" href="<?= $_SERVER['HTTP_REFERER']?>"> повернутись до замовлень</a>
</div>
<?php else :?>
<h3 class="text-center">Ваш кошик пустий</h3>
<?php endif; ?>
<?php include 'views/layouts/footer.php';?>