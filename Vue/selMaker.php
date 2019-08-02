<?php
require_once ('../classes/classGetData.php');
$pathdir = "../FT/logo/";

$MK      = new classGetData('emaker');
$pr      = $MK->getDataFromTableOrderVue('name','');

$data = [];
foreach ($pr as $item) {

	$f         = $item['logo_m_s'];
	$fot       = $pathdir.$item['logo_m_s'];
	$fotL      = $pathdir.$item['logo_m'];			
	$new_item = [
		'id'   => $item["id"],
		'name' => $item["name"],
		'site' => $item["site"],
	   'count' => $item["count"],
	 'country' => $item["country"],
	    'logo' => $f,
	    'fot'  => $fot,
		'fotL' => $fotL,
	];
	array_push($data, $new_item);
}
echo json_encode($data);
?>