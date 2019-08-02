<?
require_once ('../classes/classGetData.php');

$name = trim(strip_tags($_GET['name']));
$tab  = trim(strip_tags($_GET['tab']));
$MK   = new classGetData($tab);
$MK->add2el($name);
?>