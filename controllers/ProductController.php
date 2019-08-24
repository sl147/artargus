<?php


class ProductController
{

	public function actionFindProduct($str) {
		$findList = Product::getFind($str);

		require_once ('views/product/findList.php');
		return true;
	}

	private function makeMeta($metaName, $titleName, $itemList) {
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany($metaName,"url_name");
		unset($getmeta);
		if ($meta) {
			$meta['descr']     = $meta['descr']." ".$titleName.' з доставкою в Дрогобичі';
			$meta['keywords'] .= ', ';
			$meta['title']     = $titleName.' '.$meta['title'];
			$meta['follow']    = $meta['follow'];
			foreach ($itemList as $item) {
				$meta['keywords'] .= $item['name'].', ';
			}
		}
		return $meta;
	}
	public function actionCategory($id) {
		$id = Auxiliary::getIntval($id);
		$productsList = Product::getLatestProducts($id);
		$groupData    = Product::getGroupById($id);
		$meta         = self::makeMeta("category", $groupData['name'], $productsList);
		require_once ('views/product/viewCatalog.php');
		return true;
	}

	public function actionViewgroup($id,$page = 1) {
		$id     = Auxiliary::getIntval($id);
		$page   = Auxiliary::getIntval($page);
		$basket = Basket::basketInit();
		$cart   = 0;
		if(isset($_POST['submit'])) {
			$cart     = 1;
			$idb      = intval(trim(strip_tags(Auxiliary::filterINT('post', 'idb'))));
			$quantity = intval(trim(strip_tags(Auxiliary::filterINT('post', 'count'))));
			$res      = Basket::add2basket($idb,$quantity,$basket);
		}

		$productsList = Product::getLatestProducts($id,$page);
		$groupData    = Product::getGroupById($id);
		$meta         = self::makeMeta("group", $groupData['name'], $productsList);			
		$brandData    = false;
		if ($groupData['brand']) {
			$getEmaker = new classGetData('emaker');
			$brandData = $getEmaker->getDataFromTableById($groupData['brand']);
			unset($getEmaker);
		}
        $total      = Auxiliary::getTotal('ecatalog',$id,'id','parent',3);
        $pagination = Auxiliary::getPagination ($total,Product::SHOW_BY_DEFAULT, $page);	
		require_once ('views/product/viewGroupList.php');
		return true;
	}

	public function actionViewTable($id,$page = 1)	{
		$id     = Auxiliary::getIntval($id);
		$page   = Auxiliary::getIntval($page);	
		$basket = Basket::basketInit();
		$cart   = 0;
		if(isset($_POST['submit'])) {
			$cart     = 1;
			$idb      = intval(trim(strip_tags(Auxiliary::filterINT('post', 'idb'))));
			$quantity = intval(trim(strip_tags(Auxiliary::filterINT('post', 'count'))));
			$res      = Basket::add2basket($idb,$quantity,$basket);
		}

		$productsList = Product::getLatestProducts($id,$page);
		$groupData    = Product::getGroupById($id);
		$title        = $groupData['name'];
		$meta         = self::makeMeta("group", $groupData['name'], $productsList);
		$brandData    = false;
		if ($groupData['brand']) {
			$getEmaker = new classGetData('emaker');
			$brandData = $getEmaker->getDataFromTableById($groupData['brand']);
			unset($getEmaker);
		}

        $total      = Auxiliary::getTotal('ecatalog',$id,'id','parent',3);
        $pagination = Auxiliary::getPagination ($total,Product::SHOW_BY_DEFAULT, $page);				
		require_once ('views/product/viewGroupTable.php');
		return true;
	}

	public function actionIndexProducts() {
		require_once ('views/product/viewEdit.php');
		return true; 
	}

	public function actionIndex() {
		require_once ('views/product/viewGroup.php');
		return true; 
	}

	public function actionUploadItems() {
		$isUpload = false;
		$notFile  = false;
		if(isset($_POST['submit'])) {
			$fname  = $_FILES['file']['name'];
			if (!empty($fname)) {
				move_uploaded_file ($_FILES['file'] ['tmp_name'],$fname);
				$lines = file($fname);
			    foreach ($lines as $line_num => $line) {
					$str= explode( ';', $line );
					$kod_t  = intval($str[0]);
					$nameE  = addslashes($str[1]);
					$price  = $str[2];
					$article  = $str[3];
					$count  = $str[4];
					$nameF  = trim($str[5]);
					$fullKod= explode( '/', $nameF);
					$i=1;
			        $FK="";
			        $parent=0;			
					for ($i = 1; $i < count($fullKod); $i++) {
						
						$gr=intval(trim($fullKod[$i]));
						if ($gr==$kod_t) {
							$parent=$fullKod[$i-1];
						}
						else {
							$FK=$FK."/".$gr;				
						}
					}
					$pathdir="../FT".$FK;
					$res = Auxiliary::makeDir($pathdir);
					$res = Product::saveUploadItems($kod_t,$nameE,$price,$article,$count,$parent,$FK);
					$id  = Product::getGroupById($kod_t);
					$isUpload = true;
				}
			}
			else {
				$notFile = true;
			}
		}
		require_once ('views/product/UploadItems.php');
		return true;
	}

	public function actionUploadGroups() {
		$isUpload = false;
		if(isset($_POST['submit']))
		{
			$fname  = $_FILES['file']['name'];
			move_uploaded_file ($_FILES['file'] ['tmp_name'],$fname);
			$lines = file($fname);
            foreach ($lines as $line_num => $line) {
				$str= explode( ';', $line );
				$kod_t  = 0+$str[0];
				$nameE  = addslashes($str[1]);
				$nameF  = $str[2]; 
				$fullKod= explode( '/', $nameF);
				$gr1    = 0+$fullKod[1];
				$parent = $gr1;
				if ($gr1==$kod_t) $parent=0;
	            $FK="";
	            for ($i = 0; $i < count($fullKod); $i++) {			
					$gr=trim($fullKod[$i]);
					$FK=$FK."/".$gr;
					$pathdir="../FT".$FK;			   
					$res = Auxiliary::makeDir($pathdir);
				}
				$res = Product::saveUploadGroups($kod_t,$nameE,$parent,$FK);
				$id  = Product::getGroupById($kod_t);
			}
			$isUpload = true;
		}
		require_once ('views/product/UploadGroups.php');
		return true;		
	}

	public function actionView($id)	{
		$id     = Auxiliary::getIntval($id);
		$basket = Basket::basketInit();
		if(isset($_POST['submit'])) {
			$idb      = intval(trim(strip_tags(Auxiliary::filterINT('post', 'idb'))));
			$quantity = intval(trim(strip_tags(Auxiliary::filterINT('post', 'count'))));
			Basket::add2basket($idb,$quantity,$basket);
			$location = $_SERVER['HTTP_REFERER'];
			header ("Location: $location");
		}
		$productOne = Product::getProductById(Auxiliary::getIntval($id));
		$nameGr     = "../FT".$productOne['fullKod']."/";
		$fotoS      = $nameGr.$productOne['fotoS'];
		$foto       = $nameGr.$productOne['foto'];
		$meta['title']    = $productOne['name'];
		$meta['keywords'] = 'товари для творчості';
		$meta['descr']    = 'купити '.$productOne['name'].' в Дрогобичі';
		require_once ('views/product/view.php');
		return true;
	}

	public function actionDataEdProduct($id) {
		$id       = Auxiliary::getIntval($id);
		$item     = Product::getProductById($id);
		$getBrand = new classGetData('emaker');
		$brandGr  = $getBrand->getDataFromTableOrder('name','');
        unset($getBrand);
		$kod_t    = $item["kod_t"];

		if(isset($_POST['submit'])) {			
			$id        = Auxiliary::filterINT('post', 'id');
			$article   = Auxiliary::filterTXT('post','article');
			$name      = addslashes(Auxiliary::filterTXT('post', 'name'));
			$price     = Auxiliary::filterTXT('post','price');
			$descr     = Auxiliary::filterTXT('post','descr');
			$FotoDel   = 0;
			$makeDel   = 1;
			$kodCol    = Auxiliary::filterTXT('post','kodCol');
			$fullKod   = Auxiliary::filterTXT('post','fullKod');	
			$brand     = Auxiliary::filterTXT('post','brand');
			$ThisGroup = Auxiliary::filterTXT('post','ThisGroup');
			$pathdir = ($ThisGroup) ? dirname(__DIR__)."/FT/" : dirname(__DIR__)."/FT".$fullKod."/";

			if (!empty($_FILES['file'] ['tmp_name'])) {
				$nameFile  = Auxiliary::rus2translit($_FILES['file']['name']);
				$res       = Auxiliary::makeDir($pathdir);
				$res       = Auxiliary::savePhoto($nameFile,$pathdir);
				$webPName  = explode('.', $nameFile)[0].'.webp';
				$fotoS     = 's_'.$webPName;
				$result    = Product::editPhoto($id,$article,$name,$price,$kod_t,$descr,$webPName,$fotoS,$brand);
			}
			else {
				if (isset($_POST['FotoDel'])) {
					$filename = Product::getProductById($id)['foto'];
					$res      = Auxiliary::delFile($filename, $pathdir);
					$filename = Product::getProductById($id)['fotoS'];
					$res      = Auxiliary::delFile($filename, $pathdir);
					$result   = Product::delFoto($id);
				}
				else {
					$result = Product::edit($id,$article,$name,$price,$kod_t,$descr,$kodCol,$brand);
				}
			}			
			header ("Location: /editProducts/".$id);
		}		
		require_once ('views/product/editProduct.php');
		return true;		
	}
}
?>