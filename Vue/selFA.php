<?php
require_once ('../classes/classGetData.php');

$id      = intval($_GET['id']);
$MK      = new classGetData('photoInAlbum');
$pr      = $MK->getDataFromTableByIdManyRowVue ($id,'id_album');

$pathdir = '/album/'.$id.'/';
$data    = [];

foreach ($pr as $item) {
	$item['foto']  = $pathdir.$item["fotoName"];
	$item['fotos'] = $pathdir.$item["fotoNameS"];
	array_push($data, $item);
}
echo json_encode($data);
?>