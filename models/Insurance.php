<?php
/**
 * 
 */
class Insurance
{
	
	const SHOWCOMMENT_BY_DEFAULT = 10;

	private static function db() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	public static function updateVueTZ($id, $type, $name, $k1) {
		if (intval($id)) {
			$db     = self::db();
			$sql    = "UPDATE in_type SET type=:type, name=:name, k1=:k1 WHERE id=$id";
			$result = $db -> prepare($sql);
			$result -> bindParam(':type', $type, PDO::PARAM_STR);
			$result -> bindParam(':name', $name, PDO::PARAM_STR);
			$result -> bindParam(':k1',   $k1,   PDO::PARAM_STR);
			
			return $result -> execute();
		}			
	}

	public static function updateVueReestr ($id, $name, $k2) {
		if (intval($id)) {
			$db     = self::db();
			$sql    = "UPDATE in_chek SET name=:name, k2=:k2 WHERE id=$id";
			$result = $db -> prepare($sql);
			$result -> bindParam(':name', $name, PDO::PARAM_STR);
			$result -> bindParam(':k2',   $k2,   PDO::PARAM_STR);
			
			return $result -> execute();
		}		
	}	

	public static function addVueTZ ($type, $name, $k1) {
		$db     = self::db();
		$sql    = "INSERT INTO in_type (type, name, k1)
		 		   VALUES(:type,:name,:k1)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':type', $type, PDO::PARAM_STR);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':k1',   $k1,   PDO::PARAM_STR);
		
		return $result -> execute();;			
	}

	public static function addVueReestr ($name, $k2) {
		$db     = self::db();
		$sql    = "INSERT INTO in_chek (name,k2)
		 		   VALUES(:name,:k2)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':k2',   $k2,   PDO::PARAM_STR);
		
		return $result -> execute();;			
	}

	public static function getCalculatorType($type = 1) {
		if (intval($type)) {	
			$db  = Db::getConnection();
			$sql = "SELECT * FROM typeCalculator WHERE id=$type";
			$res = $db  -> query($sql);
			$row = $res->fetch();
			return $row['name'];		
		}
	}

	public static function getCalculatorAll() {
			$sql      = "SELECT * FROM typeCalculator";
			$result   = Db::getConnection() -> query($sql);
			while ($row = $result->fetch()) {
				$calcType[]   = $row;
			}
			return (isset($calcType)) ? $calcType : false;
	}
	public static function getComment($type = 1) {
		if ($type) {	
			$sql     = "SELECT * FROM CommentCalculators WHERE (type=$type) && (active=1)";
			$result  = Db::getConnection() -> query($sql);
			while ($row = $result->fetch()) {
				$comItem[]   = $row;
			}
			return (isset($comItem)) ? $comItem : false;
		}
	}

	public static function getComeToPlugin($page) {	
		$offset   = ($page - 1) * self::SHOWCOMMENT_BY_DEFAULT;
		$sql      = "SELECT * FROM ComeToPlugin ORDER BY id DESC LIMIT ".self::SHOWCOMMENT_BY_DEFAULT." OFFSET $offset";
		$result   =  Db::getConnection() -> query($sql);
		while ($row = $result->fetch()) {
			$list[]   = $row;
		}
		return (isset($list)) ? $list : false;
	}

	public static function getAllComment($page = 1) {
		if (intval($page)) {	
			$offset   = ($page - 1) * self::SHOWCOMMENT_BY_DEFAULT;
			$sql      = "SELECT Comment.id, Comment.type, Comment.text, Comment.nik, Comment.ip, Comment.active, type.name FROM CommentCalculators AS Comment LEFT JOIN typeCalculator AS type ON Comment.type = type.id ORDER BY Comment.id DESC LIMIT ".self::SHOWCOMMENT_BY_DEFAULT." OFFSET $offset";
			$result = Db::getConnection() -> query($sql);
			while ($row = $result->fetch()) {
				$comments[]   = $row;
			}
			return (isset($comments)) ? $comments : false;
		}
	}

	public static function saveComment ($type,$nik,$text,$ip)	{
		$db     = Db::getConnection();
		$sql    = "INSERT INTO CommentCalculators (type,nik,text,ip)
		           VALUES(:type,:nik,:text,:ip)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':type', $type, PDO::PARAM_STR);
		$result -> bindParam(':nik' , $nik,  PDO::PARAM_STR);
		$result -> bindParam(':text', $text, PDO::PARAM_STR);
		$result -> bindParam(':ip'  , $ip,   PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function saveComeToPlugin($ref,$ip)	{
		$db     = Db::getConnection();
		$sql    = "INSERT INTO ComeToPlugin (ref,ip) VALUES(:ref,:ip)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':ref', $ref, PDO::PARAM_STR);
		$result -> bindParam(':ip' , $ip,  PDO::PARAM_STR);
		
		return $result -> execute();			
	}
}
?>