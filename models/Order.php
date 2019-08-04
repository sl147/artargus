<?php
/**
* 
*/
class Order
{
	const SHOW_BY_DEFAULT = 10;

	public static function saveOrderTab () {
		$basket  = Basket::getBasket();
		$orderid = Basket::getBasketId();
		$db = Db::getConnection();
		foreach ($basket as $item) {
			$id_tov    = $item['id'];
			$kod_t     = $item['kod_t'];
			$price     = $item['price'];
			$quantity  = $item['q'];
			$name      = $item['name'];
			$sqlres = "INSERT INTO eOrdersTab (orderid,id_tov,kod_t,quantity,price) VALUES(:orderid,:id_tov,:kod_t,:quantity,:price)";
			$res = $db -> prepare($sqlres);
			$res -> bindParam(':orderid', $orderid, PDO::PARAM_STR);
			$res -> bindParam(':id_tov',  $id_tov,  PDO::PARAM_STR);
			$res -> bindParam(':kod_t',   $kod_t,   PDO::PARAM_STR);
			$res -> bindParam(':quantity',$quantity,PDO::PARAM_STR);
			$res -> bindParam(':price',   $price,   PDO::PARAM_STR);
			$res -> execute();
		}
		return $res;
	}

	public static function saveOrder ($orderid,$deliver,$adres,
				$name,$surname,$phone,$email,$sklad,$pay,$note,$id_Client)
	{
		$db  = Db::getConnection();
		$job = 1;
		$sql = "INSERT INTO eOrders (orderid,name,surname,phone,adres,email,deliver,sklad,pay,note,job)
		 VALUES(:orderid,:name,:surname,:phone,:adres,:email,:deliver,:sklad,:pay,:note,:job)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':orderid', $orderid, PDO::PARAM_STR);
		$result -> bindParam(':name',    $name,    PDO::PARAM_STR);
		$result -> bindParam(':surname', $surname, PDO::PARAM_STR);
		$result -> bindParam(':phone',   $phone,   PDO::PARAM_STR);
		$result -> bindParam(':adres',   $adres,   PDO::PARAM_STR);
		$result -> bindParam(':email',   $email,   PDO::PARAM_STR);
		$result -> bindParam(':deliver', $deliver, PDO::PARAM_STR);
		$result -> bindParam(':sklad',   $sklad,   PDO::PARAM_STR);
		$result -> bindParam(':pay',     $pay,     PDO::PARAM_STR);
		$result -> bindParam(':note',    $note,    PDO::PARAM_STR);
		$result -> bindParam(':job',     $job,     PDO::PARAM_STR);
				
		return $result -> execute();
	}

	public static function getOrderByClient ($id) {
		$getOrders   = new classGetData('eOrders');
		$result      = $getOrders->getDataFromTableByName($id,"id_Client");
		$i= 0;
		$getJobs     = new classGetData('job_status');
		$getDelivery = new classGetData('job_status');
		while ($row = $result->fetch()) {
							$orderList[]  = $row;
							$delivery     = $getDelivery->getDataFromTableById($row['deliver']);
			$orderList[$i]['deliver']     = $delivery['name'];
								$jobs     = $getJobs->getDataFromTableById($row['job']);
				$orderList[$i]['status']  = $jobs['name'];
				$i++;						
		}
		unset($getJobs);
		unset($getDelivery);
		unset($getOrders);
		return $orderList;
	}

	public static function getOrderById($id) {
		$getOrder    = new classGetData('eOrders');
		$getDelivery = new classGetData('deliveryFirm');
		$getPay      = new classGetData('pay');
		$getJobs     = new classGetData('job_status');
		$orderItem                 = $getOrder->getDataFromTableByIdMany($id,"id_ord");
		$orderItem['nameDelivery'] = $getDelivery->getDataFromTableById($orderItem['deliver'])['name'];	
		$orderItem['namePay']      = $getPay->getDataFromTableById($orderItem['pay'])['name'];
		$orderItem['nameStatus']   = $getJobs->getDataFromTableById($orderItem['job'])['name'];
		unset($getDelivery);
		unset($getPay);
		unset($getJobs);
		unset($getOrder);		
		return $orderItem;
	}

	public static function getOrderTabById($id) 	{

			$orderTabList = [];
			$db = Db::getConnection();
			$sql = "SELECT * FROM eOrdersTab WHERE orderid='".$id."'";
			$result = $db -> query($sql);
			$i= 0;

			while ($row = $result->fetch()) {
				$orderTabList[$i]['nom']      = $i + 1;
				$orderTabList[$i]['orderid']  = $row['orderid'];
				$orderTabList[$i]['id_tov']   = $row['id_tov'];
				$orderTabList[$i]['kod_t']    = $row['kod_t'];
				$orderTabList[$i]['quantity']        = $row['quantity'];
				$orderTabList[$i]['price']    = $row['price'];
				$orderTabList[$i]['i']        = $i+1;
				$orderTabList[$i]['suma']     = $row['price'] * $row['quantity'];
				
				$restov = $db -> query("SELECT * FROM ecatalog WHERE id=".$row['id_tov']);
				$restov -> setFetchMode(PDO::FETCH_ASSOC);
				$rowtov = $restov->fetch();
				$nameGr = "FT".$rowtov['fullKod']."/";
				$orderTabList[$i]['foto']    = $nameGr.$rowtov['foto'];
				$orderTabList[$i]['name']    = $rowtov['name'];
				$orderTabList[$i]['article'] = $rowtov['article'];
				$orderTabList[$i]['kodCol']  = $rowtov['kodCol'];

				$i++;						
			}
		
			return $orderTabList;
	}
	public static function getOrderTabSum($orderTab) {
		$tabSum = [];
		$qq     = 0;
		$suma   = 0;
		foreach ($orderTab as $item) {
			$qq   +=$item['quantity'];
			$suma +=$item['price'] * $item['quantity'];
		}
		$tabSum['qq']   = $qq;
		$tabSum['suma'] = $suma;
		return $tabSum;
	}

	public static function getAllOrdersBySelect($date_begin,$date_ended,$jobSelect,$userSelect,$phoneSelect) {

		$filter  = false;
		$fjob    = false;
		$fclient = false;
		$fphone  = false;
		$fdbegin = false;
		$fdend   = false;
		$and     = false;

		if ($date_begin and $date_ended) {
			$filter  = true;
		}
		
		if ($date_begin) {			
			$fdbegin = true;
			$date1 = Auxiliary::getDate($date_begin);
		}
		if ($date_ended) {			
			$fdend  = true;
			$date2 = Auxiliary::getDate($date_ended);
		}
		if ($jobSelect) {
			$filter = true;
			$fjob   = true;
		}
		if ($userSelect) {
			$filter  = true;
			$fclient = true;
		}
		if ($phoneSelect) {
			$filter = true;
			$fphone = true;
		}
		
		$orderList = [];
		//$db = Db::getConnection();
		$sql = "SELECT * FROM eOrders";
		if ($filter) $sql .= " WHERE ";
		if ($fjob) {
			$sql .= " job = '".$jobSelect."'";
			$and = true;
		}
		if ($fclient && $and) $sql.=" and ";		
		if ($userSelect)  {
			$sql .= "id_Client = '".$userSelect."'";
			$and = true;
		}
		if ($fphone && $and) $sql.=" and ";
		if ($phoneSelect) {
			$sql .= "phone = '".$phoneSelect."'";
			$and = true;
		}
		if ($fdbegin && $fdend && $and) $sql.=" and ";
		if ($fdbegin && $fdend) $sql .= " (date_ord BETWEEN CAST('".$date1."' AS DATE) AND CAST('".$date2."' AS DATE))"; 
		$sql .=" ORDER BY date_ord DESC";
		//$result = $db -> query($sql);
		$result = Db::select($sql);
		$i= 0;
		$getJobs     = new classGetData('job_status');
		$getDelivery = new classGetData('deliveryFirm');
		while ($row = $result->fetch()) {
			$orderList[] = $row;

			$client   = User::getUserById($row['id_Client']);
			$orderList[$i]['client']   = $client['name'];
			$orderList[$i]['deliver']  = $getDelivery->getDataFromTableById($row['deliver'])['name'];
			$orderList[$i]['status']   = $getJobs->getDataFromTableById($row['job'])['name'];
			$orderList[$i]['jobsId']   = $row['job'];
			$orderTab = self::getOrderTabById($row['orderid']);
			$orderSum = self::getOrderTabSum($orderTab);
			$orderList[$i]['qq']       = $orderSum['qq'];
			$orderList[$i]['suma']     = $orderSum['suma'];
			$i++;						
		}
		unset($getJobs);
		unset($getDelivery);
		return $orderList;
	}

	public static function getAllOrders() {
		$orderList = [];
		$sql = "SELECT * FROM eOrders ORDER BY id_ord DESC";
		$result = Db::select($sql);
		$i= 0;
		$getJobs     = new classGetData('job_status');
		$getDelivery = new classGetData('deliveryFirm');
		while ($row = $result->fetch()) {
			$orderList[] = $row;
			
			if ($row['id_Client'])	{
			    $client   = User::getUserById($row['id_Client']);
			    $orderList[$i]['client']   = $client['name'];
			}
			if ($row['deliver']) {
				$orderList[$i]['deliver'] = $getDelivery->getDataFromTableById($row['deliver'])['name'];
			}
			if ($row['job'])	{
				$orderList[$i]['status'] = $getJobs->getDataFromTableById($row['job'])['name'];
			    $orderList[$i]['jobsId'] = $row['job'];
			}
			$orderTab = self::getOrderTabById($row['orderid']);
			$orderSum = self::getOrderTabSum($orderTab);
			$orderList[$i]['qq']       = $orderSum['qq'];
			$orderList[$i]['suma']     = $orderSum['suma'];				
			$i++;		    
		}
		unset($getJobs);
		unset($getDelivery);
		return $orderList;
	}

	public static function getAllOrderInJob($page) {
		if (intval($page)) {
			$made        = 4;
			$orderList   = [];
			$offset      = ($page - 1) * self::SHOW_BY_DEFAULT;
			$result      = Db::select("SELECT * FROM eOrders WHERE job < ".$made." ORDER BY id_ord DESC LIMIT ".self::SHOW_BY_DEFAULT." OFFSET ".$offset);
			$i           = 0;
			$getJobs     = new classGetData('job_status');
			$getDelivery = new classGetData('deliveryFirm');
			while ($row = $result->fetch()) {
				$orderList[] = $row;
				$orderList[$i]['jobsId']   = $row['job'];
				$orderList[$i]['deliver']  = $getDelivery->getDataFromTableById($row['deliver'])['name'];;			
				$orderList[$i]['status']   = $getJobs->getDataFromTableById($row['job'])['name'];
				$orderTab = self::getOrderTabById($row['orderid']);
				$orderSum = self::getOrderTabSum($orderTab);
				$orderList[$i]['qq']       = $orderSum['qq'];
				$orderList[$i]['suma']     = $orderSum['suma'];
				$i++;						
			}
			unset($getJobs);
			unset($getDelivery);
			return $orderList;
		}
	}

	public static function getAllOrderByJob($job) {
		$made = 4;
		$orderList = [];
		if ($job == $made) $sql = "SELECT * FROM eOrders WHERE job=".$job." ORDER BY id_ord DESC";
		else $sql = "SELECT * FROM eOrders WHERE job <> ".$made." and job <> 5 ORDER BY id_ord DESC";
		$result = Db::select($sql);
		$i= 0;
		$getJobs     = new classGetData('job_status');
		$getDelivery = new classGetData('deliveryFirm');
		while ($row = $result->fetch()) {
			$orderList[] = $row;
			$orderList[$i]['jobsId']  = $row['job'];
			$orderList[$i]['deliver'] = $getDelivery->getDataFromTableById($row['deliver'])['name'];
			$orderList[$i]['status']  = $getJobs->getDataFromTableById($row['job'])['name'];
			$orderTab = self::getOrderTabById($row['orderid']);
			$orderSum = self::getOrderTabSum($orderTab);
			$orderList[$i]['qq']      = $orderSum['qq'];
			$orderList[$i]['suma']    = $orderSum['suma'];
			$i++;						
		}
		unset($getJobs);
		unset($getDelivery);
		return $orderList;
	}

	public static function edit ($id,$job) {
		$db = Db::getConnection();
		$sql = "UPDATE eOrders SET job=:job WHERE id_ord=$id";
		$result = $db -> prepare($sql);
		$result -> bindParam(':job', $job, PDO::PARAM_STR);
		
		return $result -> execute();			
	}
}
?>