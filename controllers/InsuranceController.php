<?php
/**
 * 
 */
class InsuranceController
{

	public function actionInsuranceType() {
		$title = "Редагування типів ТЗ";
		require_once ('views/insurance/edit_TZ.php');
		return true;		
	}

	public function actionInsuranceReestr() {
		$title = "Редагування місця реєстрації";
		require_once ('views/insurance/edit_Reestr.php');
		return true;		
	}

	public function actionInsuranceCommentEdit($page = 1) {
		$page = Auxiliary::getIntval($page);
		if(isset($_POST['submit'])) {
			$id       = Auxiliary::filterINT('post','id');
			$act      = Auxiliary::filterINT('post','active');
			$getComCl = new classGetData('CommentCalculators');
			$res      = $getComCl->activated($id,$act, 'CommentCalculators' );
			unset($getComCl);
		}
		$title      = "перегляд коментарів клієнтів";
		$comments   = Insurance::getAllComment($page);
        $total      = Auxiliary::getTotal('CommentCalculators','1','id','id',1);
        $pagination = Auxiliary::getPagination ($total,Insurance::SHOWCOMMENT_BY_DEFAULT, $page);	
		require_once ('views/insurance/insuranceCommentEdit.php');
		return true;
	}

	private function smail($type, $mass) {

		$subject = $massage = "перехід на ".$mass;		
		$sendCl  = new SendMail(); 
		$send    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);

		if(isset($_POST['submit'])) {
			$typeC   = new classGetData('typeCalculator');			
			$nik     = Auxiliary::filterTXT('post', 'nik_com');
			$text    = Auxiliary::filterTXT('post', 'txt_com');
	        $ip      = $_SERVER['REMOTE_ADDR'];
	        $result  = Insurance::saveComment($type,$nik,$text,$ip);
			$subject = "Новий коментар ".$typeC->getDataFromTableById($type)['name']." ip=".$ip;
			$to      = "sl147@ukr.net";
			$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";
			$sendCl  = new SendMail(); 
			$send    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);
	    }
	}

	public function actionIndex() {
		$meta    = Auxiliary:: getMeta("insurance");
		$type    = 1;
		$mass    = "калькулятор автоцивілки";
		$res     = self:: smail($type, $mass);
		$comment = Insurance::getComment($type);
		require_once ('views/insurance/insurance.php');
		return true;
	}

	public function actionAutosign () {
		$meta    = Auxiliary:: getMeta("autoNumber");
		$type    = 2;
		$mass    = "автономера";
		$res     = self:: smail($type, $mass);
	    $comment = Insurance::getComment($type);				
		require_once ('views/insurance/autosign.php');
		return true;
	}

	public function actionPlugin($lang="en") {
		$type    = 3;
		$mass    = "плагін";
		$res     = self:: smail($type, $mass);
		$comment = Insurance::getComment($type);
		$ip      = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '';
		$ref     = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
		$result  = Insurance::saveComeToPlugin($ref,$ip);
		if ($lang == "ukr") {
			$title   = "Сторінка плагіна";
			require_once ('views/insurance/plugin.php');	
		}
		else {
			$title   = "Plugin page";
			require_once ('views/insurance/pluginEng.php');
		}
		
		return true;		
	}

	public function actionComeToPlugin($page = 1) {
		$page       = Auxiliary::getIntval($page);
		$title      = "переходи на плагін";
		$gd   = new classGetData('ComeToPlugin');
		$lists = $gd->getDataFromTableOrderPage(Insurance::SHOWCOMMENT_BY_DEFAULT,$page,'id');
		//$lists      = Insurance::getComeToPlugin($page);
        $total      = Auxiliary::getTotal('ComeToPlugin','1','id','id',1);
        $pagination = Auxiliary::getPagination ($total,Insurance::SHOWCOMMENT_BY_DEFAULT, $page);
		require_once ('views/insurance/insuranceComeToPlugin.php');
		return true;
	}
}
?>