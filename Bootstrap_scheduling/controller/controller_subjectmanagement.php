<?php 
include("../model/model_subject.php");
$subject = new Subject();
$subj = $subject->selectSubject();
$serchSubj = $subject->searchSubject($_GET);
if(isset($_POST['search_subject']))
{
	header('location:controller_subjectmanagement.php?s='. $_POST['search1']. '&r='. $_POST['search2']);
}


if(isset($_POST['addsubj']))
{
	if($subject->authSubj($_POST))
	{
		header("location:controller_subjectmanagement.php?subj_auth=1");
	}else{
		$total_u = $_POST['lec_units'] + $_POST['lab_units'];
		$total_h = ($_POST['lab_units'] * 3) + $_POST['lec_units'];
		$subject->addSubject($_POST,$total_u,$total_h);
		header("location:controller_subjectmanagement.php?success=1");
	}
	
}
if(isset($_POST['delete_subj']))
{
	$subject->deleteSubj($_GET);
	header("location:controller_subjectmanagement.php?deleted=1");
}
if(isset($_POST['update']))
{
	$total_u = $_POST['e_lec_units'] + $_POST['e_lab_units'];
	$total_h = ($_POST['e_lab_units'] * 3) + $_POST['e_lec_units'];
	$subject->editSubj($_POST,$total_u,$total_h);
	header("location:controller_subjectmanagement.php?save=1");
}
include("../view/view_subjectmanagement.html");
 ?>