<?php include 'views/layouts/header.php';?>
<? if (isset($errors) && is_array($errors)) :?>
	<div class="showAlert">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				&times;
			</button>
			<ul>
			<?foreach ($errors as $error) :?>
						<li >
							<?=$error?>
						</li>		
			<?endforeach;?>
			</ul>
			
		</div>
	</div>
<?endif;?>
	<form id = "authlog" method="POST">
				<div class="input-group margin-bottom-sm">
					<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
					<input class="btnwidth form-control" name="login" autofocus type="text" placeholder="Логін" value="<?= $login?>">
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
					<input class="btnwidth form-control" name="password" type="password" placeholder="Пароль" value="<?= $password?>">
				</div><br>			
				<button name="submit" type="submit" class="btnwidth btn btn-success btn-sm">увійти </button>			
				<a href='author' class="btnwidth btn btn-success btn-sm">реєстрація</a>
	</form>	

<?php include 'views/layouts/footer.php';?>