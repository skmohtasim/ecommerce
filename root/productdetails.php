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
      <script src="js/jquery.min.js"></script>
      <script src="js/common.js"></script>
   </head>
   <?php 
   
   	function getPercentage($currentprice,$salesprice)
	{
		$diff=$currentprice-$salesprice;
		$percentage=($diff*100)/$currentprice;
		return round($percentage);
	}
	$productid=$_GET["pid"];
   	include_once('admin/v1/class/Repository.php');
	include_once('Utility.php');
	include_once('admin/v1/class/Item.php');
	$objDBClass=new Repository();
	$objUtility=new Utility();
	
	$sql="select po.id,p.name,p.description,p.specification,po.currentprice,po.saleprice,po.publishdate,po.enddate,po.inventoryqty,po.perpersonqtylimit,po.deliveryfacility,po.extranotes,p.imageurl,p.extrafeatures,po.offdeal,po.perpersonqtylimit from Products p inner join Postedproducts po on p.productid=po.productid where  po.id=".$productid;
	$connectionServer="ecommerce";
	
	$objDBClass->OpenConnection($connectionServer,$strErr);
	$arrproduct=$objDBClass->RetriveData($sql,$strErr);
	
	$postproductid=$arrproduct[0][0];
	$name=$arrproduct[0][1];
	$description=$arrproduct[0][2];
	$specification=$arrproduct[0][3];
	$arrspecification=explode ("\r\n", $specification);
	//echo("bbbb".count($arrspecification));
	$currentprice=$arrproduct[0][4];
	$salesprice=$arrproduct[0][5];
	$publishdate=$arrproduct[0][6];
	$enddate=$arrproduct[0][7];
	$inventoryqty=$arrproduct[0][8];
	$perpersonqtylimit=$arrproduct[0][9];
	$deliveryfacility=$arrproduct[0][10];
	$extranotes=$arrproduct[0][11];
	$arrextranotes=explode ("\r\n",  $extranotes);
	$imageurl=$arrproduct[0][12];
	$extrafeatures=$arrproduct[0][13];
	$arrextrafeatures=explode ("\r\n",  $extrafeatures);
	//echo("aaaa".count($arrextrafeatures));
	$offdeal=$arrproduct[0][14];
	$perpersonqtylimit=$arrproduct[$i][15];
	
	$sqlcategories="select categoryid,categoryname from Categories";
	$arrcategories=$objDBClass->RetriveData($sqlcategories,$strErr);
//echo "ooooo".$strErr;
   ?>
   <body>
      <!-- NAVIGATION BAR -->
      <?php include_once('navbar.php'); ?>
      <!--nav ends-->
      <div class="container">
         <div class="product-card">
            <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default single-card">
                     <div class="panel-body">
                        <div class="row-fluid">
                           <div class="col-md-12">
                              <h1 class="deal-title">
                              <?php echo($name);?>	<!--13% OFF! HP Probook 440-G4 i5-7300U Laptop worth Rs.116,127 for just Rs.100,980 Inclusive of Three Year Warranty!-->
                              </h1>
                             <!-- <p class="deal-id">Deal ID: 123456</p>-->
                           </div>
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-8">
                                    <div class="row">
                                    	<div class="col-md-12">
                                    		<div class="product-photo">
		                                       <div class="offer-badge">
		                                          <div class="arrow-right">
		                                             <div class="offer">
		                                                <span class="percentage"><strong><?php echo(getPercentage($currentprice,$salesprice)) ?>%</strong></span>
		                                                <span>OFF</span>
		                                             </div>
		                                          </div>
		                                       </div>
		                                       <img src="http://dealon.live/admin/v1/productimages/<?php echo($imageurl); ?>" alt="" class="img-responsive">
		                                    </div>
                                    	</div>
                                    	<div class="col-md-12">
                                    		<div class="product-details">
                                    			<p>
                                    				<?php echo($description);?>
                                    			</p>
                                    		</div>

                                    		<div class="panel panel-default">
											  <div class="panel-heading">
											  	<h4>Terms</h4>
											  </div>
											  <div class="panel-body">
											    <ul>
											    	<?php for($i=0;$i<count($arrextranotes);++$i){?>
											    	<li><?php echo($arrextranotes[$i]);?></li>
                                                    <?php } ?>
											    </ul>
											  </div>
											</div>

											<div class="panel panel-default">
											  <div class="panel-heading">
											  	<h4>Overview</h4>
											  </div>
											  <div class="panel-body">
											  	<!--<img src="images/tv.jpg" alt="" class="img-responsive mb-20">-->
											    <p><strong>Features</strong></p>
											    <ul>
                                                	<?php for($i=0;$i<count($arrextrafeatures);++$i){?>
											    	<li><?php echo($arrextrafeatures[$i]);?></li>
                                                    <?php } ?>
											    	<!--<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>-->
											    </ul>

											    <p><strong>Specifications</strong></p>
											    <ul>
											    	<?php for($i=0;$i<count($arrspecification);++$i){?>
											    	<li><?php echo($arrspecification[$i]);?></li>
                                                    <?php } ?>
											    	<!--<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>
											    	<li>Voucher is valid only for one Toshiba 40 inch FULL HD TV 40L3650VE</li>-->
											    </ul>


											  </div>
											</div>


                                    	</div>
                                    </div>
                                 </div>

                                 <div class="col-md-4">
                             		<div class="product-info product-sidebar">
                                 		<div class="row">
                                          <div class="col-md-12">
                                             <div class="deal-price border-light mb-10 text-center">
                                                <p><strong>Now only</strong></p>
                                                <h5 class="text-success lg">Tk. <?php echo($currentprice);?></h5>
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="orginal-price border-light text-center mb-10">
                                                <p><strong>Original price</strong></p>
                                                <h5 class="text-danger"><del>Tk. <?php echo($salesprice);?></del></h5>
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="orginal-price border-light text-center mb-10">
                                                <p><strong>You save</strong></p>
                                                <h5 class="">Tk. <?php echo($currentprice-$salesprice);?></h5>
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="counter border-light text-center mb-10">
                                                <i class="fa fa-clock-o"></i>
                                                <p>Remaining</p>
                                                <h5 class="text-info"><?php echo($objUtility->GetDayDifference(date('Y-m-d H:i:s'),$enddate));?> Days</h5>
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="delivery border-light text-center">
                                                <i class="fa fa-truck"></i>
                                                <p>Delivery</p>
                                                <h5 class="text-success">Yes</h5>
                                             </div>
                                          </div>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-12">
		                                    <div class="product-summery product-sidebar last">
		                                       <div class="product-quantity">
		                                       		<label>Quantity:</label>
		                                       		<input type="number" class="form-control" value="1">
		                                       		<span>You can order max <?php echo($perpersonqtylimit);?> items</span>
		                                       </div>
                                               <?php $disabled="";
											   //echo($cartids);
											   if (strpos((string)$cartids, $postproductid) !== false)
											   {$disabled="disabled";}
											   ?>
		                                       <div class="action-btn mt-20">
                                               
                                               <a href="javascript:addtocart(<?php echo($postproductid);?>,'<?php echo($name);?>',<?php echo($salesprice);?>,'orderqty<?php echo($postproductid);?>')" class="btn btn-success btn-lg mb-10 claim <?php echo($disabled);?>"><i class="fa fa-shopping-cart"></i> Claim to Buy</a>
		                                        
		                                          <!--<a href="" class="btn btn-success btn-lg">Claim to Buy</a>-->
		                                       </div>
		                                    </div>
		                                 </div>
		                            </div>

		                            <div class="row">
		                            	<div class="col-md-12">
		                            		<div class="panel panel-default contact-sidebar">
		                            			<div class="panel-body">
			                            			<p><strong>Questions?</strong> We'd love to help!</p>
			                            			<span class="phone text-success"><i class="fa fa-phone"></i> +8801911 11 11 11</span>
			                            			<span class="email"><i class="fa fa-envelope"></i> yourname@email.com</span>
			                            			<span class="time">
			                            				From Monday to Friday, 9am - 6.30pm <br>
			                            				Saturday, 9am - 5pm
			                            			</span>
		                            			</div>
		                            		</div>
		                            	</div>
		                            </div>
                                 </div>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <?php include_once('usermodal.php');
			 ?>

      <!-- JQUERY LIBRARY -->
     <?php $objDBClass->CloseConnection();?>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/common.js"></script>
      <?php include_once('footer.php');
			 ?>
   </body>
</html>