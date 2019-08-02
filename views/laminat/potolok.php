<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/Redmond/jquery-ui.css">
	<script src="../libs/jquery/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/vue.min.js"></script>
</head>
<body>
	<div id="sljarKalk">
		<div v-cloak >
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
					<div class='col-lg-6 col-md-6 col-sm-10 col-xs-12'>
						<h3 class="text-center">Рабочий калькулятор</h3>
						<h3 class="text-center">Просчет подвесного потолка</h3>
<table class="table table-bordered table-striped table-hover">
	<tbody>
		<tr>
			<td>Количество квадратных метров:</td>
			<td>{{kolKM}}</td>
		</tr>
		<tr>
			<td>Длина помещения:</td>
			<td><input type="text" v-model="length" ></td>
		</tr>
		<tr>
			<td>Ширина помещения:</td>
			<td><input type="text" v-model="width" ></td>
		</tr>
		<tr>
			<td>Периметр помещения:</td>
			<td>{{perimetr}}</td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<th>№</th>
		<th>Наименование</th>
		<th>Требуемое кол-во</th>
	</thead>
	<tbody>
		<tr v-for='(option, index) in options'>
			<td>{{index+1}}</td>
			<td>{{option.text}}</td>
			<td>{{option.value}}</td>
		</tr>
	</tbody>
</table>
					</div>
				</div>
			</div>
		</div>	
	</div>

<script src="../js/vue/kalkPotolok.js"></script>
</body>
</html>