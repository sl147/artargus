<?php
//require_once ('../models/Auxiliary.php');
require_once ('../models/Product.php');
$id      = intval($_GET['id']);
//$MK      = new Auxiliary();
//$pr      = $MK->delFileVue($
$MK      = new Product();
//$pr      = $MK->delFileVue($id);
$item      = $MK->getProductByIdVue($id);

		$file    = dirname(__DIR__).$item['fotLIt'];
		$file_s  = dirname(__DIR__).$item['fotos'];
		if (file_exists($file)) {
			$res = unlink($file);
		}
		if (file_exists($file_s)) {
			$res = unlink($file_s);
		}
?>