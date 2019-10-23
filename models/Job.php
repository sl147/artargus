<?php

/**
* 
*/
class Job
{

	const SHOW_BY_DEFAULT = 10;	

	public static function getJobs($page) {
		$page = Auxiliary::getIntval($page);
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
		$result = Db::select("SELECT * FROM photoalbum ORDER BY date_ord DESC LIMIT ".self::SHOW_BY_DEFAULT." OFFSET ".$offset);
		$i      = 0;
		while ($row = $result->fetch()) {
			$id_FA                = $row['id_FA'];
			$JobList[$i]['id']    = $id_FA;
			$JobList[$i]['name']  = $row['name_FA'];
			$JobList[$i]['msgs']  = $row['msgs_FA'];
			$JobList[$i]['log']   = $row['log_FA'];
			$JobList[$i]['logId'] = $row['log_FA'].'+'.$id_FA;
			$JobList[$i]['foto']  = false;
			$sql1 = "SELECT * FROM photoInAlbum  WHERE id_album = $id_FA LIMIT 1";
			$result1 = Db::getConnection() -> query($sql1);
			while ($item1 = $result1->fetch()) {
				$JobList[$i]['foto'] = $item1["fotoName"];
				$JobList[$i]['fns']  ='/album/'.$id_FA.'/'.$item1["fotoName"];
			}
			$i++;
		}
		return $JobList;	
	}

	public static function getJobsOne($id) {
		$id   = Auxiliary::getIntval($id);
		$res  = Db::select("SELECT * FROM photoInAlbum WHERE id_album='".$id."'");
		$i    = 0;
		$path = '/album/'.$id.'/';
		while ($row = $res->fetch()) {
			$jobItem[]          = $row;
			$jobItem[$i]['fn']  = $path.$row['fotoName'];
			$jobItem[$i]['fns'] = $path.$row['fotoNameS'];
			$i++;
		}
		return (isset($jobItem)) ? $jobItem : false;
	}

	public static function getComment($id) {
		$id = Auxiliary::getIntval($id);
		$result  = Db::select("SELECT * FROM ComCl WHERE id_cl='".$id."' && active=1");
		while ($row = $result->fetch()) {
			$comItem[] = $row;
		}
		return (isset($comItem)) ? $comItem : false;
	}

	public static function getAllComment($page = 1) {
		$page = Auxiliary::getIntval($page);	
		$offset   = ($page - 1) * self::SHOW_BY_DEFAULT;
		$sql      = "SELECT Comment.id, Comment.id_cl, Comment.txt_com, Comment.nik_com, Comment.ip_com, Comment.email_com, Comment.active, type.log_FA FROM ComCl AS Comment LEFT JOIN photoalbum AS type ON Comment.id_cl = type.id_FA ORDER BY Comment.id DESC LIMIT ".self::SHOW_BY_DEFAULT." OFFSET $offset";
		$result = Db::getConnection() -> query($sql);
		while ($row = $result->fetch()) {
			$comments[]   = $row;
		}
		return (isset($comments)) ? $comments : false;
	}

	public static function setComment ($id_cl,$nik_com,$txt_com,$ip_com)	{
		$sql = "INSERT INTO ComCl (id_cl,nik_com,txt_com,ip_com)
		 VALUES(:id_cl,:nik_com,:txt_com,:ip_com)";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':id_cl'  , $id_cl, PDO::PARAM_STR);
		$result -> bindParam(':nik_com', $nik_com, PDO::PARAM_STR);
		$result -> bindParam(':txt_com', $txt_com, PDO::PARAM_STR);
		$result -> bindParam(':ip_com' , $ip_com, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function setListAuthor($name,$tel,$email,$tema,$idFA)	{
		$sql = "INSERT INTO contact_Cl (idFA,name,tel,email,tema)
		 VALUES(:idFA,:name,:tel,:email,:tema)";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':idFA',  $idFA,  PDO::PARAM_STR);
		$result -> bindParam(':name',  $name,  PDO::PARAM_STR);
		$result -> bindParam(':tel',   $tel,   PDO::PARAM_STR);
		$result -> bindParam(':email', $email, PDO::PARAM_STR);
		$result -> bindParam(':tema',  $tema,  PDO::PARAM_STR);
		
		return $result -> execute();			
	}
}
?>