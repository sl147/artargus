<?php include_once 'views/layouts/headerMainPage.php';?>
<div class="container-fluid">
	<div class="row">		
		<?php foreach ($latestproducts as $item) :?>
			<div class='text-center col-lg-6 col-md-6 col-sm-6 col-xs-12'>
				<div class="contGroup">	
					<?php if ($item["foto1"]) :?>
						<div class='imgGroup'>
							<a href='/group/<?= $item["kod_t"]?>'>
								<img class='saturate' alt='<?= $item["name"]?>' data-original="<?= $item["foto1"]?>">
							</a>
						</div><br>
					<?php endif; ?>
					<div class='text-center textwidth'>
						<a href='/group/<?=$item["kod_t"]?>'>
							<b><?= $item["name"]?></b>
						</a>									
					</div>
				</div>
			</div>
		<?php endforeach; ?>	
	</div>
</div>
<?php include 'views/layouts/footerMainPage.php';?>