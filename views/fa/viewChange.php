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
			<td></td>
			<td>{{FA.name}}</td>			
			<td>{{FA.logo}}</td>
			<td>{{FA.msgs}}</td>
			<td>						
				<a class="btn btn-default btn-lg" v-bind:href="/faChange/+FA.id" title="редагувати запис">
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
</div>

<script src="../js/vue/editFa.js"></script>