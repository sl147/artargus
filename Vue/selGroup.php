<?php
require_once "../dblinc.php";
global $link;
$kod = $_GET['kodTovParent'];
$data = [];
$maker = [];
$pathGroup= "/FT";

$sql = "SELECT * FROM emaker";
if ($result = mysqli_query($link,$sql))
{
	while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$id         = $item['id'];
		$maker[$id] = $item['name'];
	}
}

$sql = "SELECT * FROM ecatalog WHERE parent=".$kod." ORDER BY name";
if ($result = mysqli_query($link,$sql))
	{
		while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{			

			$new_item  = array(
			'id'       => $item["id"],
			'kod_t'    => $item["kod_t"],
			'kodCol'   => $item["kodCol"],
			'foto'     => $item["foto"],
			'fotLIt'   => $pathGroup.$item['fullKod']."/".$item['foto'],
			'fotLGr'   => $pathGroup."/".$item['foto'],
			'brand'    => $maker[$item["brand"]],
			'name'     => $item["name"],
			'price'    => $item["price"],
			'isPlus'   => '',
			'countTov' => $item["countTov"],
			);
			array_push($data, $new_item);
		}
	}
echo json_encode($data);
?>