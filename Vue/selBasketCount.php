<?
require_once "../dblinc.php";
global $link;
$data  = [];
$count = 0;
if (isset($_COOKIE["basket"])) {
	$basket = unserialize($_COOKIE["basket"]);
	$orderid = $basket['orderid'];
	$goods = array_keys($basket);
	array_shift ($goods);
	$count = count($goods);
}
			$new_item = array(
				'count'   => $count
			);
			array_push($data, $new_item);

echo json_encode($data);
?>