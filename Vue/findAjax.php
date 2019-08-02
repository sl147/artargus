<?php
require_once ('../models/Product.php');
$data = [];

$find = trim(strip_tags($_GET['str']));
$MK   = new Product();
$data = $MK->getFindList($find);

echo json_encode($data);
?>