<?php
require_once ('../models/Calculator.php');

$name = trim(strip_tags($_GET['name']));
$k    = trim(strip_tags($_GET['k']));
$tab  = trim(strip_tags($_GET['tab']));

$MK   = new Calculator();
$pr   = $MK->addVueReestrTab($name, $k,$tab);

?>