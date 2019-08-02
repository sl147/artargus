<?
$id = $_GET["id"];
$q  = $_GET["count"];
$basket = unserialize($_COOKIE["basket"]);
$basket[$id] = $q;
$basket = serialize($basket);
setcookie("basket",$basket,time()+72000,"/");
?>