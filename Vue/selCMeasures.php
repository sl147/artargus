<?php
require_once ('../classes/classGetData.php');
$tab = trim(strip_tags($_GET['tab']));
$MK  = new classGetData($tab);
echo json_encode($MK->getDataFromTableVue());
?>