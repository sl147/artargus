<?
require_once ('../classes/classGetData.php');

$id_foto   = $_GET['id'];
$subscribe = $_GET['subscribe'];

$MK        = new classGetData('photoInAlbum');
$pr        = $MK->edit2el($subscribe,$id_foto,'id_foto','subscribe');
?>