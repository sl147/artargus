<div class='container-fluid'>
	<div class='row'>
		<? if ($groupData['foto']) :?> 
			<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 hidden-xs'>				
				<a class="media-right media-bottom fancybox" title="<?= $groupData['name']?>" rel="group" href="<?= $groupData['foto1']?>">
					<img alt="<?= $groupData['name']?>" class="fototov" src="<?= $groupData['foto1']?>" />
				</a>				
			</div>
		<? endif;?>
		<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 velocityProduct'>
			<? if (!$cart) :?>
				<div class='nameGroup text-center'><?= $groupData['name']?></div>
			<? else :?>
				<div class="text-center">
					<div class="alert alert-info" role="alert">
						товар додано до кошика
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			<!-- <span class='btn btn-primary text-center'>товар додано до кошика</span> -->

			<? endif;?>
		</div>
			<? if ($groupData['brand']) :?>
				<div class='col-lg-5 col-md-12 col-sm-3 col-xs-3 hidden-sm  hidden-xs'>
					<? if ($brandData['logo_m']) :?> 
						<div class='logo col-lg-6 col-md-3 col-sm-6 col-xs-6'>
							<a class='fancybox' rel='group' href='<?= $brandData['logo']?>'>
								<img src='<?= $brandData['logos']?>'/>
							</a><br><br>					
							<a target='blanc' href='http://<?= $brandData['site']?>'><?= $brandData['site']?></a>
						</div>
					<? endif;?>
					<? if ($brandData['descr']) :?> 
						<div class='col-lg-6 col-md-9 col-sm-6 col-xs-6'>
<!-- 							<a href='/maker/<?= $brandData['id']?>'>
								<div class='brandGroup text-center'><?= $groupData['name']?></div>
							</a> -->
							<p><?= $brandData['descrLess']?> ... 
								<a href='/maker/<?= $brandData['id']?>'>читати більше</a>
							</p>
						</div>
					<? endif;?>
				</div>
			<? endif;?>

	</div>
</div>