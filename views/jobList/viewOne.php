<?php include 'views/layouts/headerJob.php';?>

<script type="text/javascript">
window.___gcfg = {lang: 'uk'};

(function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/platform.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class='nameGroup text-center'><?echo $author['name_FA']?></div>
<div class='nameGroup text-center'>Автор: <?echo $author['log_FA']?></div>
<div class="container-fluid">
	<div class="row">

		<?php foreach ($jobListOne as $item) :?>
		<div class='text-center col-lg-6 col-md-6 col-sm-12 col-xs-12'>
			<a class="fancybox" rel="group" href="<?= $item['fn']?>"> 
				<img title="<?= $item['subscribe']?>" class="fotolist" data-original="<?= $item['fn']?>" />
			</a>
			<div class='text-center textwidth'><b><?= $item['subscribe']?></b></div>					
		</div>
	<?php endforeach; ?>

</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"> 
			<span><a href="https://twitter.com/share" class=" btn btn-info btn-xs twitter-share-button" data-via="sljar147">Tweet</a>
				<script type="text/javascript">tweet()</script></span>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<span>
					<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				</span>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 col-lg-12">
				<div class="g-plusone" data-annotation="inline" data-width="300"></div>
			</div>
		</div>
	</div>


<? if (empty($comment)) :?>
    <h4 class="text-center">Коментарів немає</h4>
<? else :?>
	<h5 class="text-center">Коментарів <?= count($comment)?></h5>
    <?php foreach ($comment as $item) :?>
    	<div class="text-center">
        <p class='ip_Comment'><?=$item['nik_com'] ?> :</p>
        <p class="text-center news_Comment"><?=$item['txt_com'] ?></p>
        </div><br><br>
    <?php endforeach; ?>	
<? endif; ?>
						
<form role="form" id = "authJob" method="POST">
	<fieldset>
		<legend class="text-center">Додати коментар</legend>
		<label class="text-center">Ім'я</label> <input id="nik_com" name="nik_com" type="text"><br><br>
		Коментар<Br><textarea align='center' id="comm" name = "txt_com" rows ='7' cols = '63' maxlength="2000"></textarea>
		<input id="check" name="check" type="hidden" value="" />
		<div class="text-center"><button name="submit" type="submit" class="btn btn-default">додати</button></div>
	</fieldset>
</form><br><br><br>						
<div class="text-center" style="padding-bottom: 20px;">
	<a class="btn btn-warning btn-sm" href="/jobList/"> повернутись до списку</a>
</div>

<?php include 'views/layouts/footer.php';?>

<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fotolist").lazyload({
      effect: "fadeIn"
    });
  });
</script>