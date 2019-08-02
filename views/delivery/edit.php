<?php include 'views/layouts/headerAdmin.php';?>
<div id='deliveryEdit'>
<h1 class="text-center">Редагування перевізників</h1>
<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-lg-2 ol-md-1 col-sm-2 col-xs-4"></div>
				<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
<table class="table table-responsive table-bordered table-striped table-hover">
<thead>
	<tr>
		<th style='width:50px;' class='text-center'>id</th>
		<th style='width:250px;' class='text-center'>найменування</th>
		<th style='width:100px;'></th>		
	</tr>
</thead>
<tbody v-for="deliver in deliveries">
	<tr>
	<td style='width:50px;' class="text-center">{{deliver.id}}</td>
	<td style='width:250px;'><input style='width:300px;' type="text" v-model='deliver.name' ></td>
			<td style='width:100px;'>
			<button @click="edItem(deliver,deliver.name)" title='редагувати запис' class='btn btn-default btn-lg'>
				<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			</button>								
			<button @click="delItem(deliver)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
				<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
			</button>
		</td>
	</tr>
</tbody>	
</table>

				<div class="text-center">
					<button @click="show=!show" class='btn btn-info'>Додати новий</button>
				</div>
			
				<transition name="slide">
					<div v-show="show" class="text-center">										
						<br>Назва перевізника: <input style='width: 300px;' type = "text" v-model="nameDeliver" autofocus>
						<button @click="addItem()" class='btn btn-info'>
							<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
						</button>				
					</div>
				</transition>
</div>
</div>
</div>					
</div>
<?php include 'views/layouts/footerAdmin.php';?>

<script src="../js/vue/editDelivery.js"></script>