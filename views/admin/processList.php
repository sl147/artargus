<?php include 'views/layouts/headerAdmin.php';?>
<div class="row-fluid">

	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
	<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">

		<table class="admTable table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">id</th>
					<th class="text-center">User</th>
					<th class="text-center">Host</th>
					<th class="text-center">db</th>
					<th class="text-center">command</th>
					<th class="text-center">time</th>
					<th class="text-center">state</th>
					<th class="text-center">info</th>
				</tr>	
			</thead>
			<tbody>
				<?foreach ($list as $item) :?>
				<tr>
					<td><?= $item['ID']?></td>
					<td><?= $item['USER']?></td>
					<td><?= $item['HOST']?></td>
					<td><?= $item['DB']?></td>
					<td><?= $item['COMMAND']?></td>
					<td><?= $item['TIME']?></td>
					<td><?= $item['STATE']?></td>
					<td><?= $item['INFO']?></td>
				</tr>
				<?endforeach;?>
			</tbody>	
		</table>
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