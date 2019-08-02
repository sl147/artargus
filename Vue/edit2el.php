<?php
require_once ('../classes/classGetData.php');

$id   = trim(strip_tags($_GET['id']));
$name = trim(strip_tags($_GET['name']));
$tab  = trim(strip_tags($_GET['tab']));
$MK   = new classGetData($tab);

$MK->edit2el($name,$id);
unset($MK);
?>