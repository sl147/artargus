<?php include 'views/layouts/header.php';?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<?php if ($productOne['brand']) :?>
				<a class="media-left media-top fancybox" rel="group" href="<?= $productOne['fotLGr']?>">
					<img class="fototov" alt="<?= $productOne['brandName'] ?>" src="<?= $productOne['fotLGr']?>" />
				</a>

				<div class="media-body velocityProduct">
					<h1 style="color:<?=$productOne['kodCol']?>"><?= $productOne['name']?></h1><br>
				</div>
			<?php else :?>
				<div class='velocityProduct text-center'>
					<h1 style="color:<?=$productOne['kodCol']?>">
						<?= $productOne['name']?>
					</h1><br>
				</div>
			<?php endif; ?>
			<div class='hartxt'>
				<?php if ($productOne['descr']) :?>			
					<p class='text-indent'><?= $productOne['descr']?></p>
				<?php else :?>		
					<p class='text-indent'><?= $productOne['descrParent']?></p>
				<?php endif; ?>		
			</div>

<?php if ($productOne['fotoS'] && !$productOne['kodCol']) :?>	

	<a class="media-left media-top fancybox" rel="group" href="<?= $foto?>">
		<img class="fototov" alt="<?= $productOne['name']?>" src="<?= $foto?>" />
	</a>

	<div class="media-body">
		<p style="padding-left:5px;font-size:16px;"><?= $productOne['article'];?> <? $productOne['name']?></p>
		<div class="newstit" align="left" title="продаж">ціна: <?= $productOne['price']?> грн</div>
		<table id="vote">
			<tr class="text-right anpp">
				<td>
					<?php if ($productOne['countTov']) :?>
						<form  method = 'POST'>
							<input type='hidden' name='idb' value='<?= $productOne['id']?>'>
							<input style='width:40px;' name='count' min='0' type='number' value=1>
							<button name='submit' type='submit' class='btn btn-info btn-sm'>в кошик</button>
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
<?php else :?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<div class="color_box" style="background:'<?= $productOne['kodCol']?>;"></div>
			</div>
			<div class="col-md-8">
				<div style="padding-left:5px;font-size:16px;">
					<p><?= $productOne['article'];?> <?= $productOne['name']?></p>
					<div class="newstit" align="left" title="продаж">ціна: <?= $productOne['price']?> грн</div>	
					<table id="vote">
						<tr class="text-right anpp">
							<td>
								<?php if ($productOne['countTov']) :?>
									<!--<a href='/basket/add/<?=$productOne['id']?>' class='btn btn-info btn-sm'>в кошик</a>-->
	 								<form method = 'POST'>
										<input type='hidden' name='idb' value='<?= $productOne['id']?>'>
										<input style='width:40px;' name='count' min='0' type='number' value=1>
										<button name='submit' type='submit' class='btn btn-info btn-sm'>в кошик</button>
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
	</div>	
<?php endif; ?>
</div>
</div>
</div><br>

<div class = "text-center backToItem">
	<a class="btn btn-warning btn-sm" href="<?= $_SERVER['HTTP_REFERER']?>"> повернутись до товарів</a>
</div>

<?php include 'views/layouts/footer.php';?>