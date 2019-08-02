<?php
require_once ('../classes/classGetData.php');
$MK = new classGetData('in_chek');
echo json_encode($MK->getDataFromTableVue());
?>