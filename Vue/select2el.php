<?php
require_once ('../classes/classGetData.php');
$data = [];
$tab  = trim(strip_tags($_GET['tab']));
$MK   = new classGetData($tab);
$data = $MK->select2el();
unset($MK);
echo json_encode($data);
?>