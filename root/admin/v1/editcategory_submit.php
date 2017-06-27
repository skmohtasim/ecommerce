<?php 
session_start();
?>
<?php
include_once('class/Repository.php');
include_once('Utility.php');
$strErr="";
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$connectionServer="ecommerce";
$objDBClass->OpenConnection($connectionServer,$strErr);

if (!empty($_POST))
{
	$name=$_POST["categoryname"];
	$description=$_POST["description"];
	$id=$_POST["hid"];
	
	$sqlupdate="update  Categories set categoryname='".$name."',description='".$description."' where categoryid=".$id;
	
	$objDBClass->ExecuteQuery($sqlupdate,$strErr);
	//echo($strErr).
	//die();
	if($strErr=="")
	{
		
		if($strErr=="")
		{
			echo("<script type='text/javascript'>alert('successfullyupdated');</script>"); 
			echo("<script>location.href = 'http://dealon.live/admin/v1/home.php';</script>");

		}
		else
		{
			echo($strErr);
		}
	}
	else
	{
		echo($strErr);
	}
}
?>