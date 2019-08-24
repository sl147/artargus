<?php
/**
* 
*/
class ListClientController
{
	public function actionIndex() {

		$ClientList      = User::getClients(1);
		$ClientAdmList   = User::getClients(2);
		$ClientManList   = User::getClients(3);		

		$getData         = new classGetData('friends_role');
		$allroles        = $getData->getDataFromTable();
		unset($getData);

		$getData         = new classGetData('friends_MVC');
		$allManagers     = $getData->getDataFromTableByName (3,"admin");
		unset($getData);

		require_once ('views/client/view.php');
		return true;  
	}	

	public function actionOutExcell($id) {
		$id       = Auxiliary::getIntval($id);
		$order    = Order::getOrderById($id);
		$orderTab = Order::getOrderTabById($order['orderid']);
		$orderSum = Order::getOrderTabSum($orderTab);		
		require_once ('template/out_Excell.php');
		$loc="Location:".$_SERVER['HTTP_REFERER'];
 		header( $loc);
		return true;				
	}

	public function actionChangeMan($id,$idManager) {
		$result    = User::changeManager(Auxiliary::getIntval($id),Auxiliary::getIntval($idManager));
	}

	public function actionChangeRole() {
		$idRole = $_POST['idRole'];
		$id     = $_POST['id'];
		$result = User::changeRole($id,$idRole);
	}

	public function actionChangeDataClient($id) {
		$client = User::getUserById(Auxiliary::getIntval($id));
		
		if(isset($_POST['submit']))
		{
	        $name    = $_POST['name'];
	        $surname = $_POST['surname'];
	        $email   = $_POST['email'];
	        $phone   = $_POST['phone'];

			$errors = false;

			if (!User::chekEmail($email)) {
				$errors [] = "wrong email";
			}

			if ($errors == FALSE) {
				$result = User::edit($id,$name,$surname,$email,$phone);
				$location = $_SERVER['HTTP_REFERER'];
				header ("Location: $location");
			}
		}		
		require_once ('views/user/changedata.php');
		return true;		
	}

	public function actionEdit($id)	{
		$client = User::getUserById(Auxiliary::getIntval($id));
		echo "name - ".$client['name'];

		require_once ('views/user/edit.php');
		return true;		
	}

	public function actionSelClient() {
		$clientsList = User::getAllClients();

		require_once ('views/user/selClient.php');
		return true;
	}

	public function actionListCl($id) {
		$order    = Order::getOrderById(Auxiliary::getIntval($id));
		$orderTab = Order::getOrderTabById($order['orderid']);
		$orderSum = Order::getOrderTabSum($orderTab);
		require_once ('views/user/listCl.php');
		require_once ('views/user/listClFooter.php');
		return true;
	}

	public function actionLook($id) {
		$order    = Order::getOrderById(Auxiliary::getIntval($id));
		$orderTab = Order::getOrderTabById($order['orderid']);
		$orderSum = Order::getOrderTabSum($orderTab);
		require_once ('views/user/listCl.php');
		require_once ('views/user/lookFooter.php');
		return true;
	}

	public function actionPrint($id) {
		$order    = Order::getOrderById(Auxiliary::getIntval($id));
		$orderTab = Order::getOrderTabById($order['orderid']);
		$orderSum = Order::getOrderTabSum($orderTab);

		require_once ('views/user/print.php');
		return true;
	}	
}
?>