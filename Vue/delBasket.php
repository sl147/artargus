<?
require_once ('../models/Basket.php');
$id    = trim(strip_tags($_GET['id']));
$data  = [];
$MK    = new Basket();
$pr    = $MK->delBasket($id);
?>