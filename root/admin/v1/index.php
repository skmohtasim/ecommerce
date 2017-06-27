<?php
include('Utility.php');
include_once('admin/v1/class/Repository.php');

$objUtility=new Utility();


if (!empty($_POST))
{
	$username=$_POST["uname"];
	$password=$_POST["pass"];
	$strErr="";
	$objDBClass=new Repository();
	$connectionServer="ecommerce";
	$objDBClass->OpenConnection($connectionServer,$strErr);
	
	$sqluser="select id,name from Contentusers where cusername='".$username."' and cpassword='".$password."'";
	$arruser=$objDBClass->RetriveData($sqluser,$strErr);
	//echo($sqluser);
	$objDBClass->CloseConnection();
	
	if(is_numeric($arruser[0][0])==1)
	{
		session_start();
		$objUtility->SetSession($arruser[0][0],$arruser[0][1]);
		
	}
	else
	{
		echo("wrong username or password");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product List</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>
<body>

<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<img src="../images/logo-white.png" alt="Error Station" class="img-responsive">
			</div>
		</div>
	</div>
</header>

<section class="page-title">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>
					All Products
				</h3>
			</div>
		</div>
	</div>
</section>

<section class="product-card">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				
					<div class="single-card">
						<div class="row">
							<div class="col-md-4">
								<form action="" method="post">
                                    Username: <input type="text" name="uname">
                                    <br>
                                    Password: <input type="password" name="pass">
                                    <br>
                                    <input type="submit">
                                </form>
							</div>
							<div class="col-md-8">
								
							</div>
						</div>
					</div>
				
			</div>
		</div>
	</div>
</section>
	
</body>
</html>