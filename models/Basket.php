<?php

class Basket {
    /**
     * 
     * @var Ссылок навигации на страницу
     * 
     */
	public static function basketInit() {
		$basket = [];
		if (!isset($_COOKIE["basket"])) {
			$basket = array("orderid"=>uniqid());
			Basket::saveBasket($basket);
		}
		else {
			$basket = unserialize($_COOKIE["basket"]);
		}
		return $basket;
	}

    /**
     * к-ть товарів в кошику
     * 
     * $return число товарів
     */
	public static function getCount() {
		if (isset($_COOKIE["basket"])) {
		$basket = unserialize($_COOKIE["basket"]);
		return count($basket)-1;
		}
	}
    /**
     * записує в кошик
     * 
     * 
     */
	public static function saveBasket($basket) {
		$basket = serialize($basket);
		setcookie("basket",$basket,time()+72000,"/");
	}

    /**
     * видаляє х кошику
     *@param number $id <p>id товару</p>
     *@return none nothing
     */
	public static function delBasket($id) {
		$basket = self::basketInit();
		unset($basket[$id]);
		self::saveBasket($basket);
	}
    /**
     * додає до кошику
     * 
     * 
     */
	public static function add2basket($id,$q,$basket) {
			$basket = [];
			if (!isset($_COOKIE["basket"])) {
			$basket = array("orderid"=>uniqid());
			$bas    = Basket::saveBasket($basket);
			}
			else {
				$basket = unserialize($_COOKIE["basket"]);
			}
		$basket[$id] = $q;
		self::saveBasket($basket);
	}

	public static function getBasketId() {
		if (isset($_COOKIE["basket"])) {
			$basket = unserialize($_COOKIE["basket"]);
			return $basket['orderid']; 
		}
	}

	public static function getBasket() {
		$basketList = [];
		if (isset($_COOKIE["basket"])) {
			$basket  = unserialize($_COOKIE["basket"]);
			$orderid = $basket['orderid'];
			$goods   = array_keys($basket);
			array_shift ($goods);
			if (count($goods)) {
				$ids    = implode(",",$goods);
				$sql    = "SELECT * FROM ecatalog WHERE id IN ($ids)";
				$result = Db::select($sql);
				$i      = 0;
				while ($row = $result->fetch()) {
					$basketList[] = $row;
					$nameGr = "FT".$row['fullKod']."/";
					$id = $row['id'];
					$basketList[$i]['fotoS']   = $nameGr.$row['fotoS'];
					$basketList[$i]['foto']    = $nameGr.$row['foto'];
					$basketList[$i]['q']       = $basket[$id];
					$basketList[$i]['fotoF']   = $row['fotoS'];
					$basketList[$i]['i']       = $i+1;
					$basketList[$i]['suma']    = $row['price'] * $basket[$id];
					$i++;
				}
				return $basketList;
			}
		}
	}

	public static function getSumBasket() {
		$basketSum = self::getBasket();	 
		$suma = 0;
		$qq = 0;
		if ($basketSum) {
			foreach ($basketSum as $item) {
				$qq   +=$item['q'];
				$suma +=$item['price'] * $item['q'];
			}
			$basketSum['q']    = $qq;
			$basketSum['suma'] = $suma;
			return $basketSum;
		}
	}

	public static function basketDel() {
		setcookie('basket','',time()-3600,"/");
	}
}
?>