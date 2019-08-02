<?php include 'views/admin/phpQuery-onefile.php';?>
<?php include 'views/layouts/headerAdmin.php';?>
<?php include_once "vendor/autoload.php";?>
<h3 align="center">Порівняння цін сайтів </h3>
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
//While ($cycl) {
	$dateTime = date('Y-m-d H:i:s');	
	echo $dateTime;
	$url = "https://finance.yahoo.com/quote/TQQQ/history?p=TQQQ&.tsrc=fin-srch";
	$file = file_get_contents($url);
	$doc = phpQuery::newDocument($file);
	$classId = "#atomic";
	$i = 0;
		//foreach ($doc->find("span:has('.Fz(36px)')") as $val) {
	foreach ($doc->find("#quote-header-info") as $val) {
		$val = pq($val);
		$text = $val->html();
		$i++;
		$tx = pq($text);
		$cur1    = $tx->find("span:eq(2)")->text();
		$cur2    = $tx->find("span:eq(3)")->text();
		$curTax = intval($cur1>0) ? $cur1 : $cur2;
	}
echo "<br>curTax = $curTax<br>";

$classId = ".BdT";
$el = $doc->find($classId);
$date = $el->find("td:eq(0)")->text();
$open = $el->find("td:eq(1)")->text();
$hi = $el->find("td:eq(2)")->text();
$low = $el->find("td:eq(3)")->text();
$close = $el->find("td:eq(4)")->text();
$adClose = $el->find("td:eq(5)")->text();
$Volume = $el->find("td:eq(6)")->text();
$HAC  = (floatval ($open) + floatval ($hi) + floatval ($low) + $curTax) / 4;
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
	$next = $el = $doc->find($classId)->next();
	$date = $el->find("td:eq(0)")->text();
	$open = $el->find("td:eq(1)")->text();
	$hi = $el->find("td:eq(2)")->text();
	$low = $el->find("td:eq(3)")->text();
	$close = $el->find("td:eq(4)")->text();
	$adClose = $el->find("td:eq(5)")->text();
	$Volume = $el->find("td:eq(6)")->text();
	echo '2.date:'.$date.'  open:'.$open.'  hi:'.$hi.' low:'.$low.' close:'.$close.' adClose'.$adClose.' volume:'.$Volume.'<br> ';		
	//$HAO = 	(floatval ($open) + floatval ($close)) / 2;
$HAO = 	(floatval ($open) + floatval ($low)) / 2;
	echo "HAC = $HAC   HAO = $HAO<br>";
		//$classId = ".Trsdu(0.3s) Fw(b) Fz(36px) Mb(-4px) D(ib)";
		//$classId = ".D(ib) Mend(20px)";
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

<?		
if ($HAC>$HAO) {
$subject = "green";
	echo "<h2 style='green'>green</h2>";
}
else {
$subject = "red";
	echo "<h2 style='red'>red</h2>";
}
$massage = $subject."\n
 HAC = ".$HAC."\n
 HAO = ".$HAO."\n
 Создал скрипт HeikinAshiColor.php?stock=tqqq согласно тестовому заданию\n
 Если ещё актуально, пишите sljar147@gmail.com";

//$to = "yurius86@gmail.com";
//$res = Auxiliary::sendMail($subject,$to,$massage);
$to = "sl147@ukr.net";

$sendCl  = new SendMail(); 
$res    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);
//$email = new \SendGrid\Mail\Mail(); 
/*$email = new \SendGrid\Email();
 // The list of addresses this message will be sent to
 // [This list is used for sending multiple emails using just ONE request to SendGrid]
 $toList = array('sl147@ukr.net', 'sl147@i.ua');

 // Specify the names of the recipients
 $nameList = array('UKRNET', 'IUA');

 // Used as an example of variable substitution
 $timeList = array('4 PM', '5 PM');

 // Set all of the above variables
 $email->setTos($toList);
 $email->addSubstitution('-name-', $nameList);
 $email->addSubstitution('-time-', $timeList);

 // Specify that this is an initial contact message
 $email->addCategory("initial");

 // You can optionally setup individual filters here, in this example, we have
 // enabled the footer filter
 $email->addFilter('footer', 'enable', 1);
 $email->addFilter('footer', "text/plain", "Thank you for your business");
 $email->addFilter('footer', "text/html", "Thank you for your business");

 // The subject of your email
 $subject = 'Example SendGrid Email';

 // Where is this message coming from. For example, this message can be from
 // support@yourcompany.com, info@yourcompany.com
 $from = 'admin@artargus.in.ua';

 // If you do not specify a sender list above, you can specifiy the user here. If
 // a sender list IS specified above, this email address becomes irrelevant.
 //$to = 'john@contoso.com';

 # Create the body of the message (a plain-text and an HTML version).
 # text is your plain-text email
 # html is your html version of the email
 # if the receiver is able to view html emails then only the html
 # email will be displayed


 $text = "
 Hello -name-,
 Thank you for your interest in our products. We have set up an appointment to call you at -time- EST to discuss your needs in more detail.
 Regards,
 Fred";

 $html = "
 <html>
 <head></head>
 <body>
 <p>Hello -name-,<br>
 Thank you for your interest in our products. We have set up an appointment
 to call you at -time- EST to discuss your needs in more detail.

 Regards,

 Fred<br>
 </p>
 </body>
 </html>";

 // set subject
 $email->setSubject($subject);

 // attach the body of the email
 $email->setFrom($from);
 $email->setHtml($html);
 $email->addTo($to);
 $email->setText($text);

 // Your SendGrid account credentials
 $username = 'JarLiv';// 'sendgridusername@yourdomain.com';
 $password = 'slJar112233';

 // Create SendGrid object
 $sendgrid = new SendGrid($username, $password);

 // send message
 $response = $sendgrid->send($email);

 print_r($response);*/

/*$url = 'https://api.sendgrid.com/';
 $user = 'JarLiv';
 $pass = 'slJar112233';

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => 'sl147@ukr.net',
      'subject' => 'testing from curl',
      'html' => 'testing body',
      'text' => 'testing body',
      'from' => 'admin@artargus.in.ua',
   );

 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);

 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
 $response = curl_exec($session);
 curl_close($session);

 // print everything out
 print_r($response);*/

/*
$text = "Hi!\nHow are you?\n";
 $html = "<html>
       <head></head>
       <body>
           <p>Hi!<br>
               How are you?<br>
           </p>
       </body>
       </html>";
 // This is your From email address
 $from = array('admin@artargus.in.ua' => 'Name To Appear');
 // Email recipients
 $to = array(
       'sl147@ukr.net'=>'Destination 1 Name',
       'sl147@i.ua'=>'Destination 2 Name'
 );
 // Email subject
 $subject = 'Example PHP Email';

 // Login credentials
 $username = 'JarLiv';
 $password = 'slJar112233';

 // Setup Swift mailer parameters
 $transport = Swift_SmtpTransport::newInstance('mail.artargus.in.ua', 465);
 $transport->setUsername($username);
 $transport->setPassword($password);
 $swift = Swift_Mailer::newInstance($transport);

 // Create a message (subject)
 $message = new Swift_Message($subject);

 // attach the body of the email
 $message->setFrom($from);
 $message->setBody($html, 'text/html');
 $message->setTo($to);
 $message->addPart($text, 'text/plain');

 // send message
 if ($recipients = $swift->send($message, $failures))
 {
     // This will let us know how many users received this message
     echo 'Message sent out to '.$recipients.' users';
 }
 // something went wrong =(
 else
 {
     echo "Something went wrong - ";
     print_r($failures);
 }
*/

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
	echo "OK sl147@ukr.net <br>";
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
//}
?>

</table>
<?php include 'views/layouts/footerAdmin.php';?>