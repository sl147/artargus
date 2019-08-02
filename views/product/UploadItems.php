<?php include 'views/layouts/headerAdmin.php';?>
<div id="loadGif">
	<div v-cloak>
	<? if (!$isUpload) :?>
		<div class='text-center'>
			<h1>Завантаження залишків товарів</h1>
			<form class="formloader" id = "mtype" action = "" enctype="multipart/form-data" method = "post">
				Додати файл<input type="file" name="file"><br><br>
				<button @click="showGif=!showGif" name="submit" type="submit" class="btn btn-default">Завантажити</button>
			</form>
			<div v-show='showGif' class='loaderDiv'><img src="../image/loading.gif"></div>
		</div>	
	<? else :?>
		<h1 class="text-center" style="color: red">залишки товарів завантажено</h1>
	<? endif;?>

		<? if ($notFile) :?>
			<h2 class="text-center" style="color: red">виберіть файл для завантаження</h2>
		<? $notFile=false; endif;?>

	</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
<script type="text/javascript">
	var vue_sign = new Vue({
		el:'#loadGif',
		data: {
			showGif: false,
			showtxt: true,
			load: false
		}
	})
</script>