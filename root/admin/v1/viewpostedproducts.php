<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bootstrap 3 Control Panel</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">
    <script type="text/javascript">
		function getsms(id)
		{
			var request = $.ajax({
			  url: "getsmslist.php",
			  method: "GET",
			  data: { catid : id },
			  dataType: "html"
			});
	 
			request.done(function( msg ) {
			  $( "#smslist" ).html( msg );
			});
		}
		
		function ConfirnOnDelete(id)
		{
			var x = confirm("Do you really want to delete the news feed?");
			if (x)
			{
				location.href = 'http://errorstation.com/sportsapp/deletenews.php?newsid='+id;
			}
		}
		
		
	function confirmation(id)
	{
		var result = confirm("Do your really want to delete?");
		if (result) {
		//Logic to delete the item
			window.location = "deletepostedproduct.php?id="+id;
		}
	}

	</script>
</head>
<?php

include_once('class/Repository.php');
include_once('Utility.php');
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$sql="select po.id,p.name,po.currentprice,po.saleprice,po.publishdate,po.enddate,po.inventoryqty,po.perpersonqtylimit,po.deliveryfacility,po.extranotes,p.imageurl,po.active from Products p inner join Postedproducts po on p.productid=po.productid order by po.postingdate desc";
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);
$arrproduct=$objDBClass->RetriveData($sql,$strErr);



$objDBClass->CloseConnection();


?>
<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="#">Control Panel</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php include('topbar.php'); ?>
        
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
  
  <!-- upper section -->
  <div class="row">
	<?php include('leftmenu.php'); ?>
    <span class="form-group">
    
    </span>
    <div class="col-sm-9">
      	
      <!-- column 2 -->	
     <h3><i class="glyphicon glyphicon-tags"></i> Products</h3>  
            
       <hr>
      
	   <div class="row">
            <!-- center left-->	
         	<div class="col-md-12">
            
				
                <br>
                
                
                
              <div class="img-gallery" id="smslist">
              	<!--<table cellpadding="15px" cellspacing="5px">-->
                <form method="post" action="">
                <table class="table table-striped" width="100%">
                	
                  <thead>
                    <tr>
                      <th class="col-md-1">#</th>
                      <th class="col-md-1">Name</th>
                      <th class="col-md-3">Current price</th>
                      <th class="col-md-1">Sales Price</th>
                      <th class="col-md-3">Publish Date</th>
                      <th class="col-md-3">End Date</th>
                      <th class="col-md-1">Inventory</th>
                      <th class="col-md-3">No. of product per person</th>
                      <th class="col-md-1">Delivery facility</th>
                      <th class="col-md-3">Extra Notes</th>
                      <th class="col-md-1">Active</th>
                      <th class="col-md-1">image</th>
                      <th class="col-md-1"></th>
                     
                    </tr>
                  </thead>
                  <tbody>
              <?php
			  if($arrproduct[0][0]!="Nothing")
			  {
			  	for($i=0;$i<count($arrproduct); $i++)
				{ 	
					$postproductid=$arrproduct[$i][0];
					$name=$arrproduct[$i][1];
					$currentprice=$arrproduct[$i][2];
					$salesprice=$arrproduct[$i][3];
					$publishdate=$arrproduct[$i][4];
					$enddate=$arrproduct[$i][5];
					$inventoryqty=$arrproduct[$i][6];
					$perpersonqtylimit=$arrproduct[$i][7];
					$deliveryfacility=$arrproduct[$i][8];
					$extranotes=$arrproduct[$i][9];
					$imageurl=$arrproduct[$i][10];
					$active=$arrproduct[$i][11];			
			  ?>

                    <tr>
                      <th scope="row" class="col-md-1"><?php echo($i+1); ?></th>
                     
                      <td class="col-md-3"><?php echo($name); ?></td>
                      <td class="col-md-3"><?php echo($currentprice); ?></td>
                      <td class="col-md-3"><?php echo($salesprice); ?></td>
                      <td class="col-md-3"><?php echo($publishdate); ?></td>
                      <td class="col-md-3"><?php echo($enddate); ?></td>
                      <td class="col-md-3"><?php echo($inventoryqty); ?></td>
                      <td class="col-md-3"><?php echo($perpersonqtylimit); ?></td>
                      <td class="col-md-3"><?php if($deliveryfacility=="1") 
					  						{echo("Yes");}
											else
											{echo("Yes");}?></td>
                      <td class="col-md-3"><?php echo($extranotes); ?></td>
                      <td class="col-md-3"><?php if($active=="1") 
					  						{echo("Yes");}
											else
											{echo("Yes");} ?></td>
                      <td class="col-md-3"><img src="http://dealon.live/admin/v1/productimages/<?php echo($imageurl); ?>"></td>
                      
                      
                     
                      <td class="col-md-2"><a href="editpostedproduct.php?id=<?php echo($postproductid) ; ?>">edit </a>|<a href="javascript:confirmation(<?php echo($postproductid) ; ?>);">delete </a> </td>
					  
                    </tr>


              <?php
				}
			  }
			  ?>
              		
              	</tbody>
               </table>
               
              </form>
               <!-- <a href=""><img src="http://dummyimage.com/150x100/f5f5f5/212121" class="img-responsive hvr-grow" alt="Responsive image"></a>-->
              </div>
                                
              
          	</div><!--/col-->
         
            <!--center-right-->
        	<!--/col-span-6-->
     
       </div><!--/row-->
  	</div><!--/col-span-9-->
    
  </div><!--/row-->
  <!-- /upper section -->
  
  <!-- lower section --><!--/row-->
  
</div><!--/container-->
<!-- /Main -->





<div class="modal" id="addWidgetModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Widget</h4>
      </div>
      <div class="modal-body">
        <p>Add a widget stuff here..</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dalog -->
</div><!-- /.modal -->



  
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php 
?> 