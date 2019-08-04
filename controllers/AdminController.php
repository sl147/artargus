<?php

/**
 * Description of AdminControllers
 *
 * @author DOM
 */
class AdminController {

    public function actionIndex($page = 1) {
    	$orderList  = Order::getAllOrderInJob($page);
    	$title      = "Адмін головна";
        $totCount   = new Count('eOrders','1','id','id_ord');
        $total      = $totCount->getNewOrder();
        $pagination = new Pagination($total, $page, Order::SHOW_BY_DEFAULT, 'page-');
        require_once ('views/admin/index.php');
        return true;    
    }

    public function actionParsForm() {
        require_once ('views/admin/parsForm.php');
        return true;    
    }

    public function actionParsHTML5() {
        require_once ('views/admin/parsHTML5.php');
        return true;    
    }

    public function actionParsHTML52() {
        require_once ('views/admin/parsHTML51.php');
        return true;    
    }

    public function actionParsHTML53() {
        require_once ('views/admin/parsHTML53.php');
        return true;    
    }

    public function actionProcesslist() {
        $list = Auxiliary::getProcesslist();
        require_once ('views/admin/processList.php');
        return true;    
    }
}