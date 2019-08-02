<?php include 'views/layouts/header.php';?>

<div class="container-fluid">
	<div class="row">
		<div class='col-lg-2 col-md-3 col-sm-0 col-xs-0 text-center'>
			<img class="imgContakt" src="/image/7.jpg">
		</div>
		<div class='col-lg-7 col-md-7 col-sm-11 col-xs-12'>
			<div class="conttxt">
				<p>адреса: м.Дрогобич Львівська обл, пл.Ринок,17 (магазин "Верховина")</p>
				<p>тел (067) 7472881  - Анна</p>
				<!-- <p>e-mail: admin@artargus.in.ua</p><br> -->
				<p>e-mail: 
				<img src="/components/imgMail.php?name=admin&domain=artargus&zone=in.ua&txr=180&txg=0&txb=180" alt="">
				</p>

				<p>Години роботи</p>
				<p>понеділок - п'ятниця: з 10 до 17</p>
				<p>субота: з 10 до 14</p>
				<p>неділя: Вихідний</p>
			</div>
		</div>
	</div>
</div>

<h4 class="text-center">Будем раді отримати від Вас пропозиції, побажання, відгуки про наш сайт.</h4>

			<form id = "auth3" method="POST" class="form-horizontal">
				<fieldset>
					<legend>Додати повідомлення</legend>
					<div><label>Ім'я</label>
						<input  id="nik_com" name="nik_com" type="text">
					</div><br>
					<div><label>E-mail<br>(необов’язково)</label>
						<input name="email_com" type="email">
					</div><br><br>
					<div>Повідомлення<br>
						<textarea name = "txt_com" rows ='7' ></textarea>
					</div>
					<div class = "text-center">
						<button class="btn btn-defoult" name="submit" type="submit">Відправити</button>
					</div>
				</fieldset>
			</form>

<div class='maps'>


	
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2599.1836464774824!2d23.501452115393146!3d49.34867257933855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473a4ea75da1af95%3A0x34285f31c87ed517!2z0JLRgdC1INC00LvRjyDRhdGD0LTQvtC20L3QuNC60LA!5e0!3m2!1suk!2sua!4v1508955277680" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<!--<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=-G_16u_rVqn58gXur0_6-r2gcpNb-nOy&width=100%&height=300&lang=uk_UA&sourceType=constructor"></script> -->

</div>
<?php include 'views/layouts/footer.php';?>