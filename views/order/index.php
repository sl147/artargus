<?php include 'views/layouts/headerAdmin.php';?>

<h1 class="text-center">Перегляд замовлень</h1>

<ul class="nav nav-tabs">
	<li id="myTab" class="active"><a href="#tab1" data-toggle="tab"><h4>всі</h4></a></li>
	<li><a href="#tab2" data-toggle="tab"><h4>в роботі</h4></a></li>
	<li><a href="#tab3" data-toggle="tab"><h4>виконані</h4></a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in active" id="tab1">
		<?
			include 'views/layouts/tabOrdersHead.php';
			foreach ($ordersAll as $item) {
				include 'views/layouts/tabOrdersBody.php';
			}
			include 'views/layouts/tabClientFoot.php';
		?>
	</div>

	<div class="tab-pane fade" id="tab2">
	<?
		include 'views/layouts/tabOrdersHead.php';
		foreach ($orders as $item) {
			include 'views/layouts/tabOrdersBody.php';
		}
		include 'views/layouts/tabClientFoot.php';
	 ?>	
	</div>

	<div class="tab-pane fade" id="tab3">
	<?
		include 'views/layouts/tabOrdersHead.php';
		foreach ($ordersMade as $item) {
			include 'views/layouts/tabOrdersBody.php';
		}
		include 'views/layouts/tabClientFoot.php';
	?>	
	</div>

</div>
<?php include 'views/layouts/footerAdmin.php';?>

	
<script type="text/javascript" language="javascript">
$(document).ready(function() {

	//clients
	$('.anppRoleAdm').hover(function(){
		var id= $(this).data("rladm")
		var idCl  = $(this).find('select#idRole')
		console.log("#   id="+id+"  val="+idCl.val())

		idCl.change(function(){			
			//var idMan = $("#idCl :selected").val();
			var idMan = idCl.val()
			console.log("#idCl - change  idCl="+idMan+"   id="+id)
			$.post('/changeStatus',{ id: id, job: idMan},function(data){
				location.reload();
			})	
		})
	})
})
</script>