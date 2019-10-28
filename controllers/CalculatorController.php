<?php
/**
 * 
 */
class CalculatorController {

	private function json($d) {
		$data    = [
		  'type' => $d
		];
		return json_encode($data);
	}

	private function viewMeasures($tab,$h3,$meta) {
		$type    = 4;
		$ip      = $_SERVER['REMOTE_ADDR'];
		$subject = "перехід на ".$h3;
		$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";		
		$sendCl  = new SendMail(); 
		$send    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);
		$comment = Insurance::getComment($type);
		if(isset($_POST['submit'])) {
			$typeC   = new classGetData('typeCalculator');			
			$nik     = Auxiliary::filterTXT('post', 'nik_com');
			$text    = Auxiliary::filterTXT('post', 'txt_com');
	        $ip      = $_SERVER['REMOTE_ADDR'];
	        $result  = Insurance::saveComment($type,$nik,$text,$ip);
			$subject = "Новий коментар ".$typeC->getDataFromTableById($type)['name']." ip=".$ip;
			$to      = "sl147@ukr.net";
			$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";
			$send    = new SendMail(); 
			$sendd   = $send->sendMail($subject,"sl147@ukr.net",$massage);
	    }				
		require_once ('views/calculator/cMeasures.php');
		return true;
	}

	private function editMeasures($title) {	
		require_once ('views/calculator/editMeasures.php');
		return true;		
	}

	public function actionCSubEdit() {
		$title = 'Редагування груп одиниць виміру';
		require_once ('views/calculator/editSubMeasures.php');
		return true;		
	}

	public function actionEdit() {
		require_once ('views/calculator/editMeasures.php');
		return true;		
	}

	public function actionLength() {
		$res = self::viewMeasures("cLength","калькулятори інші",Auxiliary:: getMeta("Length"));
		return true;	
	}
}
?>