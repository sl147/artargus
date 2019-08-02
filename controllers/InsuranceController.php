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
		if (intval($page)) {
			if(isset($_POST['submit'])) {
				$id       = Auxiliary::filterINT('post','id');
				$act      = Auxiliary::filterINT('post','active');
				$getComCl = new classGetData('CommentCalculators');
				$res      = $getComCl->activated($id,$act, 'CommentCalculators' );
				unset($getComCl);
			}
			$title    = "перегляд коментарів клієнтів";
			$comments = Insurance::getAllComment($page);
			$classCount = new Count('CommentCalculators');
			$total      = $classCount->get();
			$pagination = new Pagination($total, $page, Insurance::SHOWCOMMENT_BY_DEFAULT, 'page-');
			require_once ('views/insurance/insuranceCommentEdit.php');
			return true;
		}
	}

	private function smail($type, $mass) {

		$subject = $massage = "перехід на ".$mass;		
		$sendCl  = new SendMail(); 
		$send    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);
		
		if(isset($_POST['submit'])) {			
			$nik     = Auxiliary::filterTXT('post', 'nik_com');
			$text    = Auxiliary::filterTXT('post', 'txt_com');
	        $ip      = $_SERVER['REMOTE_ADDR'];
	        $result  = Insurance::saveComment($type,$nik,$text,$ip);			
			$subject = "Новий коментар ".Insurance::getCalculatorType($type)." ip=".$ip;
			$to      = "sl147@ukr.net";
			$massage = $subject." ip=".$ip."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$_SERVER['REMOTE_ADDR']."\r\n";
			$sendCl  = new SendMail(); 
			$send    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);
	    }
	}

	public function actionIndex() {
		$meta['title']    = "Калькулятор автоцивілки";
		$meta['keywords'] = "ОСАГО страхування цивільної відповідальності калькулятор автоцивілки автоцивілка";
		$meta['descr']    = "Калькулятор розрахунку вартості страхування цивільної відповідальності";
		$type             = 1;
		$mass             = "калькулятор автоцивілки";
		$res              = self:: smail($type, $mass);
		$comment          = Insurance::getComment($type);
		require_once ('views/insurance/insurance.php');
		return true;
	}

	public function actionAutosign () {
		$meta['title']    = "АВТО НОМЕРА УКРАЇНИ";
		$meta['keywords'] = "АВТОНОМЕР автомобільний номер";
		$meta['descr']    = "взнати номера автомобілів по областях";
		$type             = 2;
		$mass             = "автономера";
		$res              = self:: smail($type, $mass);
	    $comment          = Insurance::getComment($type);				
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
		if (intval($page)) {
			$title      = "переходи на плагін";
			$lists      = Insurance::getComeToPlugin($page);
			$classCount = new Count('ComeToPlugin');
			$total      = $classCount->get();
			$pagination = new Pagination($total, $page, Insurance::SHOWCOMMENT_BY_DEFAULT, 'page-');
			require_once ('views/insurance/insuranceComeToPlugin.php');
			return true;
		}
	}
}
?>