<?php include 'views/layouts/headerAdmin.php';?>
<div id="productsEdit">
<h1 class="text-center">Редагування товарів</h1>

<select v-model="kodTovParent" class="selectcl">
	<option v-for="parent in parents" v-bind:value="parent.kodTov">
		{{ parent.name }}
	</option>
</select>
<br><br>
<table class="table table-responsive table-bordered table-striped table-hover">
<thead>
	<tr class='success'>
		<th class='text-center'>id</th>
		<th class='text-center'>Група</th>
		<th class='text-center'>Код<br>товару</th>
		<th class='text-center'>фото<br>товару</th>
		<th class='text-center'>Бренд</th>
		<th class='text-center'>Найменування<br>товару</th>
		<th class='text-center'>Ціна<br>товару</th>
		<th class='text-center'>Залишок<br>товару</th>	
		<th class='text-center'></th>
	</tr>
</thead>
<tbody  v-for="group in groups">
	<tr>
		<td class="text-center">{{group.id}}</td>
		<td class="text-center">
			<button :key="group.id" @click="getGroupItem(group)" type="button" title="змінити статус" class="btn btn-info btn">
				  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</button>
			</td>
		<td class="text-center">{{group.kod_t}}</td>
		<td class="text-center">	
			<div v-if="group.foto">
				<a class="fancybox" :href="group.fotLGr"> 
				  <img :src="group.fotLGr" width="50" height="auto" />
				</a>
			</div>
			<div v-else class="color_box" :style="{background:group.kodCol}">
				
			</div>
		</td>
		<td class="text-center">{{group.brand}}</td>
		<td class="text-center" style="width:400px;">{{group.name}}</td>
		<td class="text-center">{{group.price}}</td>
		<td class="text-center">{{group.countTov}}</td>
		<td>
			<a v-bind:href="/editProducts/+group.id" title='редагувати запис' class='btn btn-default btn-lg'>
				<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			</a>								
			<button @click="delGroup(group)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
				<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
			</button>
		</td>
	</tr>
	<template v-if="group.isPlus">
	<tr v-for="item in items">
		<td class="text-center">{{item.id}}</td>
		<td class="text-center">
			<button type="button" title="змінити статус" class="btn btn-default btn-xs">
				  <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
			</button>
			</td>
		<td class="text-center">{{item.kod_t}}</td>
		<td class="text-center">
			<div v-if="item.foto">
				<a class="fancybox" :href="item.fotLIt"> 
				  <img :src="item.fotLIt" width="50" height="auto" />
				</a>
			</div>
			<div v-else class="color_box" :style="{background:item.kodCol}"></div>
		</td>
		<td class="text-center">{{item.brand}}</td>
		<td class="text-center" style="width:400px;">{{item.name}}</td>
		<td class="text-center">{{item.price}}</td>
		<td class="text-center">{{item.countTov}}</td>
				<td>
			<a v-bind:href="/editProducts/+item.id" title='редагувати запис' class='btn btn-default btn-lg'>
				<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			</a>								
			<button @click="delItem(item)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
				<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
			</button>
		</td>
	</tr>		
	</template>
</tbody>	
</table> 
</div>
<?php include 'views/layouts/footerAdmin.php';?>

<script src="../js/vue/editProduct.js"></script>