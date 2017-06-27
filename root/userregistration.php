<?php
include('Utility.php');
include_once('admin/v1/class/Repository.php');

$objUtility=new Utility();


if (!empty($_POST))
{
	$email=$_POST["email"];
	$name=$_POST["name"];
	$password=$_POST["password"];
	$repassword=$_POST["repassword"];
	$address=$_POST["address"];
	$phone=$_POST["phone"];
	$strerr="";
	
	$strErr="";
	$objDBClass=new Repository();
	$connectionServer="ecommerce";
	$objDBClass->OpenConnection($connectionServer,$strErr);
	
	$sqluser="select id,name from Users where email='".$email."' and upassword='".$password."'";
	$arruserverification=$objDBClass->RetriveData($sqluser,$strErr);
	//echo($sqluser);
	
	
	if($arruserverification[0][0]!="Nothing")
	{
		
		echo $arruserverification[0][0];
	}
	else
	{
		$sqlregister="insert into Users(name,email,upassword,mobile,address) values('".$name."','".$email."','".$password."','".$phone."','".$address."')";
		//echo($sqlregister);
		$objDBClass->ExecuteQuery($sqlregister,$strerr);
		$sqluser="select id,name from Users where email='".$email."' and upassword='".$password."'";
		$arruser=$objDBClass->RetriveData($sqluser,$strErr);
		$objDBClass->CloseConnection();
		session_start();
		$objUtility->SetSession($arruser[0][0],$arruser[0][1]);
		echo("1");
	}
	$objDBClass->CloseConnection();
}
?>