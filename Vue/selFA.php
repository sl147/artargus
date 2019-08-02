<?php
require_once ('../classes/classGetData.php');

$id      = intval($_GET['id']);
$MK      = new classGetData('photoInAlbum');
$pr      = $MK->getDataFromTableByIdManyRowVue ($id,'id_album');

$pathdir = '/album/'.$id.'/';
$data    = [];

foreach ($pr as $item) {		
	$new_item  = array(
		'id'   => $item["id_foto"],
   'subscribe' => $item["subscribe"],
		'foto' => $pathdir.$item["fotoName"],
	   'fotos' => $pathdir.$item["fotoNameS"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);
?>