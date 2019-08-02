<?php
require_once "../dblinc.php";
global $link;

$data = [];
$sql = "SELECT * FROM ecatalog WHERE parent ='0' ORDER BY name";
if ($result = mysqli_query($link,$sql))
	{
		while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{			
			$new_item = [
			'id'      => $item["id"],
			'name'    => $item["name"],
			'kodTov'  => $item["kod_t"]
			];
			array_push($data, $new_item);
		}
	}
echo json_encode($data);
?>