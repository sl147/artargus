<?

class Db
{
	
	public static function getConnection()
	{
		$paramsPath = 'config/db_params.php';
		$params = include ($paramsPath);

		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		//$db = new PDO($dsn,$params['user'],$params['password']);
		$db = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		
		return $db;
	}

	public static function select($sql) {
		$db = self::getConnection();
		return $db -> query($sql);
	}

	public static function selectBind ($sql, $atrName, $atr) {
		$db     = self::getConnection();
		$result = $db -> prepare($sql);
		$result -> bindParam($atrName, $atr, PDO::PARAM_STR);
		return $result -> execute();
	}
}
?>