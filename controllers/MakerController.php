<?php

/**
* для роботи з виробниками
*/
class MakerController
{
    public function actionIndex() {
        require_once ('views/maker/viewMaker.php');
        return true; 
    }

    public function actionview($id) {
        if (intval($id)) {
            $getEmaker = new classGetData('emaker');
            $brandData = $getEmaker->getDataFromTableById($id);
            unset($getEmaker);
            require_once ('views/maker/view.php');
            return true;
        }
    }

    private function saveSubmit($id) {
        if (!empty($_FILES['file']['tmp_name'])) {echo "11is photo";}
        else {echo "22no photo";}
                

        $name    = Auxiliary::filterTXT('post', 'name');
        $country = Auxiliary::filterTXT('post', 'country');
        $descr   = Auxiliary::filterTXT('post', 'descr');
        $site    = Auxiliary::filterURL('post', 'site');

        if (!empty($_FILES['file']['tmp_name'])) {
            echo "33is photo";
            $fotoL    = Auxiliary::rus2translit($_FILES['file']['name']);
            $pathdir  = "../FT/logo/";
            
            //$fotoS    = "s".'_'.$fotoL;
            $webPName  = explode('.', $fotoL)[0].'.webp';
            $fotoS     = 's_'.$webPName; 
            $res      = Auxiliary::savePhoto($webPName,$pathdir);           
            $result   = Maker::editFoto($id,$country,$name,$descr,$site,$webPName,$fotoS);
        }
        else {
         echo "44no photo";
            if (isset($_POST['FotoDel'])) {
                $FotoDel = filter_input(INPUT_POST,$_POST['FotoDel'],FILTER_VALIDATE_BOOLEAN);   
                $result  = ($FotoDel)  
                   ? Maker::editFoto($id,$country,$name,$descr,$site,"","") 
                   : Maker::edit($id,$country,$name,$descr,$site);
            }
            else {
                $result = Maker::edit($id,$country,$name,$descr,$site);
            }
        }              
        header ("Location: /editMaker/");
    }
        
    public function actionDataEdMaker($id) {
        if (intval($id)) {
            $getEmaker = new classGetData('emaker');
            $makerItem = $getEmaker->getDataFromTableById($id);
            unset($getEmaker);
            if (!empty($makerItem["logo_m"])) {
                $pathdir  = "../FT/logo/";
                $makerItem['logo']   = $pathdir.$makerItem['logo_m_s'];
                $makerItem['logo_m'] = $pathdir.$makerItem['logo_m'];
            }
            if(isset($_POST['submit'])) {
                //$res = self::saveSubmit($id);
                //if (!empty($_FILES['file']['tmp_name'])) {echo "11is photo";}
                //else {echo "11no photo";}
                        

                $name    = Auxiliary::filterTXT('post', 'name');
                $country = Auxiliary::filterTXT('post', 'country');
                $descr   = Auxiliary::filterTXT('post', 'descr');
                $site    = Auxiliary::filterURL('post', 'site');

                if (!empty($_FILES['file']['tmp_name'])) {
                    echo "is photo";
                    $fotoL    = Auxiliary::rus2translit($_FILES['file']['name']);
                    $pathdir  = "../FT/logo/";
                    
                    //$fotoS    = "s".'_'.$fotoL;
                    $webPName  = explode('.', $fotoL)[0].'.webp';
                    $fotoS     = 's_'.$webPName; 
                    $res      = Auxiliary::savePhoto($webPName,$pathdir);           
                    $result   = Maker::editFoto($id,$country,$name,$descr,$site,$webPName,$fotoS);
                }
                else {
                 echo "no photo";
                    if (isset($_POST['FotoDel'])) {
                        $FotoDel = filter_input(INPUT_POST,$_POST['FotoDel'],FILTER_VALIDATE_BOOLEAN);   
                        $result  = ($FotoDel)  
                           ? Maker::editFoto($id,$country,$name,$descr,$site,"","") 
                           : Maker::edit($id,$country,$name,$descr,$site);
                    }
                    else {
                        $result = Maker::edit($id,$country,$name,$descr,$site);
                    }
                }              
                header ("Location: /editMaker/");
            }
            require_once ('views/maker/editMaker.php');
            return true;
        }	
    }	
}