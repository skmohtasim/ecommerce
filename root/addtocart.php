<?php
session_start();
require 'admin/v1/class/Item.php';

	//$_SESSION["cart"]=NULL;
$pid=$_GET["id"];
$pname=$_GET["name"];
$pprice=$_GET["price"];
$pquantity=$_GET["quantity"];
$item=new Item();
$item->id=$pid;
$item->name=$pname;
$item->price=$pprice;
$item->quantity=$pquantity;
$index=-1;
$cart="";
$response=0;
if(isset($_SESSION["cart"]))
{
	$cart=unserialize(serialize($_SESSION["cart"]));
	for($i=0;$i<count($cart);$i++)
	{
		$response++;
		if(($cart[$i]->id)==$pid)
		{
			$index=$i;
			break;
		}
	}
	if($index==-1)
		$_SESSION["cart"][]=$item;
		//$_SESSION["cart"]=$cart;
	else
	{
		$cart[$index]->quantity++;
		$_SESSION["cart"]=$cart;
	}
}
else
{
	$_SESSION["cart"][]=$item;
}

echo($response+1);
?>