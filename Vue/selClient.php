<?php
require_once "../dblinc.php";
global $link;
$data = [];

$new_item = array(
'id'   => 0,
'name' => 'всі клієнти',
);
array_push($data, $new_item);

$sql = "SELECT * FROM friends_MVC WHERE admin='1' ORDER BY name";
if ($result = mysqli_query($link,$sql))
	{	
	while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{			
		$new_item = array(
		'id'   => $item["id"],
		'name' => $item['name']." ".$item['surname'],
		);
		array_push($data, $new_item);
	}
}
echo json_encode($data);	
?>