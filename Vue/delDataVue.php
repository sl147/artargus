<?
require_once ('../classes/classGetData.php');

$id     = trim(strip_tags($_GET['id']));
$tab    = trim(strip_tags($_GET['tab']));
$nameid = trim(strip_tags($_GET['nameid']));
$MK     = new classGetData($tab);
$pr     = $MK->deleteDataFromTableVue($id,$nameid);
unset($MK);
?>