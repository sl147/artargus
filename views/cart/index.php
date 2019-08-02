<?php include 'views/layouts/header.php';?>

<div id='basket'>
<?php if (!empty($basketList)) :?>	
	<table class="zam table table-responsive table-striped table-hover table-bordered">
		<thead>
			<tr class="success">
				<th class="text-center hidden-xs">№</th>
				<th class="text-center hidden-xs"></th>
				<th class="text-center">Найменування</th>
				<th class="text-center hidden-xs">артикул</th>
				<th class="text-center">ціна</th>
				<th class="text-center" style="width:60px;">к-сть</th>
				<th class="text-center">сума</th>
				<th></th>
			</tr>
		</thead>
		<tbody v-for="bas in basket">
			<tr class="success">
				<td class="text-center hidden-xs">{{bas.i}}</td>
				<td class="text-center hidden-xs">			
					<div v-if="bas.kodCol" class="color_box" :style="{background:bas.kodCol}"></div>
					<div v-else>
						<div v-if="bas.foto">	
							<a class="fancybox" :title="bas.name" :href="bas.foto">
								<img class="fototovzam" :alt="bas.name" :src="bas.foto" />
							</a>
						</div>
					</div>
				</td>
				<td class="text-left">{{bas.name}}</td>
				<td class="text-left hidden-xs">{{bas.article}}</td>
				<td class="text-left">{{price(bas.price)}}</td>		
				<td>

					<input class="num text-center" type="number" min="0" v-model="bas.q" @change="change(bas)"/>
				
				</td>
				<td class="text-right">{{suma(bas.price,bas.q,bas)}}</td>
				<td>
					<button @click="clickDel(bas)" type='button' title='видалити запис' class='btn btn-default btn-xs'>
						<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
					</button>
				</td>
			</tr>
			</tbody>
			<tr class="success">
				<td class="text-center hidden-xs"></td>
				<td class="text-center hidden-xs"></td>
				<td class="text-center">Всього</td>
				<td></td>
				<td class="text-center hidden-xs"></td>
				<td class="text-center">{{totQ()}}</td>
				<td class="text-right">{{totSuma()}}</td>
				<td></td>
			</tr>						

	</table>
	<div class="text-center">
		<a class='btn btn-primary' href='/cart/orderform'>Оформити замовлення</a>
	</div>	
</div>
<?php else :?>
	<div class="text-center">
		<div class="alert alert-info" role="alert">
			<div class="row">
				<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10 velocityProduct'>
					<h2>Ваш кошик пустий</h2>
				</div>
				<div class='col-lg-1 col-md-11 col-sm-1 col-xs-1'>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php include 'views/layouts/footer.php';?>


<script src="../js/vue/basket.js"></script>