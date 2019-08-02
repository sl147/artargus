<?php include 'views/layouts/header.php';?>
<div class="container-fluid">
	<div class="row">

		<?php foreach ($productsList as $item) :?>
			<div class='text-center col-md-6 col-sm-6 col-xs-12 col-lg-6'>
				<div class="contGroup">
					<? $foto1    = '../FT/'.$item['foto'];
					if ($foto1) {
						echo "<div class='imgGroup'>
						<a href='/group/".$item["kod_t"]."'>
						<img class='saturate' alt='".$item["name"]."' src='".$foto1."'>
						</a></div><br>";
					}
					?>
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

<?php include 'views/layouts/footer.php';?>