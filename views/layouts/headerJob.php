<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if (isset($meta)) :?>
		<title><?= $meta['title']?></title>
		<meta name="keywords" content="<?= $meta['keywords']?>">
		<meta name="description" content="<?= $meta['descr']?>">
	<?php else:?>
		<title>Все для художників</title>
	<?php endif; ?>

	<link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="/libs/bootstrap/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="/libs/bootstrap/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="/libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="/css/fonts.css" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/css/media.css" />

<meta property="og:image" content='<?= $fotoT?>' />
<meta property="og:title" content="<?= $title?>" />
<meta property="og:description" content="<?= $prew?>" />
</head>
<body>
	<?
    $content="<div class='text-center'>";

foreach (Product::getCategoryList() as $item) {
$content .="<a class='hamburgerMenu text-menu btn btn-info' href='/category/".$item["kod_t"]."'>".$item["name"].'</a>';				
						}
$content .="
<a href='/' title='Головна' class='hamburgerMenu text-menu btn btn-info'>Головна</a>
<a href='/basket' title='Перейти до кошика' class='hamburgerMenu text-menu btn btn-info'>Кошик</a>
<a href='/contakt' title='контакти' class='hamburgerMenu text-menu btn btn-info'>контакти</a>
<a href='/jobList' title='Роботи наших клієнтів' class='hamburgerMenu text-menu btn btn-info'>Галерея</a>
	</div>    
    ";


					
//echo 'cont='.$content;
    $nm = "меню";
	?>

	<div class='tit text-center'>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-lg-2 col-md-1 col-sm-0 col-xs-0">
				<div class='hamburgerAdmin'>
						<div class='text-left'>
							<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg" data-container="body" role="button" data-toggle="popover" 
							 data-placement="bottom" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
							<span title="меню" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
							</a>
						</div>
					</div>	
				</div>
				<div class="text-center col-lg-8 col-md-11 col-sm-12 col-xs-12">
					
					<div class="menuMain">	
					<div class="btn-group btn-group-justified" role="group">
						<div class="btn-group">
							<a href="/" title="Головна" class="text-menu btn btn-info">Головна</a>
						</div>  
<!-- 						<div class="btn-group">
							<a href="/files/myfiles.exe" title="Перейти до кошика" class="text-menu btn btn-info">proba</a>
						</div> -->
						<div class="btn-group">
							<a href="/basket" title="Перейти до кошика" class="text-menu btn btn-info">Кошик
								<?if (Basket::getCount()) :?>
									<span class="badge badgeCl"><?= Basket::getCount()?></span>
								<?endif;?>
							</a>
						</div>
						<div class="btn-group">
							<a href="/contakt" title="контакти" class="text-menu btn btn-info">контакти</a>
						</div>
						<div class="btn-group">
							<a href="/jobList" title="Роботи наших клієнтів" class="text-menu btn btn-info">Галерея</a>
						</div>					
						<?if (!User::isGuest()) :?>
							<div class="btn-group">
								<a href="/user/register" title="вхід" class="text-menu btn btn-warning">вхід</a>
							</div>
						<?else :?>
							<div class="btn-group btn-group-justified">
								<button type="button" data-toggle="dropdown" class="text-menu btn btn-primary dropdown-toggle">кабінет<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="/cabinet/edit" title="Редагування даних">Редагування даних</a></li>
									<li><a href="/cabinet/history" title="Мої замовлення">Мої замовлення</a></li>
								</ul>			
							</div>
							<div class="btn-group">
								<a href="/user/logout" title="вихід" class="text-menu btn btn-info">вихід</a>
							</div>
							<?if (User::isAdmin(User::userId())) :?>
								<div class="btn-group" role="group">
									<a href="/admin" title="адмін"><button type="button" class="text-menu btn btn-danger">адмін</button></a>
								</div>
							<?endif;?>
						<?endif;?>
</div>
					</div>
				</div>
			</div>		
		</div>
	</div>

	<div class='tit text-center' id='find'>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
				<div class="text-center findDiv col-lg-8 col-md-11 col-sm-12 col-xs-12">	
						<input class='findInput' name='name_f' type='text' v-model='searchString' placeholder='введіть що Ви хочете знайти' v-on:focus='focusMethod' />
						<a v-bind:href="/find/+searchString" title='шукати' class='btn btn-info'>
							<span class='glyphicon glyphicon-search' aria-hidden='true'></span>
						</a>
						<ul v-cloak v-show='showList' class = 'findbox'>
							<li v-for='i in articles' v-on:click='clickMethod(i.name)' v-on:mouseover='hovMethod(i.name)'>
								<span >{{ i.name }}</span>      
							</li>
						</ul>
				</div>
			</div>		
		</div>
	</div><br>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
					<div class='leftSide'>
					<aside>
						<?php foreach (Product::getCategoryList() as $item) :?>	
							<div class="groupLeft"> 
								<!-- <div class="">-->
								<a class="btn btn-info btn-sm btn-block" href='/category/<?= $item["kod_t"]?>'><?= $item["name"]?>
								</a><br>							
							</div>					
						<?php endforeach; ?>
					</aside><br><br>

					<div class='timeWork'>
						<div class='timeWorkTXT'>
							Робочі дні<br>з  10 до 17<br>
							субота<br>з 10 до 14<br>
							Вихідний -  неділя
						</div>

						<div class='timeWorkTXT'>
							097 5007085 - Ярослав<br>
						</div>

					</div><br><br><br><br><br>
					<?php if (Basket::getCount()) :?>
						<!-- <div class='velocityProduct'> -->
						<button type="button" id="corzv" class="btn btn-block btn-primary" data-toggle="collapse" data-target="#арх1" aria-expanded="true" aria-controls="арх1">товарів в кошику
							<span class="badgeCl badge"><?= Basket::getCount()?></span>
						</button>
						<!-- </div> -->
					<?php endif; ?>
				</div>
</div>
		<div class='col-lg-8 col-md-8 col-sm-10 col-xs-12'>
			<div class='newsh'>	