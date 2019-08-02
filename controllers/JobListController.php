<?php
/**
* 
*/
class JobListController
{

	public function actionIndex($page = 1)	{
		$getmeta   = new classGetData('meta_tags');
		$meta      = $getmeta->getDataFromTableByIdMany("jobListl","url_name");
		unset($getmeta);

        $jobsList = Job::getJobs($page);
        $totCount = new Count('photoalbum','1','id','id_FA');
        $total    = $totCount->get();
        
		if ($meta) {
			$meta['keywords'] = substr($meta['keywords'],0,245);
			$meta['descr']    = substr($meta['descr'],0,200);
			$meta['title']    = substr($meta['title'],0,75);
			$meta['follow']   = $meta['follow'];			
		}		
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

		$pagination = new Pagination($total, $page, Job::SHOW_BY_DEFAULT, 'page-');
		require_once 'views/jobList/index.php';
		return true;
	}

	public function actionjobListOne($id)	{
		if (intval($id)) {
			$getmeta   = new classGetData('meta_tags');
			$meta      = $getmeta->getDataFromTableByIdMany("jobListOne","url_name");
			unset($getmeta);

			$jobListOne = Job::getJobsOne($id);
			$getJobs    = new classGetData('photoalbum');
			$author     = $getJobs->getDataFromTableByIdMany($id,"id_FA");
			unset($getJobs);

			if ($meta) {
				$meta['keywords'] = substr($meta['keywords'],0,245);
				$meta['descr']    = substr($meta['descr']." ".trim(strip_tags($author['name_FA'])),0,200);
				$meta['title']    = substr($meta['title'].' '.$author['log_FA']." ".trim(strip_tags($author['name_FA'])),0,75);
				$meta['follow']   = $meta['follow'];
			}			
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
	}

	public function actionRequest()	{
	        $requestList = Request::getRequests();
			require_once 'views/jobList/request.php';
			return true;
	}

	public function actionJobListCommentEdit($page = 1) {
		if (intval($page)) {
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
			$classCount = new Count('CommentCalculators');
			$total      = $classCount->get();
			$pagination = new Pagination($total, $page, Job::SHOW_BY_DEFAULT, 'page-');
			require_once ('views/jobList/jobCommentEdit.php');
			return true;
		}
	}
}
?>