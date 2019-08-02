<?php

class User
{

	public static function chekLoginExist ($login) 
	{
		$result = Db::getConnection() -> prepare("SELECT COUNT(*) FROM friends_MVC WHERE user_login= :login");
		$result -> bindParam(':login', $login, PDO::PARAM_STR);
		$result -> execute();
		return ($result->fetchColumn()) ? true : false;
	}

	public static function chekLogin ($login) {
		return (strlen($login) >=3) ? true : false;
	}

	public static function chekPassword ($password) {
		return (strlen($password) >=5) ? true : false;
	}

	public static function chekEmail ($email) {
		return (filter_var($email,FILTER_VALIDATE_EMAIL)) ? true : false;
	}

	public static function chekConfirmPassword ($password, $confirmPassword) {
		return ($password === $confirmPassword) ? true : false;
	}

	public static function register ($login,$password,$name,$surname,$email,$phone) 
	{
		$password = md5(md5(trim($password)));
		$sql = "INSERT INTO friends_MVC (user_login,user_password,name,surname,email)
		 VALUES(:login,:password,:name,:surname,:email)";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':login', $login, PDO::PARAM_STR);
		$result -> bindParam(':password', $password, PDO::PARAM_STR);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':surname', $surname, PDO::PARAM_STR);
		$result -> bindParam(':email', $email, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function edit ($id,$name,$surname,$email,$phone)	{
		$sql = "UPDATE friends_MVC SET name=:name, surname=:surname,email=:email,phone=:phone WHERE id=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':surname', $surname, PDO::PARAM_STR);
		$result -> bindParam(':email', $email, PDO::PARAM_STR);
		$result -> bindParam(':phone', $phone, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function chekUserData ($login,$password) {
		$password = md5(md5(trim($password)));
		$sql      = "SELECT * FROM friends_MVC  WHERE user_login = :login AND user_password = :password";		
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':login', $login, PDO::PARAM_STR);
		$result -> bindParam(':password', $password, PDO::PARAM_STR);
		$result -> execute();
		$user = $result-> fetch();
		return ($user) ? $user['id'] : false;
	}
        
	public static function auth ($userId) {
		$_SESSION['user'] = $userId;
	}

	public static function userId () {
		return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
	}

	public static function chekLogged () {
		return (isset($_SESSION['user'])) ? $_SESSION['user'] : header ('Location: /user/register');
	}

	public static function isGuest () {
		return (isset($_SESSION['user'])) ? true : false;
	}

	public static function getUserById ($id) {
		$getData = new classGetData('friends_MVC');
		$list    = $getData->getDataFromTableById($id);
		unset($getData);		
		return $list;		
	}

	public static function isUser ($id) {
		return self::getUserById ($id)['admin'] == 1 ? true : false;
	}

	public static function isAdmin ($id) {
		return self::getUserById ($id)['admin'] == 2 ? true : false;
	}

	public static function isManager ($id) {
		return self::getUserById ($id)['admin'] == 3 ? true : false;
	}

	public static function getClients($Cl) {
		$ClientList = [];
		$sql = "SELECT * FROM friends_MVC WHERE admin = $Cl ORDER BY id DESC ";
		$result = Db::select($sql);
		$i= 0;
		$getClients = new classGetData('friends_role');
		$getManager = new classGetData('friends_MVC');
		$getDeliver = new classGetData('deliveryFirm');
		while ($row = $result->fetch()) {
			$ClientList[]                  = $row;
			$ClientList[$i]['delivery']    = $getDeliver->getDataFromTableById($row['delivery'])['name'];
			$ClientList[$i]['adminName']   = $getClients->getDataFromTableById($row['admin'])['name'];
			$managerName                   = $getManager->getDataFromTableById($row['manager']);
			$ClientList[$i]['login']       = $row['user_login'];
			$ClientList[$i]['name']        = $row['name']." ".$row['surname'];		
			$ClientList[$i]['managerName'] = $managerName['name']." ".$managerName['surname'];
			$i++;
		}
		unset($getClients);
		unset($getManager);
		unset($getDeliver);
		return $ClientList;		
	}

	public static function getAllClients() {
		$ClientList = [];
		$sql        = "SELECT * FROM friends_MVC WHERE admin = 1 ORDER BY name ";
		$result     = Db::select($sql);
		$i= 1;
		while ($row = $result->fetch()) {
			$ClientList[$i]['id']   = $row['id'];
			$ClientList[$i]['name'] = $row['name']." ".$row['surname'];
			$i++;
		}
		return $ClientList;		
	}

	public static function changeManager ($id,$idManager) {
		$sql    = "UPDATE friends_MVC SET manager=:idManager WHERE id=$id";
		$result = DB::selectBind ($sql, ':idManager', $idManager);
		
		return $result -> execute();			
	}	

	public static function changeRole ($id,$idRole) {
		$sql = "UPDATE friends_MVC SET admin=:idRole WHERE id=$id";
		$result = DB::selectBind ($sql, ':idRole', $idRole);
		
		return $result;			
	}
}	
?>