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
			window.location = "deleteproduct.php?id="+id;
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
$sqlcategory="select p.productid,p.name,p.price,p.description,p.specification,p.extrafeatures,p.imageurl,c.categoryname from Products p inner join Categories c on p.categoryid=c.categoryid order by categoryname";
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);
$arrcategory=$objDBClass->RetriveData($sqlcategory,$strErr);



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
                      <th class="col-md-3">price</th>
                      <th class="col-md-1">description</th>
                      <th class="col-md-3">specification</th>
                      <th class="col-md-1">extrafeatures</th>
                      <th class="col-md-3">categoryname</th>
                      <th class="col-md-1">image</th>
                      
                     
                    </tr>
                  </thead>
                  <tbody>
              <?php
			  if($arrcategory[0][0]!="Nothing")
			  {
			  	for($i=0;$i<count($arrcategory); $i++)
				{ 	
					$name=$arrcategory[$i][1];
					$price=$arrcategory[$i][2];
					$description=$arrcategory[$i][3];
					$specification=$arrcategory[$i][4];
					$extrafeatures=$arrcategory[$i][5];
					$imageurl=$arrcategory[$i][6];
					$categoryname=$arrcategory[$i][7];
					$productid=$arrcategory[$i][0];			
			  ?>

                    <tr>
                      <th scope="row" class="col-md-1"><?php echo($i+1); ?></th>
                     
                      <td class="col-md-3"><?php echo($name); ?></td>
                      <td class="col-md-3"><?php echo($price); ?></td>
                      <td class="col-md-3"><?php echo($description); ?></td>
                      <td class="col-md-3"><?php echo($specification); ?></td>
                      <td class="col-md-3"><?php echo($extrafeatures); ?></td>
                      <td class="col-md-3"><?php echo($categoryname); ?></td>
                      <td class="col-md-3"><img src="http://dealon.live/admin/v1/productimages/<?php echo($imageurl); ?>"></td>
                     
                      <td class="col-md-2"><a href="postproduct.php?id=<?php echo($productid) ; ?>">Post </a>|<a href="editproduct.php?id=<?php echo($productid) ; ?>">edit </a>|<a href="javascript:confirmation(<?php echo($productid) ; ?>);">delete </a> </td>
					  
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