<?php include 'views/layouts/headerAdmin.php';?>

<div class="row-fluid">
	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
	<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
		<? if (count($orderList)) :?>
			<table class="admTable table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">id</th>
						<th class="text-center">Замовлення</th>
						<th class="text-center">клієнт</th>
						<th class="text-center">телефон</th>
						<th class="text-center">e-mail</th>
						<th class="text-center">статус</th>
					</tr>	
				</thead>
				<tbody>
					<?foreach ($orderList as $item) :?>
					<tr>
						<td><?= $item['id_ord']?></td>
						<td>
							<a href='/look/<?= $item['id_ord']?>'' title='Переглянути замовлення'>
								<?= $item['orderid']?>
							</a>
						</td>
						<td><?= $item['name']?></td>
						<td><?= $item['phone']?></td>
						<td><?= $item['email']?></td>
						<td><?= $item['status']?></td>				
					</tr>
					<?endforeach;?>
				</tbody>	
			</table>
		<? endif;?>	
	</div>
	<?if (User::isAdmin(User::userId())) :?>
		<div class="col-lg-1 col-md-2 col-sm-0 col-xs-0">
			<!--LiveInternet counter--><script type="text/javascript"><!--
			document.write("<a href='//www.liveinternet.ru/click' "+
				"target=_blank><img src='//counter.yadro.ru/hit?t27.20;r"+
				escape(document.referrer)+((typeof(screen)=="undefined")?"":
					";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
						screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
				";"+Math.random()+
				"' alt='' title='LiveInternet: показано количество просмотров и"+
				" посетителей' "+
				"border='0' width='88' height='120'><\/a>")
				//--></script><!--/LiveInternet-->
		</div>
	<?endif;?>
</div>
<?php include 'views/layouts/footerAdmin.php';?>