<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap-theme.min.css" />

<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script> -->

<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/vue.resource/1.0.2/vue-resource.min.js"></script> -->
	<link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/Redmond/jquery-ui.css">       

	<script src="../libs/jquery/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="/js/vue.min.js"></script>
</head>
<body>

	<div id="sljarKalk">
		<div v-cloak >
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
					<div class='col-lg-6 col-md-6 col-sm-10 col-xs-12'>
						<h3 class="text-center">Кулькулятор расчета ламината</h3>
						<label for="square">Введите площадь помещения:</label>
						<input type="text" v-model="square" required :value="square">
						
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr  class='success'>
								<th class="text-center">№</th>
								<th class="text-center">Тип укладки</th>
								<th class="text-center">Коефициент</th>
								<th class="text-center">Требуемое действие</th>
								<th class="text-center">Итого</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Прямая укладка</td>
									<td>1,05</td>
									<td>Площадь умножить на коеф.</td>
									<td>{{it1}}</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Диагональная укладка</td>
									<td>1,1</td>
									<td>Площадь умножить на коеф.</td>
									<td>{{it2}}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-1 col-xs-0">
						<div style="padding-top: 50px;">
						<span style="padding-left: 25px;">Прямая укладка</span><span style="padding-left: 60px;">Диагональная укладка</span>
						<img src="../views/laminat/im1.png" alt="">
						<img src="../views/laminat/im2.png" alt="">							
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
<script src="../js/vue/kalk.js"></script>
</body>
</html>