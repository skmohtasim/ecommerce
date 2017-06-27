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
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   
    <script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
        
        
        
        <script src="bootstrap-datepicker.js"></script>
        

    
    
    <script type="text/javascript">
	$("#description").keypress(function(){

    if(this.value.length > 160){
        return false;
    }
    $("#counter").html("Remaining characters : " +(160 - this.value.length));
})
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
	</script>
    
    <script type="text/javascript">


	$(function(){
	   $('#publishdate').datepicker();
	   
	   $('#enddate').datepicker();
	
	});
	
	</script>
    
</head>
<?php





$id=$_GET["id"];
$strerr="";
$message="";
include_once('class/Repository.php');
include_once('Utility.php');
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);

$sqlproduct="select p.productid,p.name,p.price,p.description,p.specification,p.extrafeatures,p.imageurl,c.categoryname from Products p inner join Categories c on p.categoryid=c.categoryid where p.productid=".$id;
$connectionServer="ecommerce";
$arrproducts=$objDBClass->RetriveData($sqlproduct,$strerr);
if($strErr=="")
{
	$name=$arrproducts[0][1];
	$price=$arrproducts[0][2];
	$description=$arrproducts[0][3];
	$specification=$arrproducts[0][4];
	$extrafeatures=$arrproducts[0][5];
	$imageurl=$arrproducts[0][6];
	$categoryid=$arrproducts[0][7];
	$productid=$arrproducts[0][0];

	
}
else
{
	echo($strErr);
}


if (!empty($_POST))
{
	
	
	$currentprice=addslashes($_POST["currentprice"]);
	$salesprice=addslashes($_POST["salesprice"]);
	$offdeal=addslashes($_POST["offdeal"]);
	//echo($offdeal);
	//die();
	if($offdeal=="on")
	{$offdeal=1;}
	else
	{$offdeal=0;}
	
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
	$hid=addslashes($_POST["hid"]);
	
	
	

		$sql="INSERT INTO Postedproducts( productid, currentprice, saleprice, offdeal, publishdate, enddate, inventoryqty, perpersonqtylimit, deliveryfacility, extranotes, active) VALUES (".$hid.",".$currentprice.",".$salesprice.",".$offdeal.",'".$publishdate."','".$enddate."',".$productinventory.",".$maxpurchase.",".$delivery.",'".$extranotes."',1)";
		
		$objDBClass->ExecuteQuery($sql,$strErr);
		
		
		if($strErr=="")
		{
			$message="Successfully posted";
			//echo($imagestatus);
		}
		else
		{
			$message=$strErr;
			//echo($sql);
			echo($strErr);
		}
	
}
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
                  <div class="panel-heading"><h4>Post Product</h4></div>
                  <br>
                  <div >
                   	<img src="http://dealon.live/admin/v1/productimages/<?php echo($imageurl); ?>">
                   </div>
                  <div>
                  	
                  	<form action="" method="post" enctype="multipart/form-data">
                    
                    
                    
                    <div class="form-group">
                    	<label >Product Name <span style="color:#C33;font-size:20px">*</span></label>
                    	<?php echo($name);?> 
                    </div>
                    
                  
                    
                     <div class="form-group">
                    	<label >Current Price <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" value="<?php echo($price);?>" name="currentprice" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Sales Price <span style="color:#C33;font-size:20px">*</span></label>
                       (Offdeal) <input type="checkbox" class="form-control" name="offdeal" onClick="toggletext()" id="offdeal">
                    	<input type="text"  name="salesprice" class="form-control" disabled id="salesprice" value="<?php echo($price);?>" />
                        
                    </div>
                    
                    <div class="form-group">
                    	<label >Publish Date <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" value="" name="publishdate" class="form-control" id="publishdate" data-date-format="yyyy-mm-dd" />
                        
                    </div>
                    
                    <div class="form-group">
                    	<label >End Date <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" value="" name="enddate" class="form-control" id="enddate" data-date-format="yyyy-mm-dd" />
                    </div>
                    
                    <div class="form-group">
                    	<label >No. of products in inventory <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" value="" name="productinventory" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Max purchaseable product per person <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" value="" name="maxpurchase" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Extra notes <span style="color:#C33;font-size:20px">*</span></label>
                        <textarea name="extranotes" rows="10" class="form-control" ></textarea>
                    	
                    </div>
                    
                    <div class="form-group">
                    	<label >Delivery Facility <span style="color:#C33;font-size:20px">*</span></label>
                        <input type="checkbox" name="delivery" class="form-control">
                    	
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