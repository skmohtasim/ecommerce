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
     <script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		 <script src="bootstrap-datepicker.js"></script>
        
        
        
    <link href="bootstrap.css" rel="stylesheet">

    <script type="text/javascript">
	function toggletext()
	{
		if(document.getElementById("offdeal").checked)
		{
			document.getElementById("salesprice").disabled=false;
		}
		else
		{
			document.getElementById("salesprice").disabled=true;
		}
	}

	$(function(){
	   $('#publishdate').datepicker();
	   
	   $('#enddate').datepicker();
	
	});
	
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
$id=$_GET["id"];
$sql="select po.id,p.name,po.currentprice,po.saleprice,po.publishdate,po.enddate,po.inventoryqty,po.perpersonqtylimit,po.deliveryfacility,po.extranotes,p.imageurl,po.active,po.offdeal from Products p inner join Postedproducts po on p.productid=po.productid where po.id=".$id;
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);
$arrproduct=$objDBClass->RetriveData($sql,$strErr);

$postproductid=$arrproduct[0][0];
$name=$arrproduct[0][1];
$currentprice=$arrproduct[0][2];
$salesprice=$arrproduct[0][3];
$publishdate=$arrproduct[0][4];
$enddate=$arrproduct[0][5];
$inventoryqty=$arrproduct[0][6];
$perpersonqtylimit=$arrproduct[0][7];
$deliveryfacility=$arrproduct[0][8];
$extranotes=$arrproduct[0][9];
$imageurl=$arrproduct[0][10];
$active=$arrproduct[0][11];
$offdeal=$arrproduct[0][12];
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
     <h3><i class="glyphicon glyphicon-tags"></i> </h3>  
            
       <hr>
      
	   <div class="row">
            <!-- center left-->	
         	<div class="col-md-7">
			  <!--<div class="well">Inbox Messages <span class="badge pull-right">3</span></div>
              -->
              
              <div class="panel panel-default">
                  <div class="panel-heading"><h4>Edit Product</h4></div>
                  <div >
                   	<img src="http://dealon.live/admin/v1/productimages/<?php echo($imageurl); ?>">
                   </div>
                  <br>
                  
                  <div>
                  	
                  	<form action="editpostedproducts_submit.php" method="post" enctype="multipart/form-data">
                    
                    
                    
                    <div class="form-group">
                    	<label >Product Name <span style="color:#C33;font-size:20px">*</span></label>
                    	<?php echo($name);?> 
                    </div>
                    
                  
                    
                     <div class="form-group">
                    	<label >Current Price <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" value="<?php echo($currentprice);?>" name="currentprice" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Sales Price <span style="color:#C33;font-size:20px">*</span></label>
                       (Offdeal) <input type="checkbox" class="form-control" <?php if($offdeal==1){?> checked <?php } ?> name="offdeal" onClick="toggletext()" id="offdeal">
                    	<input type="text"  name="salesprice" class="form-control" id="salesprice" value="<?php echo($salesprice);?>" />
                        
                    </div>
                    
                    <div class="form-group">
                    	<label >Publish Date <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text"  name="publishdate" class="form-control" id="publishdate" data-date-format="yyyy-mm-dd" value="<?php echo($publishdate);?>"  />
                        
                    </div>
                    
                    <div class="form-group">
                    	<label >End Date <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text"  name="enddate" class="form-control" id="enddate" value="<?php echo($enddate);?>"  data-date-format="yyyy-mm-dd" />
                    </div>
                    
                    <div class="form-group">
                    	<label >No. of products in inventory <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text"  name="productinventory" value="<?php echo($inventoryqty);?>"  class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Max purchaseable product per person <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" name="maxpurchase" value="<?php echo($perpersonqtylimit);?>"  class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Extra notes <span style="color:#C33;font-size:20px">*</span></label>
                        <textarea name="extranotes" rows="10" class="form-control" ><?php echo($extranotes);?></textarea>
                    	
                    </div>
                    
                    <div class="form-group">
                    	<label >Delivery Facility <span style="color:#C33;font-size:20px">*</span></label>
                        <input type="checkbox" name="delivery" class="form-control" <?php if($deliveryfacility==1){?> checked <?php } ?>>
                    	
                    </div>
                    <div class="form-group">
                    	<label >Active <span style="color:#C33;font-size:20px">*</span></label>
                        <input type="checkbox" name="active" class="form-control" <?php if($active==1){?> checked <?php } ?>>
                    	
                    </div>
                   
                   
                   
                    
                   <input type="hidden" value="<?php echo($id); ?>" name="hid">
                    	<input type="submit"  class="btn btn-success" value="Post" />
                   
                    </form>
                    
                    
                  </div>
                  <br>
                  
                  <?php
				  if (!empty($_POST))
				  {
					  if($message!="")
				   		echo("<script type='text/javascript'>alert('".$message."');</script>"); 
				  }
				   ?>
                  <!--/panel-body-->
              </div><!--/panel-->                     
              
          	</div>
     
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



  

	</body>
</html>
<?php 
?> 