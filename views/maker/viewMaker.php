<?php include 'views/layouts/headerAdmin.php';?>
<div id="maker">
	<h2 class="text-center">Редагування виробників</h2>
				<table class="table table-responsive table-bordered table-striped table-hover">
					<thead>
						<tr class='success'>
							<th class="text-center">Логотип</th>
							<th class="text-center">Сайт</th>
							<th class="text-center">Виробник</th>
							<th class="text-center">Країна</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="maker in makers">
							<td>
							<div v-if="maker.logo">
								<a class='fancybox' id='foto' v-bind:title='maker.name' v-bind:href='maker.fotL'>
				                    <img v-bind:alt='maker.name' v-bind:src='maker.fot'>
				                 </a>
							</div>
							<div v-else></div>
							</td>
							<td class="text-center">{{maker.site}}</td>
							<td class="text-center">{{maker.name}}</td>
							<td class="text-center">{{maker.country}}</td>
							<td>
<!-- 								<button @click="editItem(maker)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
									<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
								</button> -->
								<a v-bind:href="/editMaker/+maker.id" title='редагувати запис' class='btn btn-default btn-lg'>
									<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
								</a>								
								<button @click="delItem(maker)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
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
						<br>Назва виробника: <input style='width: 300px;' type = "text" v-model="nameM" autofocus>
						<button @click="addItem()" class='btn btn-info'>
							<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
						</button>				
					</div>
				</transition>
</div>
<?php include 'views/layouts/footerAdmin.php';?>

<script src="../js/vue/editMaker.js"></script>