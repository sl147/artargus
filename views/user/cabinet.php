<?php include 'views/layouts/header.php';?>
<h2>Кабінет користувача <?= $user['name']." ".$user['surname']?></h2>
<ul>
	<li><a href="/cabinet/edit">Редагування даних</a></li>
	<li><a href="/cabinet/history">Мої замовлення</a></li>
</ul>
<?php include 'views/layouts/footer.php';?>