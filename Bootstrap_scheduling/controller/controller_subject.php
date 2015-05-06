<?php 
include("../model/model_subject.php");
session_start();
$allSubj = new Subject();
$viewSubj =  $allSubj->selectSubject();
$serchSubj = $allSubj->searchSubject($_GET);

if(isset($_POST['search_subject']))
{

	header('location:controller_subject.php?s='. $_POST['search1']. '&r='. $_POST['search2'] );

}
include("../view/view_subject.html");
 ?>