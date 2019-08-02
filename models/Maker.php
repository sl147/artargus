<?php
/**
* Клас роботи з виробниками
*/
class Maker
{

	public static function edit ($id,$country,$name,$descr,$site) {
		$sql = "UPDATE emaker SET name=:name, country=:country,descr=:descr,site=:site WHERE id=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':name',    $name,    PDO::PARAM_STR);
		$result -> bindParam(':country', $country, PDO::PARAM_STR);
		$result -> bindParam(':descr',   $descr,   PDO::PARAM_STR);
		$result -> bindParam(':site',    $site,    PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function editFoto ($id,$country,$name,$descr,$site,$fotoL,$fotoS) {
		$sql = "UPDATE emaker SET name=:name, country=:country,descr=:descr,site=:site,logo_m=:fotoL,logo_m_s=:fotoS WHERE id=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':country', $country, PDO::PARAM_STR);
		$result -> bindParam(':descr', $descr, PDO::PARAM_STR);
		$result -> bindParam(':site', $site, PDO::PARAM_STR);
		$result -> bindParam(':fotoL', $fotoL, PDO::PARAM_STR);
		$result -> bindParam(':fotoS', $fotoS, PDO::PARAM_STR);
		
		return $result -> execute();			
	}
}
?>