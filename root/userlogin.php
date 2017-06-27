<?php
include('Utility.php');
include_once('admin/v1/class/Repository.php');

$objUtility=new Utility();


if (!empty($_POST))
{
	$email=$_POST["email"];
	$password=$_POST["password"];
	$strErr="";
	$objDBClass=new Repository();
	$connectionServer="ecommerce";
	$objDBClass->OpenConnection($connectionServer,$strErr);
	
	$sqluser="select id,name from Users where email='".$email."' and upassword='".$password."'";
	$arruser=$objDBClass->RetriveData($sqluser,$strErr);
	//echo($sqluser);
	$objDBClass->CloseConnection();
	//echo(count($arruserverification));
	if(count($arruser)==1)
	{
		//echo($arruserverification[0][0]);
		
		session_start();
		$objUtility->SetSession($arruser[0][0],$arruser[0][1]);
		echo("1");
	}
	else
	{
		echo("0");
	}
}
//else
//{
//	echo($_POST["email"].$_POST["password"]."get");
//}
?>