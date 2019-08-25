<?php
require_once ('../classes/classGetData.php');

$page = intval($_GET['page']);
$show = intval($_GET['show']);
$MK   = new classGetData('photoalbum');
$FT   = new classGetData('photoInAlbum');
$pr   = $MK->getDataFromTableOrderPageVue($show,$page,'id_FA');
$data    = [];
foreach ($pr as $item) {
	$fot     = $FT->getDataFromTableByIdManyRowVue ($item["id_FA"],'id_album');

	foreach ($fot as $itemFT) {
		$item['fotos'] = $itemFT["fotoNameS"];
		break;
	}
	array_push($data, $item);
}
unset($MK);
unset($FT);
echo json_encode($data);
?>