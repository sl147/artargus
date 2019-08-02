<?php include 'views/layouts/headerAdmin.php';?>

<div id="tz">

	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h2 class="text-center"><?= $title?></h2>	
			
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">тип ТЗ</th>
						<th class="text-center">найменування</th>
						<th class="text-center">коефіцієнт</th>
						<th></th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					<tr v-for="elm in elements">
						<td class="text-center">
							<input v-model="elm.type" type="text" style="width:100px;" />
						</td>
						<td class="text-center">
							<input v-model="elm.name" type="text" style="width:400px;" />
						</td>
						<td class="text-center">
							<input v-model="elm.k1" type="number" step="0.01" style="width:100px;" />
						</td>						
						<td>
							<button @click="editElement(elm)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
								<i class="fa fa-edit fa-fw"></i>
							</button>
						</td>
						<td>
							<button @click="deleteElement(elm)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
								<i class="fa fa-trash fa-fw"></i>
							</button>
						</td>	
					</tr>					
				</tbody>
			</table>

			<button @click="show=!show" class='btn btn-info'>Додати новий</button>
			
			<transition @before-enter="beforeEnter"
					    @enter="enter"
					    v-bind:css="false">
				<div v-if="show" class="">						
					<br>тип ТЗ: <input style='width: 100px;' type = "text" v-model="type" autofocus>
					Найменування: <input style='width: 400px;' type = "text" v-model="newname">
					коефіцієнт: <input style='width: 100px;' type = "number" v-model="k1" step="0.01">
					<button @click="add2el()" class='btn btn-info'>
						<i class="fa fa-plus fa-fw"></i>
					</button>
				</div>
			</transition>
		</div>
	</div>			
</div>

<?php include 'views/layouts/footerAdmin.php';?>
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script> -->
<script src="/js/vue/ins_tz.js"></script>