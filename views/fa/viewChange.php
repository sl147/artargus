<?php include 'views/layouts/headerAdmin.php';?>
<div id="FAEdit">
	<h2 class="text-center">Мистецька галерея робіт наших клієнтів</h2>
	<table class="table table-responsive table-bordered table-striped table-hover">
		<tr class='success'>			
			<th class="text-center">Фото</th>
			<th class="text-center">Найменування</th>
			<th class="text-center">Автор</th>
			<th class="text-center">опис</th>
			<th></th>
			<th></th>
		</tr>
		<tbody  v-for="FA in FAs">
			<td><img class='faimg' :src="FA.fotos" alt=""></td>
			<td>{{FA.name_FA}}</td>			
			<td>{{FA.log_FA}}</td>
			<td>{{FA.msgs_FA}}</td>
			<td>						
				<a class="btn btn-default btn-lg" :href="/faChange/+FA.id_FA" title="редагувати запис">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>
			</td>
			<td> 
				<button @click="delItem(FA)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
					<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
				</button>		
			</td>
		</tbody>
	</table>
	<?php if ($total > FA::SHOW_BY_DEFAULT) :?>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	<?php endif; ?>
</div>
<script>
window.pageFA=<?= $json ?>;
</script>
<script src="../js/vue/editFa.js"></script>