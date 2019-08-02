<?
/**
* 
*/
class FA
{

	public static function saveFA($name,$msgs,$log) {
		$sql = "INSERT INTO photoalbum (name_FA,msgs_FA,log_FA)
				VALUES(:name,:msgs,:log)";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':msgs', $msgs, PDO::PARAM_STR);
		$result -> bindParam(':log',  $log,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function savePhoto($id,$subscribe,$foto,$fotoS) {
		$sql = "INSERT INTO photoInAlbum (id_album,subscribe,fotoName,fotoNameS)
		 		VALUES(:id,:subscribe,:foto,:fotoS)";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':id',        $id,        PDO::PARAM_STR);
		$result -> bindParam(':subscribe', $subscribe, PDO::PARAM_STR);
		$result -> bindParam(':foto',      $foto,      PDO::PARAM_STR);
		$result -> bindParam(':fotoS',     $fotoS,     PDO::PARAM_STR);

		return $result -> execute();		
	}

	public static function updateFA ($id,$name,$descr,$author) {
		$sql = "UPDATE photoalbum SET name_FA=:name, msgs_FA=:descr,log_FA=:author WHERE id_FA=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':name',   $name,   PDO::PARAM_STR);
		$result -> bindParam(':descr',  $descr,  PDO::PARAM_STR);
		$result -> bindParam(':author', $author, PDO::PARAM_STR);
		
		return $result -> execute();			
	}
}
?>