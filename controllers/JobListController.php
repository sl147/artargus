<?php
/**
* 
*/
class JobListController
{

	public function actionIndex($page = 1)	{
		$page     = Auxiliary::getIntval($page);
		$meta     = Auxiliary::getMeta("jobListl");
        $jobsList = Job::getJobs($page);		
		if(isset($_POST['submit'])) {
			$name   = Auxiliary::filterTXT('post', 'pan');
			$tel    = Auxiliary::filterTXT('post', 'tel');
			$email  = Auxiliary::filterEmail('post', 'email');
			$tema   = Auxiliary::filterTXT('post', 'tema');
			$idFA   = Auxiliary::filterTXT('post', 'idFAIn');
			$result = Job::setListAuthor($name,$tel,$email,$tema,$idFA);
			
			$sendCl  = new SendMail();
			$massage = $subject = "Новий лист надіслано автору";
			$send    = $sendCl->sendMail($subject,"sl147@meta.ua",$massage);
			
			if ($email) {
				$massage = "Ваше лист надіслано автору. Через деякий час автор Вам відповість";
				$subject = "Ваш лист надіслано автору";				
				$send    = $sendCl->sendMail($subject,$email,$massage);  
			}
		}
        $total      = Auxiliary::getTotal('photoalbum','1','id','id_FA',1);
        $pagination = Auxiliary::getPagination ($total,Job::SHOW_BY_DEFAULT, $page);
		require_once 'views/jobList/index.php';
		return true;
	}

	public function actionjobListOne($id)	{
		$id         = Auxiliary::getIntval($id);
		$meta       = Auxiliary::getMeta("jobListOne");
		$jobListOne = Job::getJobsOne($id);
		$getJobs    = new classGetData('photoalbum');
		$author     = $getJobs->getDataFromTableByIdMany($id,"id_FA");
		unset($getJobs);
			
		if(isset($_POST['submit'])) {
			$txt_com = Auxiliary::filterTXT('post', 'txt_com');
			$spamCl  = new ClassSpam();
			$spam    = $spamCl->spamCheck($txt_com);
	        if ($spam) {
				$subject = "Новий spam коментар до id=".$id;
				$massage = $txt_com;
	        }
	        else {
				$nik_com = Auxiliary::filterTXT('post', 'nik_com');
	        	$ip_com  = $_SERVER['REMOTE_ADDR'];
	        	$result  = Job::setComment($id,$nik_com,$txt_com,$ip_com);			        	
				$subject = "Новий right коментар до id=".$id." ip=".$ip_com;"Новий коментар https://artargus.in.ua/jobList/".$id;
				$massage = "Новий коментар https://artargus.in.ua/jobList/".$id."  до id=".$id." ip=".$ip_com."  з HTTP_REFERER ".$_SERVER['HTTP_REFERER']."\r\n"."  з REMOTE_ADDR ".$ip_com."\r\n";
			}
			$sendCl  = new SendMail(); 
			$send    = $sendCl->sendMail($subject,"sl147@ukr.net",$massage);				
	    }
		$comment = Job::getComment($id);			
		require_once ('views/jobList/viewOne.php');
		return true;
	}

	public function actionRequest()	{
	        $requestList = Request::getRequests();
			require_once 'views/jobList/request.php';
			return true;
	}

	public function actionJobListCommentEdit($page = 1) {
		$page = Auxiliary::getIntval($page);
		if(isset($_POST['submit'])) {
			$id       = Auxiliary::filterINT('post','id');
			$act      = Auxiliary::filterINT('post','active');
			$ts       = Auxiliary::filterINT('post','type_submit');
        	$getComCl = new classGetData('ComCl');
			$res      = ($ts == 0) ? $getComCl->activated($id,$act) : $getComCl->deleteDataFromTable($id);
			unset($getComCl);
		}
		$title      = "перегляд коментарів клієнтів";
		$comments   = Job::getAllComment($page);
        $total      = Auxiliary::getTotal('ComCl','1','id','id',1);
        $pagination = Auxiliary::getPagination ($total,Job::SHOW_BY_DEFAULT, $page);			
		require_once ('views/jobList/jobCommentEdit.php');
		return true;
	}
}
?>