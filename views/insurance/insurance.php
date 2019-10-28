<?php include 'views/layouts/headerInsurance.php';?>
	<div id="sljarInsurance">
		<!-- <img src="../image/1.jpg" class="bgFull"> -->
		<div class="str-main" v-cloak >
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
					<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">
						<?php include 'views/insurance/insLeftSide.php';?>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
					<div class='col-lg-4 col-md-4 col-sm-10 col-xs-12'>		
						<div class='auth'>
							<h3 class="text-center var">КАЛЬКУЛЯТОР АВТОЦИВІЛКИ</h3>
								<span class="colSpan">Тип транспортного засобу</span><br>
								<select class="colSelect" v-model="k11">
									<option v-for="option in options_k1" :value="option.value">
										{{ option.type }} {{ option.name }}
									</option>
								</select><br>

								<span class="colSpan">Місце реєстрації транспортного засобу</span><br>
								<span class="colSpan">Населені пункти з населенням</span><br>
								<select class="colSelect" v-model="k22">
									<option v-for="option in options_k2" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<span class="colSpan">Використання</span><br>
								<select class="colSelect" v-model="k3">
									<option v-for="option in options_k3" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<span class="colSpan">Власник ТЗ</span><br>
								<select class="colSelect" v-model="k44">
									<option v-for="option in options_k4" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<span class="colSpan">Термін дії поліса</span><br>
								<select class="colSelect" v-model="k5">
									<option v-for="option in options_k5" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<!-- <span>Показники збитковості</span><br> -->

								<span class="colSpan">Строк дії договору</span><br>
								<select class="colSelect" v-model="k7">
									<option v-for="option in options_k7" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<span class="colSpan">Спосіб укладення договору</span><br>
								<select class="colSelect" v-model="k8">
									<option v-for="option in options_k8" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<span class="colSpan">Пільги</span><br>
								<select class="colSelect" v-model="k9">
									<option v-for="option in options_k9" :value="option.value">
										{{ option.text }}
									</option>
								</select><br>

								<span class="colSpan">Франшиза</span><br>
								<select class="colSelect" v-model="fr">
									<option v-for="option in options_Fr" :value="option.value">
										{{ option.text }}
									</option>
								</select><br><br>

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