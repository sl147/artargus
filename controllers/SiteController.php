<?php

class SiteController
{	
	public function actionIndex() {
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany("category","url_name");
		unset($getmeta);		
		$gr             = 362;
		$latestproducts = Product::getLatestGrups($gr);
		$nameGr         = Product::getGroupById($gr);
		$title          = $nameGr['name'];
		if ($meta) {
			$meta['descr']     = $meta['descr']." з доставкою в Дрогобичі";
			$meta['keywords'] .= ', ';
			$meta['title']     = $meta['title'];
			$meta['follow']    = $meta['follow'];
			foreach ($latestproducts as $item) {
				$meta['keywords'] .= $item['name'].', ';
			}
		}		
		require_once ('views/site/index.php');
		return true;
	}
}	
?>