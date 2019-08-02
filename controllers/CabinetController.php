<?php

class CabinetController
{	
	public function actionIndex()
	{
		$userId = User::chekLogged();
		$user   = User::getUserById($userId);		
		require_once 'views/cabinet/index.php';
		return true;
	}

	public function actionEdit() {
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany("cabinet/edit","url_name");
		unset($getmeta);
		if ($meta) {
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = substr($meta['descr'],0,200);
			$meta['title']    = substr($meta['title'],0,75);
			$meta['follow']   = $meta['follow'];
		}
		$userId   = User::chekLogged();
		$user     = User::getUserById($userId);
		$login    = $user['user_login'];
        $name     = $user['name'];
        $surname  = $user['surname'];
        $email    = $user['email'];
        $phone    = $user['phone'];
 		$result   = false;
		if(isset($_POST['submit']))
		{
		        $name    = Auxiliary::filterTXT('post', 'name');
		        $surname = Auxiliary::filterTXT('post', 'surname');
		        $email   = Auxiliary::filterEmail('post', 'email');
		        $phone   = Auxiliary::filterTXT('post', 'phone');
				$errors  = false;
				if (!User::chekEmail($email)) {
					$errors [] = "wrong email";
				}
				if ($errors == FALSE) {
					$result = User::edit($userId,$name,$surname,$email,$phone);
				}								
		}
		require_once 'views/cabinet/edit.php';
		return true; 		
	}

	public function actionHistory()	{
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany("cabinet/edit","url_name");
		unset($getmeta);
		if ($meta) {
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = substr($meta['descr'],0,200);
			$meta['title']    = substr($meta['title'],0,75);
			$meta['follow']   = $meta['follow'];
		}
		$id        = User::userId();
		$orderList = Order::getOrderByClient ($id);
	
		require_once 'views/user/history.php';
		return true;		
	}
}
?>