<?php
/**
 * 
 */
class LaminatController
{

	public function actionIndex() {
		$meta['title']    = "Калькулятор будівельний";
		$meta['keywords'] = "";
		$meta['descr']    = "Калькулятор розрахунку вартості будівництва";
		$type             = 1;
		$mass             = "калькулятор автоцивілки";
		require_once ('views/laminat/index.php');
		return true;
	}

	public function actionPotolok() {
		require_once ('views/laminat/potolok.php');
		return true;
	}

	public function actionLampot() {
		require_once ('views/laminat/lampot.php');
		return true;
	}
}
?>