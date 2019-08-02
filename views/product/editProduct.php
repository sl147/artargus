<?php include 'views/layouts/headerAdmin.php';?>

<h2 class="text-center">Редагування<br><?= $item["name"]?></h2>

<form class="authmaker" enctype="multipart/form-data" method="POST">
<label>Код товару:</label>
<b><?= $item["kod_t"]?></b><br><br>
<label >Найменування:</label>
<input style='width: 75%;' type = "text" name = "name" value="<?= $item["name"]?>" /><br><br>
<label>Артикул:</label><input type = "text" name = "article" value="<?= $item["article"]?>" /><br><br>

<label>Ціна:</label>
<input type = "text" name = "price" value="<?= $item["price"]?>" /><br><br>

<label>Код кольору:</label>
<input type = "text" name = "kodCol" value="<?= $item["kodCol"]?>" /><br><br>
<?
	array_unshift($brandGr, []);
	$brandGr[0]['id'] = $item['brand'];
	$brandGr[0]['name']    = $item['brandName'];
?>
<label>бренд:</label>
<select class='selectMan' name = 'brand' id = 'idCl' title='виберіть бренд'>
	<?
	for ($j = 0; $j < count($brandGr); $j++) {
		echo "<option value = '".$brandGr[$j]['id']."'>".$brandGr[$j]['name']."</option>";
	}
	?>	
</select><br><br>
Характеристика:<br>
<textarea name = "descr" rows ='10' cols = '100'><?= $item["descr"]?></textarea><br><br>	

<?if ($item["foto"]) :?>
<div style="height: 140px;">
	<div style="float: left;">
		<a class='fancybox' title='<?= $item["name"]?>' href='<?= $item["fotLGr"]?>'>
			<img width="150" height="auto" alt='<?= $item["name"]?>' src='<?= $item["fotLGr"]?>'>
		</a>
	</div>
	<div style='float: right;padding-right: 90px;'>
		<input type = "checkbox" name = "FotoDel" /> Видалити фото<br><br>
	</div>
</div>
<?endif;?>
<input type="hidden" name="MAX_FILE_SIZE"  />
Виберіть файл: <input name="file" type="file" />
<input type="hidden" name="fullKod" value="<?= $item["fullKod"]?>" />
<input type="hidden" name="ThisGroup" value="<?= $item["ThisGroup"]?>" />
<input type="hidden" name="id" value="<?= $item["id"]?>" />
<button type='submit' name='submit' class='btn btn-success btn-group-2'> Змінити </button>
</form>
<?php include 'views/layouts/footerAdmin.php';?>

<script>
	CKEDITOR.replace('descr');	  
</script>