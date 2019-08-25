<?php
/**
* 
*/
class Auxiliary
{

	private static function db() {
		$params = include ('../config/db_params.php');
		$dsn    = "mysql:host={$params['host']};dbname={$params['dbname']}";		
		$db     = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return $db;
	}

	public static function getIntval ($i) {
		$i = intval($i);
        return ($i>0) ? $i : 1;
	}

	public static function isId($table, $id, $detail,$idName) {
		$id   = self::getIntval($id);
		echo "id=$id";
		for ($i=$id; $i < 1000; $i++) { 
			echo "i=$i";
			$c = self::getTotal ($table, $i, $detail, $idName,3);
			if ($c>0) return $i;
		}
		return false;
	}

	public static function getTotal ($table, $id, $detail, $idName,$var) {
		$totCount   = new Count($table,$id,$detail,$idName);
		switch ($var) {
		 	case 1:
		 		return $totCount->get();
		 		break;
		 	case 2:
		 		return $totCount->getNewOrder();
		 		break;
		 	case 3:
		 		return $totCount->getId();
		 		break;
		 	default:
		 		break;
		 } 
		
	}

	public static function getPagination ($total,$show, $page) {		
		return new Pagination($total, $page, $show, 'page-');
	}

	public static function getDate($dt) {
		$tyre = strpos($dt, "/");
		$day  = substr($dt, 0, $tyre);
		$dm   = substr($dt,$tyre+1);
		$tyre = strpos($dm, "/");
		$mn   = substr($dm, 0, $tyre);
		$year = substr($dm,$tyre+1);
		$dt   = $year."-".$mn."-".$day;
		$d1   = strtotime($dt);
		$date = date("Y-m-d h:i:s", $d1);
		return $date;	
	}

	public static function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => "",  'ы' => 'y',   'ъ' => "",
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
 
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ' ' => '_',   'і' => 'i',  'І' => 'I',
    );
    return strtr($string, $converter);		
	}

	public static function editMetaTags($id,$url_name,$title,$descr,$keywords) {
		$sql = "UPDATE meta_tags SET url_name=:url_name,title=:title,descr=:descr,keywords=:keywords WHERE id=$id";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':url_name', $url_name, PDO::PARAM_STR);
		$result -> bindParam(':title',   $title,     PDO::PARAM_STR);
		$result -> bindParam(':descr',   $descr,     PDO::PARAM_STR);
		$result -> bindParam(':keywords',$keywords,  PDO::PARAM_STR);	
		return $result -> execute();			
	}
	
	public static function saveMTags ($url_name,$title,$descr,$keywords) 
	{
		$sql = "INSERT INTO meta_tags (url_name,title,descr,keywords)
		 VALUES(:url_name,:title,:descr,:keywords)";
		$result = Db::getConnection() -> prepare($sql);
		$result -> bindParam(':url_name', $url_name, PDO::PARAM_STR);
		$result -> bindParam(':title',    $title,    PDO::PARAM_STR);
		$result -> bindParam(':descr',    $descr,    PDO::PARAM_STR);
		$result -> bindParam(':keywords', $keywords, PDO::PARAM_STR);
		
		return $result -> execute();			
	}

	public static function getContent($alias) {
		$db = Db::getConnection();
		$result = $db -> query("SELECT * FROM art_sef WHERE alias='".$alias."'");
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		$item = $result->fetch();
		$vars = parse_url($item["linksef"]);
		$content=$vars["path"];
		return $content;		
	}

	public static function replaceSef($content) {
		$db = Db::getConnection();
		
		$regex = "[(<a[^>]*href\s*=\s*[\"'])([^'\"]*)([\"'][^>]*>\s*.*?\s*)]i";
		preg_match_all($regex, $content, $matches);
		for ($i=0; $i < count($matches[2]); $i++) {
			//echo "match - ".$matches[2][$i]."<br>";
			$temp = str_replace("&amp;", "&", $matches[2][$i]);
			$result = $db -> query("SELECT * FROM art_sef WHERE linksef='".$matches[2][$i]."'");
			$result -> setFetchMode(PDO::FETCH_ASSOC);
			$item = $result->fetch();
			$content = str_replace($matches[2][$i], $item["alias"], $content);

		}
		//echo "content - ".$content."<br>";
		return $content;
	}

	public static function filterEmail($type, $field) {
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_SANITIZE_EMAIL);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL); 
			break;

			default:
			break;
		}
		return $output;
	}
        
	public static function filterURL($type, $field) {
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_URL);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_URL); 
			break;

			default:
			break;
		}
		return $output;
	}

	public static function filterINT($type, $field) {
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_INT);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_INT); 
			break;

			default:
			break;
		}
		return $output;
	}

	public static function filterTXT($type, $field) {
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 
			break;

			default:
			break;
		}

		return $output;
	}
        
	private static function saveImg($fileIn, $fileOut, $sizeImg) {
        $image  = new SimpleImage();
		$size   = getimagesize ($fileIn);
        $width  = $size[0];
        $height = $size[1];

        while ($width > $sizeImg or $height > $sizeImg)
        {
            $width  = $width  * 0.8;
            $height = $height * 0.8;
        }
        $image->load($fileIn);
        $image->resize(round($width),round($height));
        $image->saveWebp($fileOut,$size[2]); 
	}

	public static function makeDir($path) {
		$dir = true;
		if (!file_exists($path)) {
			$dir = (mkdir($path,0755, true)) ? true : false;
		}
		return $dir;		
	}

    public static function savePhoto($nameFile,$pathdir) {
        $res      = self::makeDir($pathdir);
        $fns      = $pathdir.$nameFile;
        $fnSmal   = $pathdir."s".'_'.$nameFile;	
        echo "fns:$fns<br>";		
        move_uploaded_file ($_FILES['file'] ['tmp_name'],$fns);
		$res = self::saveImg($fns, $fns, 600);
		$res = self::saveImg($fns, $fnSmal, 150);
    } 

	public static function protect($email) {
		$result = "";
    	for ($i = 0; $i < strlen($email); $i++) {
    		$result .= "&#".ord(substr($email, $i, 1)).";";
    	}
    	return $result;
	}

	public static function imgEmail ($name,$domain,$zone) {
		//name=sl147&domain=meta&zone=ua
		$txB=255;
		$txG=118;
		$txR=72;

		// Отправляем заголовки картинки  
		header('Content-type: image/jpeg');

/*		// Получаем имя, домен и зону для адреса электронной почты
		$name 	= ( !isSet( $_GET['name'] ) or empty( $_GET['name'] ) ) ? 'noname' : $_GET['name'];
		$domain	= ( !isSet( $_GET['domain'] ) or empty( $_GET['domain'] ) ) ? 'noserver' : $_GET['domain'];
		$zone	= ( !isSet( $_GET['zone'] ) or empty( $_GET['zone'] ) ) ? 'no' : $_GET['zone'];*/

		// Получаем цвета (красный, зелёный, голубой) для фона. Значение для цветов должно быть в пределах 0...255.
		$bgR		= ( !isSet( $_GET['bgr'] ) or empty( $_GET['bgr'] ) ) ? 255 : ( ( (int)$_GET['bgr'] < 0 or (int)$_GET['bgr'] > 255 ) ? 255 : (int)$_GET['bgr'] );
		$bgG		= ( !isSet( $_GET['bgg'] ) or empty( $_GET['bgg'] ) ) ? 255 : ( ( (int)$_GET['bgg'] < 0 or (int)$_GET['bgg'] > 255 ) ? 255 : (int)$_GET['bgg'] );
		$bgB		= ( !isSet( $_GET['bgb'] ) or empty( $_GET['bgb'] ) ) ? 255 : ( ( (int)$_GET['bgb'] < 0 or (int)$_GET['bgb'] > 255 ) ? 255 : (int)$_GET['bgb'] );

/*		// Получаем цвета (красный, зелёный, голубой) для текста. Значение для цветов должно быть в пределах 0...255.
		$txR		= ( !isSet( $_GET['txr'] ) or empty( $_GET['txr'] ) ) ? 0 : ( ( (int)$_GET['txr'] < 0 or (int)$_GET['txr'] > 255 ) ? 0 : (int)$_GET['txr'] );
		$txG		= ( !isSet( $_GET['txg'] ) or empty( $_GET['txg'] ) ) ? 0 : ( ( (int)$_GET['txg'] < 0 or (int)$_GET['txg'] > 255 ) ? 0 : (int)$_GET['txg'] );
		$txB		= ( !isSet( $_GET['txb'] ) or empty( $_GET['txb'] ) ) ? 0 : ( ( (int)$_GET['txb'] < 0 or (int)$_GET['txb'] > 255 ) ? 0 : (int)$_GET['txb'] );*/

		// Склеиваем адрес электронной почты
		$str	= $name.'@'.$domain.'.'.$zone;

		// Вычисляем длинну адреса
		$width = strlen( $str );
		// Устанавливаем высоту картинки
		$height= 18;

		// Создаём картинку 
		$img	= imagecreate( $width*12, $height );
		// Устанавливаем цвет фона
		$bg 	= imagecolorallocate( $img, $bgR, $bgG, $bgB );
		// Получаем цвет шрифта
		$textColor = imagecolorallocate( $img, $txR, $txG, $txB );


		// Устанавливаем размер текста
		$size 	= 8;
		//  Устанавливаем отступ от левого края картинки
		$xText  = 8;
		// Устанавливает отступ от нижнего края картинки
		$yText	= -1;

		// Рисуем на картинке текст
		imagestring( $img, $size, $xText, $yText, $str, $textColor); 
		// Выводим картинку
		imagejpeg( $img, null, 85 );
		// Очищаем память
		imagedestroy( $img );		
	}

	public static function getProcesslist() {
		$db     = Db::getConnection();
		$result = $db -> query("SELECT * FROM INFORMATION_SCHEMA.PROCESSLIST WHERE DB = 'sl1'
		AND COMMAND <> 'Sleep'");
		while ($row = $result->fetch()) {
			$list[] = $row;
		}
		return $list;
	}

	public static function delFile($filename, $pathdir) {
	    return (is_file($pathdir.$filename)) ? unlink($pathdir.$filename) : false;
	}

	public static function addErr($name,$tab) {
		$result = Db::getConnection()-> prepare("INSERT INTO ".$tab." (name) VALUES(:name)");
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		return $result -> execute();
	}

	public static function getmeta($url_name) {
		$meta      = [];
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany($url_name,"url_name");
		unset($getmeta);
		if ($meta) {
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = substr($meta['descr'],0,200);
			$meta['title']    = substr($meta['title'],0,75);
		}
		return $meta;
	}

}
?>