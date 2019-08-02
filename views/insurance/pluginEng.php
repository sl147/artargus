<?php include 'views/layouts/headerInsurance.php';?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
		<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">
			<div>
				<a href="/insurancePlugin/ukr" class="textwidth btn btn-primary btn-block">Укр</a>
				<a href="/insurancePlugin/en" class="textwidth btn btn-primary btn-block">En</a>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class='col-lg-6 col-md-6 col-sm-10 col-xs-12'>	
			<h2 class="text-center">MTPL Insurance calculator</h2>
			<h2 class="text-center"> only for Ukraine</h2>
			<ul class="nav nav-tabs">
				<li id="myTab" class="active"><a href="#tab1" data-toggle="tab"><h4>details</h4></a></li>
				<li><a href="#tab2" data-toggle="tab"><h4>feedback</h4></a></li>
				<li><a href="#tab3" data-toggle="tab"><h4>installation</h4></a></li>
				<!-- <li><a href="#tab4" data-toggle="tab"><h4>download</h4></a></li> -->
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1">
					<p>Description</p>
					<p>
						This is MTPL Insurance calculator only for Ukraine.
					</p>
					<p>
						Calculates the cost of a MTPL Insurance in accordance with the law of Ukraine.
					</p>
					<p>
						The calculator does not take into account individual discounts or insurance premium supplements for the owner
					</p>
				</div>
				<div class="tab-pane fade" id="tab2">
					<? if (empty($comment)) :?>
						<div class="text-center">
							<h4>no feedback</h4>
						</div>
						<? else :?>

							<h5 class="text-center">feedbacks <?= count($comment)?></h5>
							<?php foreach ($comment as $item) :?>

								<p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
								<p class="news_Comment"><?=$item['text'] ?></p>
								<br>
							<?php endforeach; ?>	
						<? endif; ?>
						<form id = "formCom" method="POST">
							<fieldset>
								<legend class="text-center">add comment</legend>
								<label class="text-center">name</label>
								<input name="nik_com" type="text"><br><br>
								<label class="text-center">comment</label>
								<textarea align='center' name = "txt_com" rows ='3' maxlength="2000"></textarea>
								<input id="check" name="check" type="hidden" value="" />
								<div class="text-center"><button name="submit" type="submit" class="btn btn-info btn-block">add</button></div>
							</fieldset>
						</form><br>						
					</div>
					<div class="tab-pane fade" id="tab3">
						<p>
							Upload the MTPL Insurance plugin to your blog, Activate it.
						</p>
						<p>
							To use the MTPL Insurance calculator you should use the shortcode [sljar_mtplI_box].
						</p>
						<p>
							Place it in your templates where you want and done.
						</p>
					</div>
<!-- 					<div class="tab-pane fade" id="tab4">
						<div class="text-center" style="margin-top: 10px;">
							<a class="btn btn-info" href="download/mtplinsurance.zip" download>download MTPL Insurance plugin</a>
						</div>
					</div> -->
				</div>

			</div>
		</div>
	</div>
	<script src="/libs/jquery/jquery-1.11.3.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
<!-- <script src="/js/vue.min.js"></script>
<script src="/js/vue/insurance.js"></script>	 -->