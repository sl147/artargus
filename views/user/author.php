<?php include 'views/layouts/header.php';?>
<? if (isset($errors) && is_array($errors)) :?>
	<div class="showAlert">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				&times;
			</button>
			<ul>
			<?foreach ($errors as $error) :?>
						<li class="text-center">
							<?=$error?>
						</li>		
			<?endforeach;?>
			</ul>
			
		</div>
	</div>
<?endif;?>
<form id = "auth" method="POST">
	<fieldset>
		<legend><h4 class="text-center"><b>Реєстрація</b> <br> (поля відмічені <b style='color: red;'>червоним </b>обов'язкові до заповнення)</h4></legend>
		<div><label style='color:red'><b>Логін</label><input autofocus id="login" name="login" type="text" value="<?= $login?>"><br><br></div>
		<div><label style='color:red'>Пароль</label><input id="password" name="password" type="password" value="<?= $password?>"><br><br></div>
		<div><label style='color:red'>Повторіть пароль</label><input id="passwordConfirm" name="passwordConfirm" type="password" value="<?= $passwordConfirm?>"><br><br></div>
		<div><label style='color:red'>Ім'я</label></b><input id="name" name="name" type="text" value="<?= $name?>"><br><br></div>
		<div><label>Прізвище</label> <input name="surname" type="text" value="<?= $surname?>"><br><br></div>
		<div><label>E-mail</label> <input name="email" type="email" placeholder="E-mail" value="<?= $email?>"><br><br></div>
		<div><label>телефон</label> <input name="phone" type="tel" placeholder="phone" value="<?= $phone?>"><br><br></div>
        <div class="chek"><input style='width:40px; height: 30px' id="chekid" name="chek" type="checkbox" />                   
                    Я даю згоду інтернет-магазину ARTARGUS.IN.UA отримувати, зберігати і використовувати мої персональні дані: ім'я, прізвище, по батькові, поштову адресу, телефону, адресу електронної пошти для оформлення договорів купівлі-продажу, здійснення платежів, оформлення прийому-передачі товарів, оповіщення під час виконання замовлень, поширення комерційних електронних повідомлень і т.д. Мої персональні дані не можуть надаватися третім особам без моєї письмової згоди, за винятком випадків, передбачених законодавством України. 
                    </div><br><br>
		<div class = "text-center">
			<button class="btn btn-info" id="btn-chek" name="submit" type="submit">Зареєструвати</button>
		</div>
	</fieldset>
</form>


<?php include 'views/layouts/footer.php';?>

<script>
$(document).ready(function() {
  $('#btn-chek').prop('disabled', true);
  $('#chekid').change(function() {
    $('#btn-chek').prop('disabled', function(i, val) {
        return !val;
    });
  });
});
</script>