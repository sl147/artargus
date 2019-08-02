<?
require_once ('../models/Product.php');

$name   = trim(strip_tags($_GET['name']));
$parent = 0;
$MK     = new Product();
$MK->saveAddGroup($name,$parent);
?>