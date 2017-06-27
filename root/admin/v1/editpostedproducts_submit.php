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
	
	$currentprice=addslashes($_POST["currentprice"]);
	$offdeal=addslashes($_POST["offdeal"]);
	if($offdeal=="on")
	{$offdeal=1;}
	else
	{$offdeal=0;}
	$salesprice=addslashes($_POST["salesprice"]);
	if($salesprice=="")
		$salesprice=0;
	$publishdate=addslashes($_POST["publishdate"]);
	$enddate=addslashes($_POST["enddate"]);
	$productinventory=addslashes($_POST["productinventory"]);
	$maxpurchase=addslashes($_POST["maxpurchase"]);
	$extranotes=addslashes($_POST["extranotes"]);
	$delivery=addslashes($_POST["delivery"]);
	if($delivery=="on")
	{$delivery=1;}
	else
	{$delivery=0;}
	$active=addslashes($_POST["active"]);
	if($active=="on")
	{$active=1;}
	else
	{$active=0;}
	$hid=addslashes($_POST["hid"]);
	//$imagestatus=false;
	//echo($_FILES[$imagefileName]['name']);
	//die();
	

	$sqlupdate="";
	
		//echo($imagestatus);
		$sqlupdate="update  Postedproducts set currentprice=".$currentprice.",offdeal=".$offdeal.",saleprice=".$salesprice.",publishdate='".$publishdate."',enddate='".$enddate."',inventoryqty=".$productinventory.",perpersonqtylimit=".$maxpurchase.",extranotes='".$extranotes."',deliveryfacility=".$delivery." where id=".$hid;
		//echo($sqlupdate);

		
	echo($sqlupdate);
	$objDBClass->ExecuteQuery($sqlupdate,$strErr);
	$objDBClass->CloseConnection();
	echo($strErr);
	//die();
	if($strErr=="")
	{
		
		
			echo("<script type='text/javascript'>alert('successfullyupdated');</script>"); 
			echo("<script>location.href = 'http://dealon.live/admin/v1/viewpostedproducts.php';</script>");

		
	}
	else
	{
		
		echo($strErr);
	}
}

?>