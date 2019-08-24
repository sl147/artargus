<?php include 'views/layouts/headerAdmin.php';?>
<div id="admin">
<div class="row-fluid">
	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
	<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
		<? if ($total) :?>
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
				<tbody v-for="order in orders">
					<tr>
						<td>{{order.id_ord}}</td>
						<td>
							<a :href="/look/+order.id_ord" title='Переглянути замовлення'>
								{{order.orderid}}
							</a>							
						</td>
						<td>{{order.name}}</td>
						<td>{{order.phone}}</td>
						<td>{{order.email}}</td>
						<td>{{order.status}}</td>
					</tr>
				</tbody>	
			</table>
		<? endif;?>	
	<?php if ($total > Order::SHOW_BY_DEFAULT) :?>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	<?php endif; ?>	
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
</div>
<?php include 'views/layouts/footerAdmin.php';?>
<script>
window.admin=<?= $json ?>;
</script>
<script src="../js/vue/admin.js"></script>