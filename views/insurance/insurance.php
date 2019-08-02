<?php include 'views/layouts/headerInsurance.php';?>
	<div id="sljarInsurance">
		<!-- <img src="../image/1.jpg" class="bgFull"> -->
		<div class="str-main" v-cloak >
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
					<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">
						  <div class='reklPicture'>
						    <a href='https://artargus.in.ua' target='_blank'>
						      <img class="argusImg" src='/image/art.jpg' alt='товари для художників' title='все для художників' border='2'>
						    </a><br><br>
						    <img class="argusImg" src="/image/Logo_last.png">
						  </div>
						  <div>
						  	<a href="/autosign" class="btn btn-primary btn-block">Авто номера</a>
						  	<a href="/insurance" class="btn btn-primary btn-block">Калькулятор автоцивілки</a>
						  </div>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
					<div class='col-lg-4 col-md-4 col-sm-10 col-xs-12'>		
						<div class='auth'>
							<h3 class="text-center var">КАЛЬКУЛЯТОР АВТОЦИВІЛКИ</h3>
								<span>Тип транспортного засобу</span><br>
								<select v-model="k1">
									<option v-for="option in typeVechicle" v-bind:value="option.value">
										{{ option.type }} {{ option.name }}
									</option>
								</select><br><br>

								<span>Місце реєстрації транспортного засобу</span><br>
								<span>Населені пункти з населенням</span><br>
								<select v-model="k2">
									<option v-for="option in typeRegister" v-bind:value="option.value">
										{{ option.name }}
									</option>
								</select><br><br>

								<span>Пільги</span><br>
								<select v-model="k6">
									<option v-for="option in options_privilege" :value="option.value">
										{{ option.text }}
									</option>
								</select><br><br>

								<span>Використання</span><br>
								<select v-model="used">
									<option v-for="option in options_used" :value="option.id">
										{{ option.text }}
									</option>
								</select><br><br>

								<span>Термін дії поліса</span><br>
								<select v-model="k5">
									<option v-for="option in options_TD" :value="option.value">
										{{ option.text }}
									</option>
								</select><br><br><br>

							<div class="text-center var">Вартість {{ suma }} грн</div> 
						</div>
						<p class="dnister">Інформація надана</p>
						<span style="font-weight:bold; font-size: 14px;" class="dnister">ПрАТ “АКЦІОНЕРНА СТРАХОВА КОМПАНІЯ “ДНІСТЕР”</span><br>
						<span class="dnister">м.Львів, вул. Городоцька,174.</span><br>
						<span class="dnister">код ЄДРПОУ 1380047</span><br>
						<span class="dnister">Тел./факс: (032) 297-60-63, 297-60-66.</span><br>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
					<div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
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

						<? if (empty($comment)) :?>
							<div class="text-center">
						    <h4>Коментарів немає</h4>
						    </div>
						<? else :?>

						<h5 class="text-center">Коментарів <?= count($comment)?></h5>
						    <?php foreach ($comment as $item) :?>
						    	
						        <p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
						        <p class="news_Comment"><?=$item['text'] ?></p>
						        <br>
						    <?php endforeach; ?>	
						<? endif; ?>						
					</div>					
				</div>
			</div>
		</div>
	</div>

<script src="/libs/jquery/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/vue/insurance.js"></script>	