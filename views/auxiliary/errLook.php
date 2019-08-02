<?php include 'views/layouts/headerAdmin.php';?>
	<? if (!$isUpload) :?>
		<h1>input find text</h1>
	<? else :?>
	<p>id = <?=$id?></p>
	<? endif;?>	
	<form  method = "post">
		find <input type="text" name="text"><br><br>
		<button name="submit" type="submit" class="btn btn-default">Завантажити</button>
	</form>
<?php include 'views/layouts/footerAdmin.php';?>