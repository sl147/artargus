<?

class Product
{
	const SHOW_BY_DEFAULT = 14;


	private static function db() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	public static function getFind($str) {
		$result = Db::getConnection() -> query("SELECT * FROM ecatalog WHERE name LIKE '%".$str."%' && countTov > 0");
		$i= 0;
		while ($row = $result->fetch()) {
			$findList[$i]['id']       = $row['id'];
			$findList[$i]['article']  = $row['article'];
			$findList[$i]['name']     = $row['name'];
			$findList[$i]['descr']    = $row['descr'];
			$findList[$i]['price']    = $row['price'];
			$findList[$i]['kod_t']    = $row['kod_t'];
			$findList[$i]['countTov'] = $row['countTov'];
			$findList[$i]['kodCol']   = $row['kodCol'];
			$findList[$i]['fotoF']    = $row['fotoS'];
			$nameGr                   = FT.$row['fullKod']."/";
		    $findList[$i]['fotoS']    = $nameGr.$row['fotoS'];
		    $findList[$i]['foto']     = $nameGr.$row['foto'];				
			$i++;
		}
		return (isset($findList)) ? $findList : false;			
	}

	public static function getCategoryList() 	{
		$result = Db::getConnection() -> query("SELECT id, name,kod_t FROM ecatalog WHERE parent='0' ORDER BY name");
		$i= 0;
		while ($row = $result->fetch()) {
			$categoriesList[$i]['id']    = $row['id'];
			$categoriesList[$i]['kod_t'] = $row['kod_t'];
			$categoriesList[$i]['name']  = $row['name'];
			$i++;
		}
		return (isset($categoriesList)) ? $categoriesList : false;
	}
	
	public static function getLatestGrups($gr) {
		if (intval($gr)) {
			$result = Db::getConnection() -> query("SELECT * FROM ecatalog WHERE parent='".$gr."' ORDER BY name");
			$i= 0;
			while ($row = $result->fetch()) {
				$GrupList[$i]['id']    = $row['id'];
				$GrupList[$i]['name']  = $row['name'];
				$GrupList[$i]['foto']  = $row['foto'];
				$GrupList[$i]['foto1'] = FT.$row['foto'];
				$GrupList[$i]['kod_t'] = $row['kod_t'];
				$i++;
			}
			return (isset($GrupList)) ? $GrupList : false;
		}
	}
	
	public static function getLatestProducts($id,$page = 1) {
			if ( (intval($id)) && intval($page) ) {
			$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
			$sql = "SELECT * FROM ecatalog WHERE parent=$id ORDER BY countTov DESC LIMIT ".self::SHOW_BY_DEFAULT." OFFSET $offset";
			$result = Db::getConnection() -> query($sql);
			$i= 0;
			while ($row = $result->fetch()) {
				$productList[$i]['id']    = $row['id'];
				$productList[$i]['name']  = $row['name'];
				$productList[$i]['kod_t'] = $row['kod_t'];
				$productList[$i]['foto']  = $row['foto'];
				$productList[$i]['fotoS']  = $row['fotoS'];
/*				$FK = "";
				$fCod = explode("/", $row['fullKod']);
				for ($x=2; $x<count($fCod); $x++) $FK .="/".$fCod[$x];
					echo $row['name']."  FK = $FK<br>";*/
				if ($row['fotoS']) $productList[$i]['fotoPath']  = "/FT".$row['fullKod']."/".$row['foto'];
				else $productList[$i]['fotoPath']  = "/image/noImage.jpg";
				//echo "/FT".$row['fullKod']."/".$row['foto']."    ".$productList[$i]['fotoPath']."<br>"; 
				$productList[$i]['countTov']  = $row['countTov'];
				$productList[$i]['fullKod']  = $row['fullKod'];
				$productList[$i]['article']  = $row['article'];
				$productList[$i]['descr'] = $row['descr'];
				$productList[$i]['price']  = $row['price'];
				$productList[$i]['kodCol']  = $row['kodCol'];

				$i++;
			}
			return (isset($productList)) ? $productList : false;
		}
	}

	public static function getProductById($id) 	{
		if (intval($id)) {
			$result = Db::getConnection() -> query("SELECT * FROM ecatalog WHERE id=".$id);
			$result -> setFetchMode(PDO::FETCH_ASSOC);
			$productItem = $result->fetch();
			$productItem['fotLIt'] = '/FT'.$productItem['fullKod']."/".$productItem['foto'];
			$productItem['fotLGr'] = '/FT/'.$productItem['foto'];
			if ($productItem['brand']) {
				$getEmaker = new classGetData('emaker');
				$brand     = $getEmaker->getDataFromTableById($productItem['brand']);
				$productItem['brandId']   = $brand['id'];
				$productItem['brandName'] = $brand['name'];
				unset($getEmaker);
			}
			else {
				$productItem['brandId']   = '';
				$productItem['brandName'] = '';				
			}
			if (!$productItem['descr']) {
				$parItem = self::getGroupById($productItem['parent']);
				$productItem['descrParent'] = $parItem['descr'];
				$productItem['fotLGr'] = $parItem['foto1'];
			}

			return (isset($productItem)) ? $productItem : false;
		}
	}

	public static function getGroupById($id) {
		if (intval($id)) {	
			$result = Db::getConnection() -> query("SELECT * FROM ecatalog WHERE kod_t=".$id);
			$result -> setFetchMode(PDO::FETCH_ASSOC);
			$groupItem = $result->fetch();
			$groupItem['foto1']     = FT.$groupItem['foto'];
			$groupItem['brandId']   = "";
			$groupItem['brandName'] = "";
			if ($groupItem['brand']) {
				$getEmaker = new classGetData('emaker');
				$brand     = $getEmaker->getDataFromTableById($groupItem['brand']);
				$groupItem['brandId']   = $brand['id'];
				$groupItem['brandName'] = $brand['name'];
				unset($getEmaker);
			}
			return (isset($groupItem)) ? $groupItem : false;
		}
	}

	public static function delFoto($id) {
		return Db::getConnection() -> query("UPDATE ecatalog SET foto='', fotoS='' WHERE id=$id");
	}

	public static function editPhoto($id,$article,$name,$price,$kod_t,$descr,$foto,$fotoS,$brand) {
		$sql = "UPDATE ecatalog SET article=:article,name=:name,price=:price,kod_t=:kod_t,descr=:descr,foto=:foto,fotoS=:fotoS,brand=:brand WHERE id=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':article', $article, PDO::PARAM_STR);
		$result -> bindParam(':name',    $name,    PDO::PARAM_STR);
		$result -> bindParam(':price',   $price,   PDO::PARAM_STR);
		$result -> bindParam(':kod_t',   $kod_t,   PDO::PARAM_STR);
		$result -> bindParam(':descr',   $descr,   PDO::PARAM_STR);
		$result -> bindParam(':foto',    $foto,    PDO::PARAM_STR);
		$result -> bindParam(':fotoS',   $fotoS,   PDO::PARAM_STR);
		$result -> bindParam(':brand',   $brand,   PDO::PARAM_STR);		
		return $result -> execute();			
	}
						   
	public static function edit($id,$article,$name,$price,$kod_t,$descr,$kodCol,$brand) {
		$sql = "UPDATE ecatalog SET article=:article,name=:name,price=:price,kod_t=:kod_t,descr=:descr,kodCol=:kodCol,brand=:brand WHERE id=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':article', $article, PDO::PARAM_STR);
		$result -> bindParam(':name',    $name,    PDO::PARAM_STR);
		$result -> bindParam(':price',   $price,   PDO::PARAM_STR);
		$result -> bindParam(':kod_t',   $kod_t,   PDO::PARAM_STR);
		$result -> bindParam(':descr',   $descr,   PDO::PARAM_STR);
		$result -> bindParam(':kodCol',  $kodCol,  PDO::PARAM_STR);
		$result -> bindParam(':brand',   $brand,   PDO::PARAM_STR);		
		return $result -> execute();			
	}	

	public static function saveUploadGroups($kod_t,$name,$parent,$fullKod) {
		$ThisGroup = 1;
		$result = Db::getConnection() -> query("SELECT COUNT(*) FROM ecatalog WHERE kod_t='".$kod_t."'");

		if ($result->fetchColumn()) {
			$sql = "UPDATE ecatalog SET name=:name,parent=:parent,ThisGroup=:ThisGroup,fullKod=:fullKod WHERE kod_t=$kod_t";
			$result = $db -> prepare($sql);
			$result -> bindParam(':name',     $name,      PDO::PARAM_STR);
			$result -> bindParam(':parent',   $parent,    PDO::PARAM_STR);
			$result -> bindParam(':ThisGroup',$ThisGroup, PDO::PARAM_STR);
			$result -> bindParam(':fullKod',  $fullKod,   PDO::PARAM_STR);
		
			return $result -> execute();
		}
		else {
			$sql = "INSERT INTO ecatalog (kod_t,name,parent,ThisGroup,fullKod)
			 VALUES(:kod_t,:name,:parent,:ThisGroup,:fullKod)";
			$result = $db -> prepare($sql);
			$result -> bindParam(':kod_t',     $kod_t,     PDO::PARAM_STR);
			$result -> bindParam(':name',      $name,      PDO::PARAM_STR);
			$result -> bindParam(':parent',    $parent,    PDO::PARAM_STR);
			$result -> bindParam(':ThisGroup', $ThisGroup, PDO::PARAM_STR);
			$result -> bindParam(':fullKod',   $fullKod,   PDO::PARAM_STR);
			
			return $result -> execute();
		}   
	}

	public static function saveUploadItems($kod_t,$name,$price,$article,$countTov,$parent,$fullKod) {
		$ThisGroup = 0;
		$result = Db::getConnection() -> query("SELECT COUNT(*) FROM ecatalog WHERE kod_t='".$kod_t."'");

		if ($result->fetchColumn()) {
			$sql = "UPDATE ecatalog SET name=:name,price=:price,article=:article,countTov=:countTov,parent=:parent,ThisGroup=:ThisGroup,fullKod=:fullKod WHERE kod_t=$kod_t";
			$result = $db -> prepare($sql);
			$result -> bindParam(':name',      $name,      PDO::PARAM_STR);
			$result -> bindParam(':price',     $price,     PDO::PARAM_STR);
			$result -> bindParam(':article',   $article,   PDO::PARAM_STR);
			$result -> bindParam(':countTov',  $countTov,  PDO::PARAM_STR);
			$result -> bindParam(':parent',    $parent,    PDO::PARAM_STR);		
			$result -> bindParam(':ThisGroup', $ThisGroup, PDO::PARAM_STR);
			$result -> bindParam(':fullKod',   $fullKod,   PDO::PARAM_STR);
		
			return $result -> execute();
		}
		else {
			$sql = "INSERT INTO ecatalog (kod_t,name,price,article,countTov,parent,ThisGroup,fullKod)
			 VALUES(:kod_t,:name,:price,:article,:countTov,:parent,:ThisGroup,:fullKod)";
			$result = $db -> prepare($sql);
			$result -> bindParam(':kod_t',     $kod_t,     PDO::PARAM_STR);
			$result -> bindParam(':name',      $name,      PDO::PARAM_STR);
			$result -> bindParam(':price',     $price,     PDO::PARAM_STR);
			$result -> bindParam(':article',   $article,   PDO::PARAM_STR);
			$result -> bindParam(':countTov',  $countTov,  PDO::PARAM_STR);
			$result -> bindParam(':parent',    $parent,    PDO::PARAM_STR);		
			$result -> bindParam(':ThisGroup', $ThisGroup, PDO::PARAM_STR);
			$result -> bindParam(':fullKod',   $fullKod,   PDO::PARAM_STR);
			
			return $result -> execute();
		}   
	}

	public static function saveAddGroup($name,$parent) {
		$db  = self::db();
		$sql = "INSERT INTO ecatalog (name,parent)
		 VALUES(:name, :parent)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':name',   $name,   PDO::PARAM_STR);
		$result -> bindParam(':parent', $parent, PDO::PARAM_STR);
		return $result -> execute();
	}

	public static function getGroupByIdCashe($id) {
/*$memcache = new Memcache;

$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");

		echo phpinfo();
		$memcache = memcache_connect('localhost', 11211);
if ($memcache) {
    $memcache->set("str_key", "String to store in memcached");
    $memcache->set("num_key", 123);

    $object = new StdClass;
    $object->attribute = 'test';
    $memcache->set("obj_key", $object);

    $array = Array('assoc'=>123, 345, 567);
    $memcache->set("arr_key", $array);

    var_dump($memcache->get('str_key'));
    var_dump($memcache->get('num_key'));
    var_dump($memcache->get('obj_key'));
}
else {
    echo "Connection to memcached failed";
}		
		if ( !$list = memcache_get('groupData') ) {
			$list = self::getGroupById($id);
			//$sql = 'SELECT * FROM users WHERE last_visit > UNIX_TIMESTAMP() - 60*10';
			//$q = mysql_query($sql);
			//while ($row = mysql_fetch_assoc($q)) $list[] = $row;
			memcache_set('groupData', $list, 60*60);
		}

		return $list;*/
	}
}
?>