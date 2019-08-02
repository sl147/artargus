<?php include 'views/layouts/headerAdmin.php';?>
<div id="vue2el">
	<h2 class="text-center"><?= $title?></h2>
	<div class="row-fluid">
		<div class="col-lg-3 col-md-2 col-sm-2 col-xs-4"></div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th></th>
						<th class="text-center">найменування</th>
						<th></th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					<tr v-for="elm in elements">
						<td  class="text-center">
							{{elm.id}}
						</td>
						<td  class="text-center">
							<input v-model="elm.name" type="text" style="width:400px;" />
						</td>
						<td>
							<button @click="edit2el(elm)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
								<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>
							</button>
						</td>
						<td>
							<button @click="del2el(elm)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
								<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
							</button>
						</td>	
					</tr>					
				</tbody>
			</table>
			<table>
				<tr class="text-center">
					<td>
						<button @click="show=!show" class='btn btn-info'>Додати новий</button>
					</td>
				</tr>
				<transition name="slide">
					<tr v-show="show">
						<td class="text-center">							
							<br>Найменування: <input style='width: 300px;' type = "text" v-model="nameElement" autofocus>
							<button @click="add2el()" class='btn btn-info'>
								<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
							</button>							
						</td>
					</tr>
				</transition>				
			</table>
		</div>
	</div>			
</div>

<?php include 'views/layouts/footerAdmin.php';?>
<script>
	window.table=<?= $json ?>;
</script>
<script src="/js/vue/vue2el.js"></script>