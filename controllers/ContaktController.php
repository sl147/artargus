<?php
/**
* 
*/
class ContaktController
{
	
	public function actionIndex() {
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany("contact.html","url_name");
		unset($getmeta);
		if ($meta) {
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = substr($meta['descr'],0,200);
			$meta['title']    = substr($meta['title'],0,75);
			$meta['follow']   = $meta['follow'];			
		}

		if(isset($_POST['submit']))
		{
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
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = 'descr';
			$meta['title']    = 'контакти';
			$meta['nofolow']  = 'noindex, nofollow';
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