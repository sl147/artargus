<?

/**
* 
*/
class FAController
{

	public function actionFaChange($page = 1) {
		$page = Auxiliary::getIntval($page);
		$data = array(
		  'page' => $page,
		  'show' => FA::SHOW_BY_DEFAULT
		);
		$json       = json_encode($data);
        $total      = Auxiliary::getTotal('photoalbum','1','id','id_FA',1);
        $pagination = Auxiliary::getPagination ($total,FA::SHOW_BY_DEFAULT, $page);	        
		require_once ('views/fa/viewChange.php');
		return true;
	}

	public function actionChangeOne($id) {
		$id = Auxiliary::getIntval($id);
		$data = array(
		  'id'   => $id,
		);
		$json = json_encode($data);
		if(isset($_POST['submit'])) {
			$name   = Auxiliary::filterTXT('post', 'name_FA');
			$descr  = Auxiliary::filterTXT('post', 'descr');
			$author = Auxiliary::filterTXT('post', 'author');
			$res    = FA::updateFA($id,$name,$descr,$author);
			$loc="Location:".$_SERVER['HTTP_REFERER'];
			header( $loc);
		}
		$getData = new classGetData('photoalbum');
		$FAOne   = $getData->getDataFromTableByIdMany($id,'id_FA');
		unset($getData);	
		require_once ('views/fa/changeOne.php');
		return true;
	}

	public function actionIndex() {
		if(isset($_POST['submit'])) {
		    $name    = Auxiliary::filterTXT('post', 'name_FA');
		    $msgs    = Auxiliary::filterTXT('post', 'msgs_FA');
		    $author  = Auxiliary::filterTXT('post', 'author_FA');
			$res     = FA::saveFA($name,$msgs,$author);
			$getData = new classGetData('photoalbum');
			$idAlbum = $getData->getDataFromTableByIdMany($name,'name_FA');
			unset($getData);
		    $pathdir = dirname(__DIR__)."/album/".$idAlbum['id_FA'];
		    if (Auxiliary::makeDir($pathdir)) {
		      header("Location: /faPhoto/".$idAlbum['id_FA']); exit();
		    } 
		    else {
                print "no dir".$pathdir." read";
            }
		 }
		require_once ('views/fa/view.php');
		return true; 
	}

	
	public function actionEdPhoto($id) {
        $id = Auxiliary::getIntval($id);            
		if(isset($_POST['submit'])) {
			$subscribe = Auxiliary::filterTXT('post', 'subscribe');
			if (!empty($_FILES['file'] ['tmp_name'])) {
				$pathdir  = dirname(__DIR__)."/album/".$id."/";
				$fotoL    = Auxiliary::rus2translit($_FILES['file']['name']);					
				$webPName = explode('.', $fotoL)[0].'.webp';
				$fotoS    = 's_'.$webPName;
				$res      = Auxiliary::savePhoto($webPName,$pathdir);
				$res      = FA::savePhoto($id,$subscribe,$webPName,$fotoS);
			}
		}
		require_once ('views/fa/uplPhoto.php');
		return true;
	}
}
?>