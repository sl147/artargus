<?php include 'views/layouts/headerInsurance.php';?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
		<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">
			<div>
				<a href="/insurancePlugin/ukr" class="textwidth btn btn-primary btn-block">Укр</a>
				<a href="/insurancePlugin/en" class="textwidth btn btn-primary btn-block">En</a>
			</div>
<!-- 			<div class='reklPicture'>
				<a href='https://artargus.in.ua' target='_blank'>
					<img class="argusImg" src='/image/art.jpg' alt='товари для художників' title='все для художників' border='2'>
				</a><br><br>
				<img class="argusImg" src="/image/Logo_last.png">
			</div>
			<div>
				<a href="/autosign" class="textwidth btn btn-primary btn-block">Авто номера</a>
				<a href="/insurance" class="textwidth btn btn-primary btn-block">Калькулятор автоцивілки</a>
			</div> -->
		</div>
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class='col-lg-6 col-md-6 col-sm-10 col-xs-12'>	
			<h2 class="text-center">калькулятор розрахунку вартості ОСЦПВ</h2>
			<h2 class="text-center"> для України</h2>
<ul class="nav nav-tabs">
	<li id="myTab" class="active"><a href="#tab1" data-toggle="tab"><h4>деталі</h4></a></li>
	<li><a href="#tab2" data-toggle="tab"><h4>відгуки</h4></a></li>
	<li><a href="#tab3" data-toggle="tab"><h4>встановлення</h4></a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in active" id="tab1">
		<p>Опис</p>
		<p>
			Це калькулятор розрахунку вартості обов’язкового страхування цивільно-правової відповідальності власників наземних транспортних засобів для України.
			</p>
		<p>	Основні функції калькулятора:</p>
		<p>
			Розраховує вартість поліса обов’язкового страхування цивільно-правової відповідальності власників наземних транспортних засобів згідно закону України.
		</p>
		<p>
			Враховує тип транспортного засобу(ТЗ), місце реєстрації ТЗ, пільги власника ТЗ, термін дії
		</p>
		<p>
			Калькулятор не враховує індивідуальні знижки чи надбавки страхових компаній для власника ТЗ
		</p>
	</div>
	<div class="tab-pane fade" id="tab2">
								<? if (empty($comment)) :?>
							<div class="text-center">
						    <h4>Відгуків немає</h4>
						    </div>
						<? else :?>

						<h5 class="text-center">Відгуків <?= count($comment)?></h5>
						    <?php foreach ($comment as $item) :?>
						    	
						        <p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
						        <p class="news_Comment"><?=$item['text'] ?></p>
						        <br>
						    <?php endforeach; ?>	
						<? endif; ?>
						<form id = "formCom" method="POST">
							<fieldset>
								<legend class="text-center">Додати коментар</legend>
								<label class="text-center">Ім'я</label>
								<input name="nik_com" type="text"><br><br>
								<label class="text-center">Коментар</label>
								<textarea align='center' name = "txt_com" rows ='3' maxlength="2000"></textarea>
								<input id="check" name="check" type="hidden" value="" />
								<div class="text-center"><button name="submit" type="submit" class="btn btn-info btn-block">додати</button></div>
							</fieldset>
						</form><br>						
	</div>
	<div class="tab-pane fade" id="tab3">
		<p>
			Завантажте плагін на Вашу сторінку. Активуйте його.
		</p>
		<p>
			Для використання плагіну використовується шорткод [sljar_mtplI_box].
		</p>
		<p>
			Розмістіть його на Вашій сторінці у тому місці, де Ви хочете його бачити і цього буде достатньо.
		</p>
	</div>
</div>

		</div>
	</div>
</div>
<script src="/libs/jquery/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- <script src="/js/vue.min.js"></script>
<script src="/js/vue/insurance.js"></script>	 -->