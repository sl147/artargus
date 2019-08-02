<?php
include_once 'phpQuery-onefile.php';
if (isset($_GET['stock'])) {
	$stock = $_GET['stock'];
	echo "<h3>stock:".$_GET['stock']."</h3>";
?>

<table class="table table-responsive table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="text-center">date</th>
			<th class="text-center">open</th>
			<th class="text-center">hi</th>
			<th class="text-center">low</th>
			<th class="text-center">close</th>
			<th class="text-center">adclose</th>
			<th class="text-center">volume</th>
		</tr>
	</thead>
	<?
	$cycl = 1;
	$submail = '';
	$url = "https://finance.yahoo.com/quote/".$stock."/history?p=TQQQ&.tsrc=fin-srch";
	//echo date('Y-m-d H:i:s'); <?php include_once "vendor/autoload.php";
	$file = file_get_contents($url);
	$doc = phpQuery::newDocument($file);
//	$classId = "#atomic";
	$i = 0;
	//foreach ($doc->find("span") as $val) {
	foreach ($doc->find("#quote-header-info") as $val) {
		$val = pq($val);
		$text = $val->html();
		$i++;
		//echo "i=$i:  $text<br>";
		$tx = pq($text);
		$cur1    = $tx->find("span:eq(2)")->text();
		$cur2    = $tx->find("span:eq(3)")->text();
		//$curTax = (!intval($cur1)) ? $cur1 : $cur2;
		$curTax = intval($cur1) ? $cur1 : $cur2;
	}
echo "<br>curTax = $curTax<br>";

$classId = ".BdT";
$el      = $doc->find($classId);
$date    = $el->find("td:eq(0)")->text();
$open    = $el->find("td:eq(1)")->text();
$hi      = $el->find("td:eq(2)")->text();
$low     = $el->find("td:eq(3)")->text();
$close   = $el->find("td:eq(4)")->text();
$adClose = $el->find("td:eq(5)")->text();
$Volume  = $el->find("td:eq(6)")->text();
$HAC     = (floatval ($open) + floatval ($hi) + floatval ($low) + $curTax) / 4;
echo "HAC = (".floatval ($open)." + ".floatval ($hi)." + ".floatval ($low)." + ".$curTax.") / 4<br>";
?>
<tbody>
	<tr>
		<td><?= $date ?></td>
		<td><?= $open ?></td>
		<td><?= $hi ?></td>
		<td><?= $low ?></td>
		<td><?= $close ?></td>
		<td><?= $adClose ?></td>
		<td><?= $Volume ?></td>
	</tr>
<?
$el      = $doc->find($classId)->next();
$date    = $el->find("td:eq(0)")->text();
$open    = $el->find("td:eq(1)")->text();
$hi      = $el->find("td:eq(2)")->text();
$low     = $el->find("td:eq(3)")->text();
$close   = $el->find("td:eq(4)")->text();
$adClose = $el->find("td:eq(5)")->text();
$Volume  = $el->find("td:eq(6)")->text();
		
$HAO = 	(floatval ($open) + floatval ($close)) / 2;

echo 'HAO = ('.floatval ($open).' + '.floatval ($close).') / 2<br>';

echo "HAC = $HAC<br>   HAO = $HAO<br>";
?>
	<tr>
		<td><?= $date?></td>
		<td><?= $open?></td>
		<td><?= $hi?></td>
		<td><?= $low?></td>
		<td><?= $close?></td>
		<td><?= $adClose?></td>
		<td><?= $Volume?></td>
	</tr>
</tbody>
</table>
<?		
if ($HAC>$HAO) {
$subject = "GREEN";
	echo "<h2 style='color: green;'>green</h2>";
}
else {
$subject = "RED";
	echo "<h2 style='color: red;'>red</h2>";
}
echo "  здесь отправляеться e-mail.";
$massage = $subject."\n
 HAC = ".$HAC."\n
 HAO = ".$HAO;
$to = "sl147@ukr.net";
$from = "admin@artargus.in.ua";
$headers = "From: $from\r\nReplay-To: $from\r\nContent-Type: text/plain; charset=utf-8\r\n ";
mail($to,$subject,$massage,$headers);
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("admin@artargus.in.ua", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("sl147@ukr.net", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
	echo "OK";
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
//}
}
?>
