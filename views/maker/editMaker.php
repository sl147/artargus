<?php include 'views/layouts/headerAdmin.php';?>

<h1 class="text-center">Редагування <?= $makerItem["name"]?></h1>
<form class="authmaker" enctype="multipart/form-data" method="POST">
<label>Найменування:</label><input style='height:30px;' type = "text" name = "name" value="<?= $makerItem["name"]?>" /><br><br>
<label>Країна:</label>
<input style='height:30px;' type = "text" name = "country" value="<?= $makerItem["country"]?>" /><br><br>
<label>сайт:</label>
<input style='height:30px;' type = "text" name = "site" value="<?= $makerItem["site"]?>" /><br><br>
Характеристика:<br>
<textarea name = "descr" rows ='10' cols = '100'><?= $makerItem["descr"]?></textarea><br><br>	

<?if ($makerItem["logo_m"]) :?>
<div style="height: 140px;">
	<div style="float: left;">
		<a title='<?= $makerItem["name"]?>' href='<?= $makerItem["logo"]?>'>
			<img  alt='<?= $makerItem["name"]?>' src='<?= $makerItem["logo_m"]?>'>
		</a>
	</div>
	<div style='float: right;padding-right: 90px;'>
		<input type = "checkbox" name = "FotoDel" /> Видалити фото<br><br>
	</div>
</div>
<?endif;?>
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
Виберіть файл логотипу: <input name="file" type="file" />
<button type='submit' name='submit' class='btn btn-success btn-group-2'> Змінити </button>
</form>
<?php include 'views/layouts/footerAdmin.php';?>

<script>
	CKEDITOR.replace('descr');	  
</script>