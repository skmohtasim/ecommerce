<?php
session_start();
?>
<?php
include('Utility.php');
include_once('admin/v1/class/Repository.php');
include_once('admin/v1/class/Item.php');
$objUtility=new Utility();
$objDBClass=new Repository();
$connectionServer="ecommerce";
$objDBClass->OpenConnection($connectionServer,$strErr);

if (!empty($_POST))
{
	$strerr="";
	
	
	$totalprice=0;
   	$totalitems=0;
	$userid="";
	$userAlreadyExists=false;
	$successOrder=false;
	$cart=unserialize(serialize($_SESSION["cart"]));
	$totalCartItems=count($cart);
    for($i=0;$i<count($cart);++$i)
	{
	  $totalprice=$totalprice+((int)$cart[$i]->price*(int)$cart[$i]->quantity);
	  //$totalitems=$totalitems+(int)$cart[$i]->quantity;
	}

	if(!$objUtility->CheckSession())
	{
		$email=$_POST["email"];
		$name=$_POST["name"];
		$password=$_POST["password"];
		$repassword=$_POST["repassword"];
		$address=$_POST["address"];
		$phone=$_POST["phone"];
		
		$sqluser="select id,name from Users where email='".$email."' and upassword='".$password."'";
		$arruserverification=$objDBClass->RetriveData($sqluser,$strErr);
		//echo($sqluser);
		if($arruserverification[0][0]!="Nothing")
		{
			
			//echo $arruserverification[0][0];
			$userAlreadyExists=true;
		}
		else
		{
			
			$sqlregister="insert into Users(name,email,upassword,mobile,address) values('".$name."','".$email."','".$password."','".$phone."','".$address."')";
			//echo($sqlregister);
			$objDBClass->ExecuteQuery($sqlregister,$strerr);
			$sqluser="select id,name from Users where email='".$email."' and upassword='".$password."'";
			$arruser=$objDBClass->RetriveData($sqluser,$strErr);
			
			session_start();
			$objUtility->SetSession($arruser[0][0],$arruser[0][1]);
		}
		$userid=$arruser[0][0];
	}
	else
	{
		$userid=$_SESSION["useridsite"];
		//$userAlreadyExists=true;
	}
	//echo($userid.",");
	//echo($totalprice);
	//die();
	if(!$userAlreadyExists)
	{
		//$objDBClass->BeginTransaction($strerr);
		$sqlorder="insert into Userorder( userid,deliverable,saleongross) values(".$userid.",0,".$totalprice.")";
		//echo($sqlorder."<br>");
		$objDBClass->ExecuteQuery($sqlorder,$strerr);
		$sqlorderid="SELECT orderid FROM Userorder Where userid=".$userid." order by orderid desc limit 1";
		$arrorder=$objDBClass->RetriveData($sqlorderid,$strErr);
		//echo $sqlorderid."<br>";
		if($arrorder[0][0]!="Nothing")
		{
			for($i=0;$i<count($cart);++$i)
			{
				$price=(int)$cart[$i]->price*(int)$cart[$i]->quantity;
				$sqlorderproducts="insert into Orderproducts(orderid,postedproductid,quantity,finalprice) values(".$arrorder[0][0].",".$cart[$i]->id.",".$cart[$i]->quantity.",".$price.")";
				//echo($sqlorderproducts."<br>");
				$objDBClass->ExecuteQuery($sqlorderproducts,$strerr);
			}
		}
		if($strerr=="")
		{
			//$objDBClass->CommitTransaction($strerr);
			$_SESSION["cart"]="";
			//echo("Successfully ordered");
			$successOrder=true;
		}
		else
		{
			//$objDBClass->Rollback($strerr);
			echo($strerr);
		}
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>DEALON-LIVE</title>
      <!-- CSS FILES -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/responsive.css">
      <!-- GOOGLE FONT -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
      <!-- FONT AWESOME -->
      <link href="css/font-awesome.css" rel="stylesheet">
   </head>
   <body>
      <!-- NAVIGATION BAR -->
      <?php include_once('navbar.php'); ?>
      <div class="container">
         <div class="product-card">
            <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default single-card">
                     <div class="panel-heading">
                     	<?php if($successOrder){ ?>
                        <div class="col-md-offset-3 col-md-6 text-center">

                            <h3>Congratulations!</h3>
                        
                            <p>Your order has been placed successfully. We will contact with you shortly.</p>
                        
                            <a href="index.php" class="btn btn-success">Back to home</a>
                        
                        </div>
                        <?php } ?>
                     </div>
                     
                  </div>

                  <div class="single-card bg-white">
                     <div class="row">
                        
                           
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>

      

      <!-- JQUERY LIBRARY -->
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/common.js"></script>
       <?php include_once('footer.php');
	   $objDBClass->CloseConnection();
			 ?>
   </body>
</html>