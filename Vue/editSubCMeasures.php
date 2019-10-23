<?php
require_once ('../models/Calculator.php');

$id          = trim(strip_tags($_GET['id']));
$name        = trim(strip_tags($_GET['name']));
$idCalculator= trim(strip_tags($_GET['idCalculator']));

$MK          = new Calculator();
$pr          = $MK->updateVueSub($id, $name, $idCalculator);
?>