<?php
require_once ('../models/Insurance.php');

$type = trim(strip_tags($_GET['type']));
$name = trim(strip_tags($_GET['name']));
$k1   = trim(strip_tags($_GET['k1']));

$MK   = new Insurance();
$pr   = $MK->addVueTZ($type, $name, $k1);

?>