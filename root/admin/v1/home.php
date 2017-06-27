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
	</script>
</head>
<?php

include_once('class/Repository.php');
include_once('Utility.php');
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$sqlnews="select * from Postedproducts";
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);
$arrdeals=$objDBClass->RetriveData($sqlnews,$strErr);


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
     <h3><i class="glyphicon glyphicon-tags"></i> News Feed</h3>  
            
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
                      <th class="col-md-1">Title</th>
                      <th class="col-md-3">category</th>
                      <th class="col-md-3">type</th>
                      
                      <th class="col-md-3">posting date</th>
                      <th class="col-md-3">Verified</th>
                      <th class="col-md-3">link</th>
                    </tr>
                  </thead>
                  <tbody>
              <?php
			  if($arrdeals[0][0]!="Nothing")
			  {
			  	for($i=0;$i<count($arrdeals); $i++)
				{ 				
			  ?>

                    <tr>
                      <th scope="row" class="col-md-1"><?php echo($i+1); ?></th>
                     
                      <td class="col-md-3"><?php echo($arrdeals[$i][3]); ?></td>
                      <td class="col-md-3"><?php echo($arrdeals[$i][1]); ?></td>
                     <td class="col-md-3"><?php echo($arrdeals[$i][2]); ?></td>
                      <td class="col-md-3"><?php echo($objUtility->DateFormat($arrdeals[$i][4])); ?></td>
                       <td class="col-md-3">
                       <?php 
					   if(($arrdeals[$i][6])=="1")
					  {
						  echo("verified");
					  }
					  else
					  {
						echo("Unverified");
						} ?>
					   </td>
                     <td class="col-md-3"><?php echo($arrdeals[$i][5]); ?></td>
                      <td class="col-md-2"><a href="editcircular.php?id= <?php echo($arrdeals[$i][0]) ; ?>">edit </a>|<a href="deletecircular.php?id= <?php echo($arrdeals[$i][0]) ; ?>">delete </a> </td>
					  
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