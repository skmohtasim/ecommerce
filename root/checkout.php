<?php
session_start();
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
   <?php 

   	include_once('admin/v1/class/Repository.php');
	include_once('admin/v1/class/Item.php');
	include_once('Utility.php');
	$objDBClass=new Repository();
	$objUtility=new Utility();
	$connectionServer="ecommerce";
	$objDBClass->OpenConnection($connectionServer,$strErr);
	?>
   <body>
      <!-- NAVIGATION BAR -->
      <?php include_once('navbar.php'); ?>
      <div class="container">
         <div class="product-card">
            <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default single-card">
                     <div class="panel-heading">
                        <div class="text-center">
                           <h2>
                              Checkout
                           </h2>
                        </div>
                     </div>
                     
                              </span>
                           </li>
                      <?php
					if(isset($_SESSION["cart"]) && $_SESSION["cart"]!=NULL)
                    {
						$cart=unserialize(serialize($_SESSION["cart"]));
						$totalCartItems=count($cart);
						//print_r($cart);
					}
					else
					{
						$cart="";
						$totalCartItems=0;
					}
					
					if($cart!="")
					{
                    ?>  
                     <div class="panel-body">
                        <table class="table table-striped">
                           <thead>
                              <th>Item Name</th>
                              <th class="text-center">Item Price</th>
                              <th class="text-center">Quantity</th>
                             <!-- <th class="text-center">Action</th>-->
                           </thead>
                           <tbody>
                           <?php 
						   
						   $totalprice=0;
						   $totalitems=0;
						   for($i=0;$i<count($cart);++$i)
                            {?>
                              <tr>
                                 <td><?php echo($cart[$i]->name);?></td>
                                 <td class="text-center"><?php echo($cart[$i]->price); ?></td>
                                 <td class="text-center"><?php echo($cart[$i]->quantity); ?></td>
                                 <!--<td class="text-center">
                                    <a href="" class="btn"><i class="fa fa-trash"></i>&nbsp;Remove</a>
                                 </td>-->
                              </tr>
                              <?php 
							  $totalprice=$totalprice+((int)$cart[$i]->price*(int)$cart[$i]->quantity);
							  $totalitems=$totalitems+(int)$cart[$i]->quantity;
							  }
                        ?>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th class="text-center">
                                 </th>
                                 <th class="text-center">
                                    Total: <b><?php echo($totalprice); ?>/-</b>
                                 </th>
                                 <th class="text-center">
                                    Total Item: <b><?php echo($totalitems); ?></b>
                                 </th>
                                 <th class="text-center">
                                 </th>
                              </tr>
                           </tfoot>
                        </table>

                       <?php } ?> 
                     </div>
                  </div>
				
                  <div class="single-card bg-white">
                     <div class="row">
                     	
                        <div class="col-md-offset-3 col-md-6">
                           <form action="checkoutpost.php" method="post" id="checkoutpost">
                           <?php 
						   //echo($objUtility->CheckSession()."aaaaa");
						   if(!$objUtility->CheckSession()) 
							{?>
                              <h3 class="text-center">Personal Info</h3>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email address</label>
                                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="email">
                                </div>
                                
                                <div class="form-group">
                                  <label for="exampleInputEmail1">password</label>
                                  <input type="password" class="form-control" id="" placeholder="" name="password">
                                </div>

                                <div class="form-group">
                                  <label for="Name">Your Name</label>
                                  <input type="text" class="form-control" id="name" placeholder="" name="name">
                                </div>

                                <div class="form-group">
                                  <label for="Phone">Phone Number</label>
                                  <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label for="Address">Address</label>
                                  <textarea name="address" id="" cols="30" rows="4" class="form-control" ></textarea>
                                </div>
								<?php }?>
                                <input type="hidden" value="1" name="hid">
                                <div class="checkout-card">
                                      <!-- <h4>Checkout Total: 1,50,000/-</h4>-->
                                       <a href="javascript:document.getElementById('checkoutpost').submit();" class="btn btn-success btn-lg">Checkout Now</a>
                                    </div>
                           </form>
                        </div>
                           
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>

      <?php include_once('footer.php');
			 ?>   
		<?php
			 $objDBClass->CloseConnection();?>

      <!-- JQUERY LIBRARY -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/common.js"></script>
   </body>
</html>