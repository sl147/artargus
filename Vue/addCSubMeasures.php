<?php
require_once ('../models/Calculator.php');

$name = trim(strip_tags($_GET['name']));
$type = trim(strip_tags($_GET['type']));

$MK   = new Calculator();
$pr   = $MK->addVueSubTypes($name, $type);

?>