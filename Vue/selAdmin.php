<?php
require_once ('../classes/classGetData.php');

$page = intval($_GET['page']);
$show = intval($_GET['show']);
$jobs = new classGetData('job_status');
$MK   = new classGetData('eOrders');
$pr   = $MK->getOrderPageVue($show,$page,'id_ord');
$data = [];

foreach ($pr as $item) {
	$new_item = array(
		'id'    => $item["id_ord"],
		'name'  => $item["name"],
		'phone' => $item["phone"],
		'email' => $item["email"],
	  'orderid' => $item["orderid"],
	  'status'  => $jobs->getDataFromTableByIdVue($item['job'])['name'],
	);
	array_push($data, $new_item);
}

unset($MK);
unset($jobs);
echo json_encode($data);
?>