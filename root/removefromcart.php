<?php
session_start();
require 'admin/v1/class/Item.php';

$cart=unserialize(serialize($_SESSION["cart"]));
$index=-1;
$pid=$_GET["id"];
for($i=0;$i<count($cart);$i++)
{
	if(($cart[$i]->id)==$pid)
	{
		$index=$i;
		break;
	}
}

unset($cart[$index]);
if($cart!=NULL)
{
	$cart=array_values($cart);
	$_SESSION["cart"]=$cart;
	//echo($pid);
	//echo($cart);
}
else
{
	unset($_SESSION['cart']);
	
}
echo count($cart);

?>