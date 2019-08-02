<?
require_once "../dblinc.php";
global $link;
$id_foto   = $_GET['id'];
$subscribe = $_GET['subscribe'];
$data = [];
$sql = "UPDATE photoInAlbum SET subscribe='".$subscribe."' WHERE id_foto='".$id_foto."'";  

$result = mysqli_query($link,$sql);
$new_item = array(
			'id' => $id_foto,
			'subscribe' => $subscribe
			);
			array_push($data, $new_item);
echo json_encode($data);
?>