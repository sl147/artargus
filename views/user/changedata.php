<?php include 'views/layouts/headerAdmin.php';?>
<h1>here</h1>
<form id = "auth" method="POST">
	<fieldset>
		<legend><h4 class="text-center"><b>Редагування</b></h4></legend>
		<label><b>Логін</label><p><?= $client['user_login']?></p><br>
		<label>Ім'я</label></b><input id="name" name="name" type="text" value="<?= $client['name']?>"><br><br>
		<label>Прізвище</label> <input name="surname" type="text" value="<?= $client['surname']?>"><br><br>
		<label>E-mail</label> <input name="email" type="email" placeholder="E-mail" value="<?= $client['email']?>"><br><br>
		<label>телефон</label> <input name="phone" type="text" placeholder="телефон" value="<?= $client['phone']?>"><br><br>
		<div class = "text-center">
			<button class="btn btn-info" name="submit" type="submit">Змінити</button>
		</div>
	</fieldset>
</form>
<?php include 'views/layouts/footerAdmin.php';?>