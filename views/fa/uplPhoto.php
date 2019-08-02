<?php include 'views/layouts/headerAdmin.php';?>
	<h3 class="text-center">Загрузка фотографій</h3>		  
	<form enctype="multipart/form-data" method="post">
	<input type="hidden" name="MAX_FILE_SIZE"  />
	Виберіть фотографію з Вашого комп'ютера
	<input type="file" name="file" multiple accept="image/*,image/jpeg">
	<br><br>Підпис до фото<input type="text" name="subscribe" size="60" placeholder="Підпис до фото"><br><br>
	<button type="submit" name="submit">Створити</button>
</form>
<?php include 'views/layouts/footerAdmin.php';?>