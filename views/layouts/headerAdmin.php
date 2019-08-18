<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- 	<meta http-equiv="refresh" content="8" />	 -->
	<meta name="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="../libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="../libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="../libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="../css/fonts.css" />
	<link rel="stylesheet" href="../css/main.css" />
	<link rel="stylesheet" href="../css/media.css" />
	<link rel="stylesheet" href="../css/dropzone.css" />
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="../css/dropzone.css" />
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script> -->

<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/vue.resource/1.0.2/vue-resource.min.js"></script> -->
	<link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/Redmond/jquery-ui.css">        

	<script src="../libs/jquery/jquery-1.11.3.min.js"></script>
	<script src="../libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script src="../libs/fancybox/jquery.fancybox.pack.js"></script>
	<script src="../libs/owl-carousel/owl.carousel.min.js"></script>
	<script src="../libs/countdown/jquery.plugin.js"></script>
	<script src="../libs/countdown/jquery.countdown.min.js"></script>  
	<script src="../js/common.js"></script>
	<script src="../js/modernizr-1.7.min.js"></script>
	<script src="../js/dropzone.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="/js/vue.min.js"></script>
	<script src="/js/vue-resource.min.js"></script>
	<script src="../js/vueAdmin.js"></script>
 <!--     <script src="/js/velocity.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script> -->


	<script>
	$(document).ready(function(){
		$("body").css("background-image", "none");
		$(".news").hover(function(){
			$(this).css("box-shadow", "none");
		});
	});	
	</script> 
</head>
<body>
	<div class='tit'>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-lg-2 ol-md-1 col-sm-2 col-xs-4"></div>
				<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
					<div class="btn-menu btn-group btn-group-justified" role="group" aria-label="...">
						<div class="btn-group" role="group">
							<a href="/" title="Головна"><button type="button" class="text-menu btn btn-danger">Головна</button></a>
						</div>
						<div class="btn-group" role="group">
							<a href="/admin" title="адмін"><button type="button" class="text-menu btn btn-danger">адмін</button></a>
						</div>
						<div class="btn-group btn-group-justified">
							<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">клієнти<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="/selClient/" title="вибір клієнтів">замовлення клієнтів</a></li>
								<li><a href="menegFriends" title="вибір клієнтів">привязка клієнтів</a></li>
								<li><a href="chDiscount" title="знижки клієнтів загальні">знижки загальні</a></li>
								<li><a href="chDiscountPlus" title="знижки клієнтів спеціальні">знижки спеціальні</a></li>
								<li><a href="/listClient/" title="список клієнтів">список клієнтів</a></li>
							</ul>			
						</div>

						<div class="btn-group btn-group-justified">
							<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">товар <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="/editGroup/" title="редагування груп товару">редагування груп товару</a></li>
								<li><a href="/editProducts/" title="редагування товару">редагування товару</a></li>
								<li><a href="/editMaker/" title="редагування виробників">редагування виробників</a></li>
								<li><a href="/upitems/" title="загрузка залишків">загрузка товарів,залишків</a></li>
								<li><a href="/upgroups/" title="загрузка груп товарів">загрузка груп товарів</a></li>
							</ul>			
						</div>

						<div class="btn-group btn-group-justified">
							<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">Калькулятор<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li>
									<a href="/typescalcukator" title="редагування видів калькуляторів">види калькуляторів</a>
								</li>
								<li>
									<a href="/insuranceType" title="редагування типів ТЗ">типи ТЗ</a>
								</li>
								<li>
									<a href="/insuranceReestr" title="редагування місця реєстрації">місце реєстрації</a>
								</li>
								<li>
									<a href="/insuranceCommentEdit" title="перегляд коментарів калькуляторів">коментарі калькулятора</a>
								</li>
								<li>
									<a href="/insurancePlugin" title="сторінка плагіна" target="_blank">плагін калькулятора</a>
								</li>
								<li>
									<a href="/insuranceComeToPlugin" title="переходи на плагін">переходи на плагін</a>
								</li>
							</ul>			
						</div>

						<div class="btn-group btn-group-justified">
							<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">роботи<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li>
									<a href="/faCreate/" title="додати фотоальбом">створення фотоальбомів</a>
								</li>
								<li>
									<a href="/faChangeEd" title="редагування фотоальбомів">редагування фотоальбомів</a></li>
								<li>
									<a href="/request/" title="запити до майстрів">запити до майстрів</a>
								</li>
								<li>
									<a href="/jobListCommentEdit" title="перегляд коментарів робіт">коментарі до робіт</a>
								</li>								
							</ul>			
						</div>

						<div class="btn-group btn-group-justified">
							<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">службові<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="/delivery" title="редагування перевізників">перевізники</a></li>
								<li><a href="/roles" title="редагування видів користувачів">види користувачів</a></li>
								<li><a href="/jobs" title="редагування статусів виконання">статуси</a></li>
								<li><a href="/errLook" title="Вивід id помилок">вивід id помилок</a></li>
								<li><a href="/errTab" title="Перегляд помилок">перегляд помилок</a></li>
								<li><a href="/pays" title="редагування видів оплат">види оплат</a></li>
								<li><a href="/metaTags" title="редагування мета тегів">мета теги</a></li>
								<li><a href="/spam" title="редагування спаму">спам</a></li>
								<li><a href="dataChangePars" title="редагування parsing">редагування parsing</a></li>

								<li><a href="parsFindHTMLRosa" title="parcing"><button type="button" class="text-menu btn btn-danger">parsРоса</button></a></li>
								
								<li><a href="/parsHTML" title="parcing"><button type="button" class="text-menu">parsHTML</button></a></li>
								<li><a href="/parsHTML52" title="parcing"><button type="button" class="text-menu">parsHTML52</button></a></li>
								<li><a href="/parsHTML53" title="parcing"><button type="button" class="text-menu">parsHTML53</button></a></li>
								<li><a href="/parsForm" title="parcing"><button type="button" class="text-menu">parsForm</button></a></li>
								<li><a href="/processlist" title="processlist"><button type="button" class="text-menu">PROCESSLIST</button></a></li>

							</ul>			
						</div>

						<div class="btn-group btn-group-justified">
							<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">замовлення<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="/orders" title="замовлення">замовлення</a></li>
								<li><a href="/ordersfind" title="замовлення">замовлення main</a></li>
							</ul>			
						</div>
					</div>                    
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
			<div class='col-lg-10 col-md-11 col-sm-12 col-xs-12'>
				<div class='news'>