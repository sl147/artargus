<?php
require_once "../dblinc.php";
global $link;
$data   = [];
$status = [];
$deliv  = [];
$client = [];

$sql = "SELECT * FROM friends_MVC";
if ($result = mysqli_query($link,$sql))
{
	while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$id          = $item['id'];
		$client[$id] = $item['name']." ".$item['surname'];			
	}
}

$sql = "SELECT * FROM deliveryFirm";
if ($result = mysqli_query($link,$sql))
{
	while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$idel         = $item['id'];
		$deliv[$idel] = $item['name'];			
	}
}

$sql = "SELECT * FROM job_status";
if ($result = mysqli_query($link,$sql))
	{	
	while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{			
		$id    = $item["id"];
		$status[$id] = $item['name'];
	}
}

$id =$_GET["id"];
if ($id == 0) $sql = "SELECT * FROM eOrders ORDER BY date_ord DESC";
else $sql = "SELECT * FROM eOrders WHERE id_Client='".$id."' ORDER BY date_ord DESC";

if ($result = mysqli_query($link,$sql))
	{	
	while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{			
		$new_item   = array(
		'id'        => $item["id_ord"],
		'orderid'   => $item['orderid'],
		'id_Client' => $item["id_Client"],
		'name'      => $client[$item['id_Client']],
		'surname'   => $item["surname"],
		'phone'     => $item['phone'],
		'email'     => $item["email"],
		'date_ord'  => $item['date_ord'],
		'deliver'   => $deliv[$item['deliver']],
		'job'       => $status[$item['job']],
		);
		array_push($data, $new_item);
	}
}
echo json_encode($data);	
?>