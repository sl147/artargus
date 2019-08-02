?>
<form id = "formCom" method="POST">
	<fieldset>
		<legend class="text-center">Додати коментар</legend>
		<label class="text-center">Ім'я</label>
		<input name="nik_com" type="text"><br><br>
		<label class="text-center">Коментар</label>
		<textarea align='center' name = "txt_com" rows ='3' maxlength="2000"></textarea>
		<input id="check" name="check" type="hidden" value="" />
		<div class="text-center"><button name="submit" type="submit" class="btn btn-info btn-block">додати</button></div>
	</fieldset>
</form><br>

<? if (empty($comment)) :?>
	<div class="text-center">
    <h4>Коментарів немає</h4>
    </div>
<? else :?>

<h5 class="text-center">Коментарів <?= count($comment)?></h5>
    <?php foreach ($comment as $item) :?>
    	
        <p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
        <p class="news_Comment"><?=$item['text'] ?></p>
        <br>
    <?php endforeach; ?>	
<? endif; ?>
<?