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
   
   	function getPercentage($currentprice,$salesprice)
	{
		$diff=$currentprice-$salesprice;
		$percentage=($diff*100)/$currentprice;
		return round($percentage);
	}
   	include_once('admin/v1/class/Repository.php');
	include_once('admin/v1/class/Item.php');
	include_once('Utility.php');
	$objDBClass=new Repository();
	$objUtility=new Utility();
	$sql="select po.id,p.name,p.description,p.specification,po.currentprice,po.saleprice,po.publishdate,po.enddate,po.inventoryqty,po.perpersonqtylimit,po.deliveryfacility,po.extranotes,p.imageurl,po.offdeal,po.perpersonqtylimit from Products p inner join Postedproducts po on p.productid=po.productid where CURDATE()<=po.enddate and po.active=1 order by po.publishdate desc";
	$connectionServer="ecommerce";
	
	$objDBClass->OpenConnection($connectionServer,$strErr);
	$arrproduct=$objDBClass->RetriveData($sql,$strErr);
	
	
	
   ?>
   
   
   <body>
      <!-- NAVIGATION BAR -->
      <?php include_once('navbar.php'); ?>
      <!--nav ends-->
      <div class="container">
         <div class="product-card">
          <?php
			for($i=0;$i<count($arrproduct);++$i)
			{
				$postproductid=$arrproduct[$i][0];
				$name=$arrproduct[$i][1];
				$description=$arrproduct[$i][2];
				$specification=$arrproduct[$i][3];
				$currentprice=$arrproduct[$i][4];
				$salesprice=$arrproduct[$i][5];
				$publishdate=$arrproduct[$i][6];
				$enddate=$arrproduct[$i][7];
				$inventoryqty=$arrproduct[$i][8];
				$perpersonqtylimit=$arrproduct[$i][9];
				$deliveryfacility=$arrproduct[$i][10];
				$extranotes=$arrproduct[$i][11];
				$imageurl=$arrproduct[$i][12];
				$offdeal=$arrproduct[$i][13];
				$perpersonqtylimit=$arrproduct[$i][14];
			?>
						
            <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default single-card">
                     <div class="panel-body">
                    <!-- products starts-->
                   
						
                        <div class="row-fluid">
                           <div class="col-md-12">
                              <a class="product-title mb-20" href="productdetails.php?pid=<?php echo($postproductid);?>"><?php echo($name);?><!--13% OFF! HP Probook 440-G4 i5-7300U Laptop worth Rs.116,127 for just Rs.100,980 Inclusive of Three Year Warranty!--></a>
                           </div>
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-5">
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
                                       <!--<img src="images/macbook.png" alt="" class="img-responsive">-->
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="product-info">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="orginal-price border-light text-center mb-10">
                                                <p><strong>Original price</strong></p>
                                                <h5 class="text-danger"><del>Tk. <?php echo($currentprice);?></del></h5>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="deal-price border-light mb-10 text-center">
                                                <p><strong>Deal price</strong></p>
                                                <h5 class="text-success">Tk. <?php echo($salesprice);?></h5>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
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
                                                <h5 class="text-success">
												<?php 
												if($deliveryfacility=="1")
													echo("Yes"); 
												else
													echo("No"); 
													?></h5>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <div class="product-summery">
                                       <p>
                                      <?php echo($description);?>
                                          <!--Take it to the next level with the all new HP Probook 440-G4 i5-7300U Laptop. Packed with features like a 7th Generation Core i5 processor that gives ..-->
                                       </p>
                                       <div class="product-quantity">
                                       		<label>Quantities:</label>
                                       		<input type="number" class="form-control" value="1" id="orderqty<?php echo($postproductid);?>">
                                            <input type="hidden" value="" id="horderqty">
                                       		<span>You can order max <?php echo($perpersonqtylimit);?> items</span>
                                       </div>
                                       
                                       <?php $disabled="";
									   //echo($cartids);
									   if (strpos((string)$cartids, $postproductid) !== false)
									   {$disabled="disabled";}
									   ?>
                                       <div class="action-btn mt-20">
                                          <a href="javascript:addtocart(<?php echo($postproductid);?>,'<?php echo($name);?>',<?php echo($salesprice);?>,'orderqty<?php echo($postproductid);?>')" class="btn btn-success btn-lg btn-claim <?php echo($disabled);?>"><i class="fa fa-shopping-cart"></i> Claim to Buy</a>
                                          <!--<a href="" class="btn btn-success btn-lg">Claim to Buy</a>-->
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
			<!--product ends-->
            <?php } ?>
            </div>
            </div>
            <!--signup modal starts-->
			<?php include_once('usermodal.php');
			 ?>
			
            <!--signup modal ends-->

            
         
      <!-- JQUERY LIBRARY -->
      <?php $objDBClass->CloseConnection();?>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      
      <script src="js/common.js"></script>
      <?php include_once('footer.php');
			 ?>
   </body>
</html>