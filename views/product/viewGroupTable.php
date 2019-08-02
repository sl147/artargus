<?php include_once 'views/layouts/header.php';?>
<?php include_once 'views/product/groupHeader.php';?>
<ul class="nav nav-tabs">
	<li>
		<a href="/group/<?=$groupData['kod_t']?>">
			<span title="картинки" class="btn btn-hamburger glyphicon glyphicon-th-large" aria-hidden="true">картинками</span>
		</a>
	</li>

	<li id="myTab" class="active">
		<a href="#tab2" data-toggle="tab">
			<span title="списком" class="btn btn-hamburger glyphicon glyphicon-th-list" aria-hidden="true">списком</span>
		</a>
	</li>
</ul>
<div class="tab-content">

	<div class="tab-pane fade in active container-fluid" id="tab2">
		<div class="row">
			<div class=" col-lg-12 col-md-12 col-sm-11 col-xs-11">	
				<table class="table table-bordered table-striped table-hover tabOrder">
					<thead>
						<tr class="info">
							<th class="text-center">фото</th>
							<th class="text-center">найменування</th>
							<th class="text-center">ціна грн</th>
							<th class="text-center">к-ть</th>
						</tr>
					</thead> 
					<tbody>
						<?php foreach ($productsList as $item) :?>
						<tr>
							<td>
								<?php if ($item['kodCol']) :?>								
									<div class="color_box" style="background:<?= $item['kodCol']?>;"></div>
								<?php else :?>
									<a class="fancybox" title="<?= $item['name']?>" href="<?= $item['fotoPath']?>">
										<img class='fototovTab' alt='<?= $item["name"]?>' data-original="<?= $item["fotoPath"]?>">
									</a>								
								<?php endif; ?>
							</td>
							<td class="widthName">
								<a class="heightName" href="/product/<?= $item['id']?>"><?= $item['id'].' '.$item['name']?></a>
							</td>
							<td class="heightName text-right"><?= number_format($item['price'], 2, '.', '')?></td>
							<td>
								<?php if ($item['countTov']) :?>
									<form  method = "POST">
										<input type="hidden" name="idb" value="<?= $item['id']?>">
										<input type="hidden" name="iscount" value="true">
										<input class="inputCount" name="count" min=1 type="number" value=1>
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
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>		
<div class="text-center textwidth"><? echo $pagination->get(); ?></div>
<?include 'views/layouts/footer.php';?>
<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fototovTab").lazyload({
      effect: "fadeIn"
    });
  });
</script>