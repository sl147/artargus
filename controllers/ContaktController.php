<?php
/**
* 
*/
class ContaktController {
	
	public function actionIndex() {
		$meta = Auxiliary:: getMeta("contact.html");
		if(isset($_POST['submit'])) {
	        $nik_com = Auxiliary::filterTXT('post', 'nik_com');
	        $email   = Auxiliary::filterEmail('post', 'email');
	        $txt_com = Auxiliary::filterTXT('post', 'txt_com');
	        $ip_com  = $_SERVER['REMOTE_ADDR'];
	        $errors  = false;
			if (!ContaktModel::chekNik($nik_com)) {
				$errors [] = "empty nik";
			}
			if (!ContaktModel::chekEmail($email)) {
				$errors [] = "wrong email";
			}			
			if ($errors == false) {
				$result = ContaktModel::saveComent($nik_com,$ip_com,$email,$txt_com);
			}				        
		}
		require_once 'views/contakt/index.php';
		return true;
	}

	public function actionProba() {
		if(isset($_POST['submit'])) {
	        $nik_com = Auxiliary::filterTXT('post', 'nik_com');
	        header ('Location: /modal');        
		}		
		require_once 'views/contakt/proba.php';
		return true;
	}

	public function actionModal() {	
		require_once 'views/contakt/modal.php';
		return true;
	}
}
?>