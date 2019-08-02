<?php

/**
 * Description of AdminControllers
 *
 * @author DOM
 */
class AdminController {
    public function actionIndex() {
    	$orderList = Order::getAllOrderInJob();
    	$title = "Адмін головна";

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