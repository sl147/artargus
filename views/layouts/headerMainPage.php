<!DOCTYPE html>
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

	<link rel="stylesheet" @media all href="/libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" @media all href="/css/mainPage.css" />
	<link rel="stylesheet" @media all href="/css/mediaMain.css" />
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
    	$nm = "меню";
	?>

	<div class='tit text-center'>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-lg-2 col-md-3 col-sm-0 col-xs-0">
					<div class='hamburgerAdmin'>
						<div class='text-left'>
							<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg" data-container="body" role="button" data-toggle="popover" 
							 data-placement="bottom" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
							<span title="меню" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
							</a>
						</div>
					</div>	
				</div>
				<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">					
					<div class="menuMain">	
						<div class="btn-group btn-group-justified" role="group">
						<div class="btn-group">
							<a href="/" title="Головна" class="text-menu btn btn-info">головна</a>
						</div>  
<!-- 						<div class="btn-group">
							<a href="/proba" title="Перейти до кошика" class="text-menu btn btn-info">proba</a>
						</div> -->
						<div class="btn-group menuCount">
							<!-- <div class="menuCount"> -->
							<a href="/basket" title="Перейти до кошика" class="text-menu btn btn-info">кошик
							<template v-if="count">
								<span class="badge badgeCl">{{count}}</span>	
							</template>					
<!-- 								<?if (Basket::getCount()) :?>
									<span class="badge badgeCl"><?= Basket::getCount()?></span>
								<?endif;?> -->
							</a>
							<!-- </div> -->
						</div>
						<div class="btn-group">
							<a href="/contakt" title="контакти" class="text-menu btn btn-info">контакт</a>
						</div>
						<div class="btn-group">
							<a href="/jobList" title="Роботи наших клієнтів" class="text-menu btn btn-info">галерея</a>
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
				<div class="col-lg-2 col-md-3 col-sm-0 col-xs-0"></div>
				<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">	
						<input class='findInput' name='name_f' type='text' v-model='searchString' placeholder='введіть що Ви хочете знайти' />
						<ul>
							<li v-for='i in articles'>
								<span >{{ i.name | myFilter }}</span>
							</li>
						</ul>
<!-- 						<ul v-cloak v-show='showList' class = 'findbox'>
							<li v-for='i in articles' v-on:click='clickMethod(i.name)' v-on:mouseover='hovMethod(i.name)'>
								<span >{{ i.name }}</span>      
							</li>
						</ul> -->
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
<!-- 						<div class='timeWorImage'>
							<br><img src='/image/time2.png' alt='все для художників' width='30' height= '30' title='товари для художників'>
						</div> -->
						<div class='timeWorkTXT'>
							067 7472881 - Анна<br>
						</div>
						<div class='timeWorkTXT'>
							м.Дрогобич Львівська обл,<br> пл.Ринок,17 (магазин "Верховина")<br>
						</div>
					</div><br><br><br><br><br>
					<?php if (Basket::getCount()) :?>						
						<a href="/basket" title="Перейти до кошика" class="text-menu btn btn-primary">товарів в кошику
							<span id="sid" class="badge badgeCl"></span>
						</a>	
					<?php endif; ?>	
					<br><br>
					<div class="velocityAuto">
					<a href='/insurance' target='_blank' title='розрахунок вартості страхування автоцивілки'>
					  <span style="color:red;">калькулятор </span>
					  <span style="color:#FFFFFF;">автоцивілки</span>
					</a>
					</div><br><br>
				</div>
</div>
		<div class='col-lg-8 col-md-8 col-sm-10 col-xs-12'>
			<div class='newsh'>	