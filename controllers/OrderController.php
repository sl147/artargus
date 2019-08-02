<?php
/**
* 
*/
class OrderController {
	
	public function actionLook($id) {
		echo "id=$id";
		$getOrders   = new classGetData('eOrders');
		$orderOne    = $getOrders->getDataFromTableByIdMany($id,"id_Client");
		$orderTabOne = Order::getOrderTabById($id);
		$orderSum    = Order::getOrderTabSum($orderTabOne);
		
		require_once ('views/order/view.php');
		return true;
	}

	public function actionIndex() {
		$ordersAll  = Order::getAllOrders();
		$orders     = Order::getAllOrderByJob(1);
		$ordersMade = Order::getAllOrderByJob(4);
		$getData    = new classGetData('job_status');
		$jobs       = $getData->getDataFromTable();
		unset($getData);
		require_once ('views/order/index.php');
		return true;
	}

	public function actionIndexfind() {
		$getData = new classGetData('job_status');
		$jobs    = $getData->getDataFromTable();
		unset($getData);		
		$clients = User::getAllClients();

		$today = date("d/m/Y");
		if (!isset($date_begin))  $date_begin  = '01/01/2017';
		if (!isset($date_ended))  $date_ended  = $today;
		if (!isset($jobSelect))   $jobSelect   = false;
		if (!isset($userSelect))  $userSelect  = false;
		if (!isset($phoneSelect)) $phoneSelect = false;

		if(isset($_POST['submit'])) {
			$jobSelect   = $_POST['job'];
			if ($jobSelect) {
				$jobs[0]['id']   = $jobSelect;
				$jobs[0]['name'] = $jobs[$jobSelect - 1]['name'];
			}
			$userSelect  = $_POST['client'];
			if ($userSelect) {
				$userNames   = User::getUserById ($userSelect);
				$userName    = $userNames['name']." ".$userNames['surname'];
				$clients[0]['id']   = $userSelect;
				$clients[0]['name'] = $userName;
			}
			$phoneSelect = $_POST['phone'];
			$date_begin  = $_POST['date_begin'];
			$date_ended  = $_POST['date_ended'];			
		}

		$orders = Order::getAllOrdersBySelect($date_begin,$date_ended,$jobSelect,$userSelect,$phoneSelect);

		require_once ('views/order/indexFind.php');
		return true;
	}

	public function actionChangeStatus() {
		   $job = $_POST['job'];
			$id = $_POST['id'];
		$result = Order::edit($id,$job);				
	}
}
?>