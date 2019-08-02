<?

class ContaktModel
{

	public static function chekNik ($nik_com) {
		return (empty($nik_com)) ? false : true
	}

	public static function chekEmail ($email) {
		return (filter_var($email,FILTER_VALIDATE_EMAIL)) ? true : false;
	}

	public static function saveComent ($nik_com,$ip_com,$email,$txt_com) {
		$db = Db::getConnection();
		$sql = "INSERT INTO ComCl (nik_com,email_com,ip_com,txt_com)
		 VALUES(:nik_com,:email,:ip_com,:txt_com)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':nik_com', $nik_com, PDO::PARAM_STR);
		$result -> bindParam(':ip_com', $ip_com, PDO::PARAM_STR);
		$result -> bindParam(':txt_com', $txt_com, PDO::PARAM_STR);
		$result -> bindParam(':email', $email, PDO::PARAM_STR);
		
		return $result -> execute();			
	}
}
?>