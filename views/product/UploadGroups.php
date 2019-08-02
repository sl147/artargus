<?php include 'views/layouts/headerAdmin.php';?>
	<? if (!$isUpload) :?>
		<h1>Завантаження груп товарів</h1>
	<? else :?>
		<div id = 'mod'>
		    <b-alert :show="dismissCountDown"
		             dismissible
		             variant="info"
		             @dismissed="dismissCountDown=0"
		             @dismiss-count-down="countDownChanged">
		      <h1 style="color: red">групи товарів завантажено</h1>
		    </b-alert>					
		</div>
	<? endif;?>	
	<form  id = "mtype" action = "" enctype="multipart/form-data" method = "post">
		Додати файл<input type="file" name="file"><br><br>
		<button name="submit" type="submit" class="btn btn-default">Завантажити</button>
	</form>
<?php include 'views/layouts/footerAdmin.php';?>
<script async src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
<script async src="../js/vue/vueAllert.js"></script>