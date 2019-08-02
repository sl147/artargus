<?php
require_once ('../classes/classGetData.php');
$MK   = new classGetData('photoalbum');
$pr   = $MK->getDataFromTableOrderVue('id_FA');
$data    = [];
foreach ($pr as $item) {
	$new_item = array(
		'id'   => $item["id_FA"],
		'name' => $item["name_FA"],
		'msgs' => $item["msgs_FA"],
		'logo' => $item["log_FA"],
	);
	array_push($data, $new_item);
}

echo json_encode($data);
?>