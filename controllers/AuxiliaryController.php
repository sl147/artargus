<?php
/**
* 
*/
class AuxiliaryController
{

	private function views2el($tab,$title) {
		$table = ['table' => $tab];
		$json  = json_encode($table);
		require_once ('views/auxiliary/list2El.php');
		return true;
	}

	public function actionRoles() {
		$t = self::views2el('friends_role',"Редагування ролей користувачів");
		return true;
	}

	public function actionTypesCalcukator() {
		$t = self::views2el('typeCalculator',"Редагування типів калькуляторів");
		return true;
	}
	public function actionJobs() {
		$t = self::views2el('job_status',"Редагування статусів виконання замовлення");
		return true;
	}

	public function actionPays() {
		$t = self::views2el('pay',"Редагування видів оплат");
		return true;
	}

	public function actionDelivery() {
		$t = self::views2el('deliveryFirm',"Редагування перевізників");
		return true; 
	}

	public function actionSpam() {
		$t = self::views2el('spamTab',"Редагування спаму");
		return true; 
	}

	public function actionErrTab() {
		$t = self::views2el('errTable',"Перегляд помилок");
		return true; 
	}

	public function actionMetaTags() {
		$title    = "Редагування метатегів";
		$getData  = new classGetData('meta_tags');
		$MTlist   = $getData->getDataFromTable();

		require_once ('views/auxiliary/viewMTags.php');
		unset($getData);
		return true; 
	}

	public function actionErrLook() {
		$title = "Додавання нового метатегу";
		$isUpload = false;
		if(isset($_POST['submit'])) {
			$getData  = new classGetData('ecatalog');
			$id       = $getData->getDataFromTableByIdMany($_POST['text'],'foto')['id'];
			$isUpload = true;
		}
		require_once ('views/auxiliary/errLook.php');
		return true; 
	}

	public function actionMetaTagsNew() {
		$title = "Додавання нового метатегу";
		if(isset($_POST['submit'])) {
			$url_name = Auxiliary::filterTXT('post', 'url_name');
			$title    = Auxiliary::filterTXT('post', 'title');
			$descr    = Auxiliary::filterTXT('post', 'descr');
			$keywords = Auxiliary::filterTXT('post', 'keywords');

			$result   = Auxiliary::saveMTags($url_name,$title,$descr,$keywords);
			$loc="Location:".$_SERVER['HTTP_REFERER'];
			header( $loc);
		}
		require_once ('views/auxiliary/addMTags.php');
		return true; 
	}

	public function actionMetaTagsOne($id) {
		if (intval($id)) {
			if(isset($_POST['submit'])) {
				$url_name = Auxiliary::filterTXT('post', 'url_name');
				$title    = Auxiliary::filterTXT('post', 'title');
				$descr    = Auxiliary::filterTXT('post', 'descr');
				$keywords = Auxiliary::filterTXT('post', 'keywords');

				$res      = Auxiliary::editMetaTags($id,$url_name,$title,$descr,$keywords);
				$loc="Location:".$_SERVER['HTTP_REFERER'];
				header( $loc);
			}
			$getData  = new classGetData('meta_tags');
			$MTOne   = $getData->getDataFromTableById($id);
			unset($getData);
			require_once ('views/auxiliary/changeOneMetaTags.php');
			return true;
		} 		
	}
}
?>