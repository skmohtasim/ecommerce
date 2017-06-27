<?php 
session_start();
?>
<?php
$productid=$_GET["id"];
if($productid=="" || $productid==NULL)
{
	die();
}
$strErr="";
include_once('class/Repository.php');
include_once('Utility.php');
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$sqlDeleteProduct="Delete from Postedproducts where id=".$productid;
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);
$objDBClass->ExecuteQuery($sqlDeleteProduct,$strErr);
$objDBClass->CloseConnection();
if($strErr=="")
{
	echo("<script>location.href = 'http://dealon.live/admin/v1/viewpostedproducts.php';</script>");
}

?>