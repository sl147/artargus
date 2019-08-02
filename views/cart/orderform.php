<?php include 'views/layouts/header.php';?>

<div class='authB'>
	<form id = "orderform" method="POST" action = "">
		<fieldset>
			<legend align="center"><b>оформлення замовлення </b><br><?= $orderId?><br>  (поля відмічені <b style='color: red;'>червоним </b>обов'язкові до заповнення)</legend>
			<label style='color:red'>Ім'я</label><input required id="name" name="name" type="text" value="<?= $name?>"><br><br>
			<label style='color:red'>Прізвище</label><input required id="surname" name="surname" type="text" value="<?= $surname;?>"><br><br>
			<label style='color:red'>Телефон</label><input required id="phone" name="phone" type="text" value="<?= $phone;?>"><br><br>
			<label style='color:red'>E-mail</label><input required id="email" name="email" type="email" placeholder="E-mail" value="<?= $email;?>"><br><br>
			<div style='color:red; '><b>Місто, адреса доставки</b></div><textarea autocomplete="on" required placeholder="Введіть місто,  якщо доставка додому(офісу) то адресу" name="adres" type="text" rows ='3' class = 'txtareawidth'><?echo $adres;?></textarea><br><br>
			<label style='color:red'>Перевізник</label>
				<select class='selectcl' name = 'deliver' required>";
					<?
					foreach ($deliverList as $item) {
						echo"<option value = '".$item['id']."'>".$item['name']."</option>";
					}
					?>										
				</select><br><br>
				<label>Склад перевізника</label><input name="sklad" type="text" value="<?echo $sklad;?>"><br><br>									
				<label style='color:red'>Спосіб оплати</label>
					<select class='selectcl' name = 'pay' required>";
						<?
							foreach ($payList as $pay) {
							echo"<option value = '".$pay['id']."'>".$pay['name']."</option>";
						}
						?>
					</select><br><br>
					Примітки<br><textarea name="note" type="text" rows ='3' class = 'txtareawidth'><?= $note;?></textarea><br><br>
        
					
				        <div class="chek"><input style='width:40px;' id="chekid" name="chek" type="checkbox" />                   
				            Я даю згоду інтернет-магазину ARTARGUS.IN.UA отримувати, зберігати і використовувати мої персональні дані: ім'я, прізвище, по батькові, поштову адресу, телефону, адресу електронної пошти для оформлення договорів купівлі-продажу, здійснення платежів, оформлення прийому-передачі товарів, оповіщення під час виконання замовлень, поширення комерційних електронних повідомлень і т.д. Мої персональні дані не можуть надаватися третім особам без моєї письмової згоди, за винятком випадків, передбачених законодавством України. 
				        </div><br><br>
					
					<div class = "text-center">
					<div class='text-center'><button id="btn-chek" type="submit" name="submit" class="btn btn-info btn-sm"> Зареєструвати </button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
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