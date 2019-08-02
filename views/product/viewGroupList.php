<?php include_once 'views/layouts/header.php';?>
<?php include_once 'views/product/groupHeader.php';?>
<ul class="nav nav-tabs btn btn-mini">
	<li id="myTab" class="active">
		<a href="#tab1" data-toggle="tab">
			<span title="картинки" class="btn btn-hamburger glyphicon glyphicon-th-large" aria-hidden="true">картинками</span>
		</a>
	</li>
	<li>
		<a href="/groupTable/<?=$groupData['kod_t']?>">
			<span title="списком" class="btn btn-hamburger glyphicon glyphicon-th-list" aria-hidden="true">списком</span>
		</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in active container-fluid" id="tab1">
		<div class="row">		
			<?php foreach ($productsList as $item) :?>
				<div class="itemBox col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<?php if ($item['kodCol']) :?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
									<div class="color_box" style="background:<?= $item['kodCol']?>;"></div>
								</div>
								<div class="flexCont col-lg-7 col-md-7 col-sm-5 col-xs-7">
									<div class="flexTXT">
										<a href="/product/<?= $item['id']?>"><?= $item['kod_t'].' '.$item['name']?></a>
									</div>
									<div class="flexPrice" align="left" title="<?= $item['name']?>">ціна: <?= $item['price']?> грн</div>	
									<table class="flexPrice">
										<tr class="text-right anpp">
											<td>
												<?php if ($item['countTov']) :?>
													<form  method = "POST">
														<input type="hidden" name="idb" value="<?= $item['id']?>">
														<input type="hidden" name="iscount" value="true">
														<input style="width:40px;" name="count" type="number" placeholder='1' value=1>
														<button name="submit" type="submit" class="btn btn-info btn-sm">в кошик</button>
													</form>
												<?php else :?>
													<form  method = "POST">
														<input type="hidden" name="idb" value="<?= $item['id']?>">
														<input type="hidden" name="iscount" value="false">
														<input style="width:40px;" name="count" min=1 type="number">
														<button name="submit" type="submit" disabled='disabled' class="btn btn-warning btn-sm">відсутній</button>
													</form>									
												<?php endif; ?>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>				
					<?php else :?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
									<a class="fancybox" title="<?= $item['name']?>" href="<?= $item['fotoPath']?>">
										<img class='fototov' alt='<?= $item["name"]?>' data-original="<?= $item["fotoPath"]?>">
									</a>
								</div>
								<div class="flexCont col-lg-7 col-md-7 col-sm-5 col-xs-5">
									<div class="flexTXT">
										<a href="/product/<?= $item['id']?>"><?= $item['kod_t'].' '.$item['name']?></a>
									</div>
									<div class="flexPrice text-left"  title="<?= $item['name']?>">
										ціна: <?= $item['price']?> грн
									</div>

									<table class="flexPrice tabPrice">
										<tr class="text-right">
											<td>
												<?php if ($item['countTov']) :?>
													<form  method = "POST">
														<input type="hidden" name="idb" value="<?= $item['id']?>">
														<input type="hidden" name="iscount" value="true">
														<input style="width:40px;" name="count" min=1 type="number" value=1>
														<button name="submit" type="submit" class="btn btn-info btn-sm">в кошик</button>
													</form>
												<?php else :?>
													<form  method = "POST">
														<input type="hidden" name="idb" value="<?= $item['id']?>">
														<input type="hidden" name="iscount" value="false">
														<input style="width:40px;" name="count" type="number" disabled='disabled' placeholder='0'>
														<button name="submit" type="submit" disabled='disabled' class="btn btn-warning btn-sm">відсутній</button>
													</form>									
												<?php endif; ?>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>	

					<?php endif; ?>
				</div>
			<?php endforeach; ?>

		</div>
		<div class="text-center textwidth"><? echo $pagination->get(); ?></div>
	</div><br>

</div>		

<?include 'views/layouts/footer.php';?>
<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fototov").lazyload({
      effect: "fadeIn"
    });
  });
</script>