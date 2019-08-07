<?php
require_once ('../classes/classGetData.php');
$MK   = new classGetData('photoalbum');
$FT   = new classGetData('photoInAlbum');
$pr   = $MK->getDataFromTableOrderVue('id_FA');
$data    = [];
foreach ($pr as $item) {
	$fot     = $FT->getDataFromTableByIdManyRowVue ($item["id_FA"],'id_album');
	$pathdir = '/album/'.$item["id_FA"].'/';

	foreach ($fot as $itemFT) {
		$fotos = $pathdir.$itemFT["fotoNameS"];
	}

	$new_item = array(
		'id'    => $item["id_FA"],
		'name'  => $item["name_FA"],
		'msgs'  => $item["msgs_FA"],
		'logo'  => $item["log_FA"],
		'fotos' => $fotos,
	);
	array_push($data, $new_item);
}
unset($MK);
unset($FT);
echo json_encode($data);
?>