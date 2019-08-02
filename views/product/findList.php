<?php include 'views/layouts/header.php';?>
<?php if (is_array($findList)) :?>	
<div class="container-fluid">
	<div class="row">
	
<?php foreach ($findList as $item) :?>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<?php if ($item["fotoF"]) :?>
		<h3>foto</h3>
			<a style="padding-left:15px;" class="media-left media-top fancybox" title="<?=$item["name"]?>" rel="group" href="<?=$item["foto"]?>"><img alt="<?=$item["name"]?>" src="<?=$item["fotoS"]?>" />
			</a>	
		<?php else :?>
			<div class="color_box" style="background:<?= $item["kodCol"] ?>;"></div>
		<?php endif; ?>
	</div>
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
<div class="itemtxt">
	<a href="/product/<?= $item['id']?>"><?= $item['id'].' '.$item['name']?></a>
</div>
<div class="newstit" align="left" title="<?= $item['name']?>">ціна: <?= $item['price']?> грн</div>	
<table>
	<tr class="text-right anpp">
		<td>
			<form  method = "POST">
				<input type="hidden" name="idb" value="<?= $item['id']?>">
				<input style="width:40px;" name="count" min=1 type="number" value=1>
				<button name="submit" type="submit" class="btn btn-info btn-sm">в кошик</button>
			</form>
		</td>
	</tr>
</table>
</div>

<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
<?php include 'views/layouts/footer.php';?>