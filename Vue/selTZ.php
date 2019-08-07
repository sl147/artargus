<?php
require_once ('../classes/classGetData.php');
$MK   = new classGetData('in_type');
$arr  = $MK->getDataFromTableVue();
if (count($arr)>0) {
//echo json_encode($MK->getDataFromTableVue());	
	echo json_encode($arr);
}
else {
	$arr = array(
		'type' => 'B1',
		'name' => 'до 1600 куб.см',
		'value'=> '1',
	);
	echo json_encode($arr);
}
?>