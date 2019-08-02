<?php include 'views/layouts/headerAdmin.php';?>
<div id="selClient">
	<select v-model="idCl" class='selectcl'>
		<option v-for="client in clients" v-bind:value="client.id">
			{{ client.name }}
		</option>
	</select>


<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr class="success">
			<th class="text-center">дата<br>замовлення</th>
			<th class="text-center">id</th>
			<th class="text-center">id<br>Замовлення</th>
			<th class="text-center">Отримувач</th>
			<th class="text-center">телефон</th>
			<th class="text-center">e-mail</th>
			<th class="text-center">адреса</th>
			<th class="text-center">перевізник</th>
			<th class="text-center">статус</th>
		</tr>
	</thead>
	<tbody v-for="order in orders">
		<tr>
			<td class="text-center">{{order.date_ord}}</td>
			<td class="text-center">{{order.id}}</td>
			<td class="text-center">
<a v-bind:href="/listClient/+order.id" title='редагувати запис' class='btn btn-default'>
	{{order.orderid}}
</a>
				</td>
			<td class="text-center">{{order.name}}</td>
			<td class="text-center">{{order.phone}}</td>
			<td class="text-center">{{order.email}}</td>
			<td class="text-center">{{order.adres}}</td>
			<td class="text-center">{{order.deliver}}</td>
			<td class="text-center">{{order.job}}</td>
		</tr>
	</tbody>
</table>
</div>
<?php include 'views/layouts/footerAdmin.php';?>
<script src="../js/vue/selClient.js"></script>