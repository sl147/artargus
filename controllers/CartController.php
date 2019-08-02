<?php

class CartController
{

	public function actionDel($id) {
		Basket::delBasket($id);
		header ("Location: ".$_SERVER['HTTP_REFERER']);
	}
		
    public function actionIndex() {
    	$title      = "кошик";
        $basketList = Basket::getBasket();
        $basketSum  = Basket::getSumBasket();

        require_once 'views/cart/index.php';
        return true;		
    }
public function actionOrderform() {
		$title   = "оформлення замовлення";
		$orderId = Basket::getBasketId();
		$name    = false;
		$surname = false;
		$phone   = false;
		$adres   = false;
		$deliver = false;
		$email   = false;
		$sklad   = false;
		$pay     = false;
		$note    = false;
		$userId  = false;

		$getData     = new classGetData('deliveryFirm');
		$deliverList = $getData->getDataFromTable();
		unset($getData);

		$getData     = new classGetData('pay');
		$payList = $getData->getDataFromTable();
		unset($getData);
		
		if (User::isGuest ()) {
			$userId  = User::userId ();
			$user    = User::getUserById ($userId);
			$name    = $user['name'];
			$surname = $user['surname'];
			$phone   = $user['phone'];
			$adres   = $user['adres'];
			$email   = $user['email'];
			$getData     = new classGetData('deliveryFirm');
			$deliverName = $getData->getDataFromTableById($user['delivery'])['name'];
			unset($getData);						
		}

		if(isset($_POST['submit'])) {
			$name     = Auxiliary::filterTXT('post', 'name');
			$surname  = Auxiliary::filterTXT('post', 'surname');
			$phone    = Auxiliary::filterTXT('post', 'phone');
			$adres    = Auxiliary::filterTXT('post', 'adres');
			$deliver  = Auxiliary::filterTXT('post', 'deliver');
			$email    = Auxiliary::filterEmail('post', 'email');
			$sklad    = Auxiliary::filterTXT('post', 'sklad');
			$pay      = Auxiliary::filterTXT('post', 'pay');
			$note     = Auxiliary::filterTXT('post', 'note');
			$resOrder = Order::saveOrder($orderId,$deliver,$adres,
				$name,$surname,$phone,$email,$sklad,$pay,$note,$userId);
			$resTab  = Order::saveOrderTab();
			if ($resOrder && $resTab) {
				$bas     = Basket::basketDel();
				$sendCl  = new SendMail();
				$massage = "Нове замовлення https://artargus.in.ua/back/edForm?page=1&orderid=".$orderId;
				$subject = "Нове замовлення https://artargus.in.ua ".$orderId;	
				$send    = $sendCl->sendMail($subject,"sl147@meta.ua",$massage);				
				if ($email) {
					$massage = "Ваше Замовлення прийнято.Можна переглянути перейшовши за посиланням https://artargus.in.ua/orderform/".$orderId;
					$subject = "Замовлення на сайті https://artargus.in.ua прийнято ";
					$send    = $sendCl->sendMail($subject,$email,$massage);
				}			
			}
			header ("Location: /");
		}

		require_once 'views/cart/orderform.php';
		return true;			
	}

}
?>