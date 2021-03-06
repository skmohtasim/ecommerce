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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/daterangepicker.js"></script>
        
        
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/daterangepicker.css" rel="stylesheet">
    <script type="text/javascript">
	$("#description").keypress(function(){

    if(this.value.length > 160){
        return false;
    }
    $("#counter").html("Remaining characters : " +(160 - this.value.length));
})
	
	</script>
    
    <script type="text/javascript">

	$(function() {
	
	   $('input[name="startdate"]').daterangepicker({
	
		   singleDatePicker: true,
	
		   showDropdowns: true
	
	   })
	   
	   $('input[name="enddate"]').daterangepicker({
	
		   singleDatePicker: true,
	
		   showDropdowns: true
	
	   })
	
	});
	
	</script>
    
</head>
<?php


include_once('class/Repository.php');
include_once('Utility.php');
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$connectionServer="ecommerce";
$objDBClass->OpenConnection($connectionServer,$strErr);

if (!empty($_POST))
{
	$name=addslashes($_POST["name"]);
	$description=addslashes($_POST["description"]);
	
	


		$sql="insert into Categories(categoryname,description) values";
		$sql=$sql." ('".$name."','".$description."')";
		$objDBClass->ExecuteQuery($sql,$strErr);
		
		//echo($sql);
		if($strErr=="")
		{
			$message="Successfully inserted";
			
		}
		else
		{
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
                  <div class="panel-heading"><h4>Add Category</h4></div>
                  <br>
                  <div>
                  	
                  	<form action="" method="post">
                    
                    
                    
                     <div class="form-group">
                    	<label >Category Name <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" name="name" class="form-control" />
                    </div>
                    
                     <div class="form-group">
                    	<label >Category Description <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" name="description" class="form-control" />
                    </div>
                   
                    
                   
                    	<input type="submit"  class="btn btn-success" value="add" />
                   
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