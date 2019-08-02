<?php
require_once ('../classes/classGetData.php');
$MK   = new classGetData('in_type');
echo json_encode($MK->getDataFromTableVue());
?>