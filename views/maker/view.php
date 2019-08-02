<?php include 'views/layouts/header.php';?>
<?php if ($brandData['foto']) :?>
	<div class='logomaker'>
		<a class="fancybox" rel="group" href="<?= $brandData['logo']?>">
			<img src="<?= $brandData['logo']?>" />
		</a><br><br>					
		<a target="blanc" href="http://<?= $brandData['site']?>"><?= $brandData['site']?></a>
	</div>
	<h1 class='text-center'><?= $brandData['name']?></h1>
	<div class='makertxt'><?= $brandData['descr']?></div>
<?php else :?>
	<div class='container-fluid'>
		<div class='row'>
			<div class='logo col-lg-4 col-md-6 col-sm-12 col-xs-12'>
                            <a target='blanc' href='http://<?= $brandData['site']?>'><?= $brandData['site']?></a>
			</div>
			<div class='col-lg-8 col-md-6 col-sm-12 col-xs-12'>
                            <h1 class='text-center'><?= $brandData['name']?></h1>
                            <p style='font-size:14px;'><?= $brandData['descr']?></p>
			</div>
		</div>
	</div>		
<? endif;?>
<div class = "text-center">
	<a class="btn btn-warning btn-sm" href="<?= $_SERVER['HTTP_REFERER']?>"> повернутись до товарів</a>
</div>
<?php include 'views/layouts/footer.php';?>