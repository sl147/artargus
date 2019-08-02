<?php
require_once "../dblinc.php";
global $link;
$pathdir    = "../FT/logo/";
$data = [];
$sql = "SELECT * FROM emaker ORDER BY name";
if ($result = mysqli_query($link,$sql))
	{
		while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
		$f         = $item['logo_m_s'];
		$fot       = $pathdir.$item['logo_m_s'];
		$fotL      = $pathdir.$item['logo_m'];			
			$new_item = [
			'id'   => $item["id"],
			'name' => $item["name"],
			'site' => $item["site"],
		   'count' => $item["count"],
	     'country' => $item["country"],
		    'logo' => $f,
		    'fot'  => $fot,
			'fotL' => $fotL,
			];
			array_push($data, $new_item);
		}
	}
echo json_encode($data);
?>