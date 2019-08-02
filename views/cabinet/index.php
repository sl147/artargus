<?php include 'views/layouts/header.php';?>
<h1>User's Cabinet <?= $user['name']." ".$user['surname']?></h1>
<ul>
	<li><a href="/cabinet/edit">Edition data</a></li>
	<li><a href="/cabinet/history">My history</a></li>
</ul>
<?php include 'views/layouts/footer.php';?>