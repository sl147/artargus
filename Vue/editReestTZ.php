<?php
require_once ('../models/Insurance.php');

$id   = trim(strip_tags($_GET['id']));
$name = trim(strip_tags($_GET['name']));
$k2   = trim(strip_tags($_GET['k2']));

$MK   = new Insurance();
$pr   = $MK->updateVueReestr($id, $name, $k2);

?>