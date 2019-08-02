<?php include 'views/layouts/header.php';?>

<? if (isset($errors) && is_array($errors)) :?>
<ul>
	<?foreach ($errors as $error) :?>
<li><?=$error?></li>
	<?endforeach;?>
</ul>
<?endif;?>

<?if ($result) :?>
<p>You are successfully edited</p>
<?endif;?>

<form id = "auth" method="POST">
	<fieldset>
		<legend><h4 class="text-center"><b>Редагування</b></h4></legend>
		<label><b>Логін</label><p><?= $login?></p><br>
		<label>Ім'я</label></b><input id="name" name="name" type="text" value="<?= $name?>"><br><br>
		<label>Прізвище</label> <input name="surname" type="text" value="<?= $surname?>"><br><br>
		<label>E-mail</label> <input name="email" type="email" placeholder="E-mail" value="<?= $email?>"><br><br>
		<label>Телефон</label> <input name="phone" type="text" placeholder="телефон" value="<?= $phone?>"><br><br>
		<div class = "text-center">
			<button class="btn btn-info" name="submit" type="submit">Змінити</button>
		</div>
	</fieldset>
</form>
<?php include 'views/layouts/footer.php';?>