
<?php include 'views/layouts/headerAdmin.php';?>

<h1 class="text-center">Перегляд замовлень</h1>
<table>
	<tr>
		<th class="text-center" colspan="2">За період</th>
		<th class="text-center">Статус</th>
		<th class="text-center">Клієнт</th>
		<th class="text-center">телефон</th>
	</tr>
	<tr>
		<form class="formCalendar" action=""  method = "post">
			<td>
				з <input class="datepicker" name="date_begin" type="text" value="<?= $date_begin?>">
			</td>
			<td>
				по <input class="datepicker" name="date_ended" type="text" value="<?= $date_ended?>"> 
			</td>
			<td>
				<select class='selectcl' name = 'job'>";
					<?
					for ($j = 0; $j < count($jobs); $j++) {
						echo "<option value = '".$jobs[$j]['id']."'>".$jobs[$j]['name']."</option>";				
					}
					?>
				</select>
			</td>
			<td>
				<select class='selectcl' name = 'client'>";
					<?
					for ($j = 0; $j <= count($clients); $j++) {
						echo "<option value = '".$clients[$j]['id']."'>".$clients[$j]['name']."</option>";				
					}
					?>
				</select>
			</td>			
<!-- 			<td><input name="client" type="text" value="<?= $userName?>"></td> -->
			<td><input name="phone" type="text" value="<?= $phoneSelect?>"></td>
			<td>
				<button type="submit" name="submit" title="застосувати фільтр" class="btn btn-info btn">
					<spa class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
			</td>
			<td>
				<a href="/ordersfind">
				<button type="button" name="submit" title="очистити фільтр" class="btn btn-warning btn">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button></a>								
			</td>							
		</form>
	</tr>
</table><br>
<?
	include 'views/layouts/tabOrdersHead.php';
	foreach ($orders as $item) {
		include 'views/layouts/tabOrdersBody.php';
	}
	include 'views/layouts/tabClientFoot.php';
?>

<?php include 'views/layouts/footerAdmin.php';?>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="../js/jquery.ui.datepicker-uk.js"></script>
<script>
	$( function() {
		$( ".datepicker" ).datepicker( $.datepicker.regional[ "uk" ] );
	} );
</script>