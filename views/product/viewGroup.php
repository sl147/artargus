<?php include 'views/layouts/headerAdmin.php';?>
<div id="group">
	<h2 class="text-center">Редагування груп товарів</h2>
	<div class="row-fluid">
		<div class="col-lg-2 col-md-1 col-sm-2 col-xs-4"></div>
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
			<table class="table table-responsive table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">назва</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="group in groups">
						<td  class="text-center">
							<input v-model="group.name" type="text"  />
						</td>
						<td>
							<button @click="edit(group)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
								<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>
							</button>
							<button @click="clickDel(group)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
								<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
							</button>
						</td>	
					</tr>
				</tbody>		
			</table>
			<table>
				<tr>
					<td class="text-center">
						<button @click="show=!show" class='btn btn-info'>Додати новий</button>
					</td>
				</tr>
				<transition name="slide">
					<tr v-show="show">
						<td class="text-center">							
							<br>Група: <input style='width: 300px;' type = "text" v-model="nameGroup" autofocus>
							<button @click="add()" class='btn btn-info'>
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

<script src="/js/vue/editGroup.js"></script>