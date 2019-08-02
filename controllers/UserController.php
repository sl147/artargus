<?php

class UserController
{
	
	function actionRegister()
	{
		$login    = $password = '';
		$getmeta  = new classGetData('meta_tags');
		$meta     = $getmeta->getDataFromTableByIdMany("user/register","url_name");
		unset($getmeta);
		if ($meta) {
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = substr($meta['descr'],0,200);
			$meta['title']    = substr($meta['title'],0,75);
			$meta['follow']   = $meta['follow'];
		}		
		if(isset($_POST['submit'])) {
	        $login    = Auxiliary::filterTXT('post', 'login');;
	        $password = Auxiliary::filterTXT('post', 'password');
	        $errors   = false;
			$userId = User::chekUserData($login,$password);
			if ($userId == false) {
				$errors []= "не вірний логін або пароль";
			}
			else {
				$res = User::auth($userId);
				if (User::isAdmin($userId)) {
                    header ('Location: /admin');                    
                }
                else {
					if (User::isManager($userId)) {
	                    header ('Location: /admin');                    
	                }
	                else {               
                		header ('Location: /');
                	}
                }
			}
		}

		require_once 'views/user/register.php';
		return true;
	}

	function actionAuthor()
	{
		$login = $name = $surname = $email = $phone = $password = $passwordConfirm = '';
		$result   = false;

		if(isset($_POST['submit'])) {
			$login       = Auxiliary::filterTXT  ('post', 'login');
			$name        = Auxiliary::filterTXT  ('post', 'name');
			$surname     = Auxiliary::filterTXT  ('post', 'surname');
			$email       = Auxiliary::filterEmail('post', 'email');
			$phone       = Auxiliary::filterTXT  ('post', 'phone');
			$password    = Auxiliary::filterTXT  ('post', 'password');
		$passwordConfirm = Auxiliary::filterTXT  ('post', 'passwordConfirm');
		 		 $errors = false;

				if (!User::chekLogin($login)) {
					$errors [] = "логін повинен містити більше ніж 3 символа";
				}

				if (!User::chekPassword($password)) {
					$errors [] = "пароль повинен містити більше ніж 5 символів";
				}

				if (!User::chekConfirmPassword($password,$passwordConfirm)) {
					$errors [] = "підтвердження паролю не співпадає $passwordConfirm";
				}

				if (User::chekLoginExist($login)) {
					$errors [] = "логін вже зайнятий";
				}

				if ($errors == FALSE) {
					$result  = User::register($login,$password,$name,$surname,$email,$phone);
					$getUser = new classGetData('friends_MVC');
					$result  = $getUser->getDataFromTableByIdMany($login,"user_login");
					unset($getUser);
					$res    =User::auth($result["id"]);					
					header ('Location: /');
				}
		}
		
		require_once 'views/user/author.php';
		return true;
		}

		function actionCabinet() {
			$userId = User::chekLogged();
			$user   = User::getUserById($userId);
			
			require_once 'views/user/cabinet.php';
			return true;
		}

		function actionLogout() {
			unset ($_SESSION["user"]);
			$basket   = Basket::basketDel();
			header ('Location: /');
		}		
}
?>