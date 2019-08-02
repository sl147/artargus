<?php
require_once ('../models/Insurance.php');

$name = trim(strip_tags($_GET['name']));
$k2   = trim(strip_tags($_GET['k2']));

$MK   = new Insurance();
$pr   = $MK->addVueReestr($name, $k2);

?>