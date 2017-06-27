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

function UploadImage($imagefileName,$filepathid)
{
	if(isset($_FILES[$imagefileName])){
      $errors= array();
      $file_name = $_FILES[$imagefileName]['name'];
      $file_size =$_FILES[$imagefileName]['size'];
      $file_tmp =$_FILES[$imagefileName]['tmp_name'];
      $file_type=$_FILES[$imagefileName]['type'];
     // $file_ext=strtolower(end(explode('.',$_FILES[$imagefileName]['name'])));
//      
//      $expensions= array("jpeg","jpg","png");
//      
//      if(in_array($file_ext,$expensions)=== false){
//         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
//      }
      
      //if($file_size > 2097152){
//         $errors[]='File size must be excately 2 MB';
//      }
      
	  //echo($errors);
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"productimages/".$filepathid."_".$file_name);
		 	return True;
      }else{
		  if ($_FILES[$imagefileName]['error'] !== UPLOAD_ERR_OK) {
   die("Upload failed with error code " . $_FILES[$imagefileName]['error']);
}
		  return FALSE;
        // print_r($errors);
      }
   }
}

function GetTopId($objDBClass)
{
	$sqltopid="select productid from Products order by productid desc limit 1";
	$arrtopid=$objDBClass->RetriveData($sqltopid,$strerr);
	if($arrtopid[0][0]=="Nothing")
	{
		return "1";
	}
	else
	{
		$id= (int)($arrtopid[0][0]);
		$id= $id+1;
		return (string)$id;
	}
}


$strerr="";
$message="";
include_once('class/Repository.php');
include_once('Utility.php');
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$connectionServer="ecommerce";

$objDBClass->OpenConnection($connectionServer,$strErr);

$sqlcateoggry="select categoryid,categoryname from Categories" ;
$arrcat=$objDBClass->RetriveData($sqlcateoggry,$strerr);
if (!empty($_POST))
{
	$category=addslashes($_POST["category"]);
	$name=addslashes($_POST["name"]);
	$price=addslashes($_POST["Price"]);
	$description=addslashes($_POST["description"]);
	$specification=addslashes($_POST["Specification"]);
	$extrafeatures=addslashes($_POST["extrafeatures"]);
	$temptopid=GetTopId($objDBClass);
	$imageurl=$temptopid."_".$_FILES['image_thumb']['name'];
	
	

		$sql="INSERT INTO Products( name, price, description, specification, extrafeatures, imageurl, categoryid) VALUES ('".$name."',".$price.",'".$description."','".$specification."','".$extrafeatures."','".$imageurl."',".$category.")";
		
		$objDBClass->ExecuteQuery($sql,$strErr);
		
		
		if($strErr=="")
		{
			$imagestatus=UploadImage('image_thumb',$temptopid);
			//echo($imagestatus);
			$message="Successfully added. To publish your product please go to view posted product link and click link post";
		}
		else
		{
			echo($strErr);
			$message=$strErr;
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
                  <div class="panel-heading"><h4>Add Product</h4></div>
                  <br>
                  <div>
                  	
                  	<form action="" method="post" enctype="multipart/form-data">
                    
                     <div class="form-group">
                    	<label >Categories <span style="color:#C33;font-size:20px">*</span></label>
                    	<select  name="category" class="form-control">
                    	
                    	<?php for($i=0;$i<count($arrcat); $i++) {?>
                    	<option value="<?php echo($arrcat[$i][0]);?>"><?php echo($arrcat[$i][1]);?></option>
                        <?php } ?>
                    </select>
                    </div>
                    
                    <div class="form-group">
                    	<label >Product Name <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" name="name" class="form-control" />
                    </div>
                    
                  
                    
                     <div class="form-group">
                    	<label >Price <span style="color:#C33;font-size:20px">*</span></label>
                    	<input type="text" name="Price" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                    	<label >Description <span style="color:#C33;font-size:20px">*</span></label>
                        <textarea name="description" rows="10" class="form-control" ></textarea>
                    	
                    </div>
                    
                    <div class="form-group">
                    	<label >Specification <span style="color:#C33;font-size:20px">*</span></label>
                        <textarea name="Specification" rows="10" class="form-control" ></textarea>
                    	
                    </div>
                    
                    <div class="form-group">
                    	<label >Extra features <span style="color:#C33;font-size:20px">*</span></label>
                        <textarea name="extrafeatures" rows="10" class="form-control" ></textarea>
                    	
                    </div>
                   
                   <div class="form-group">
                    	<label >Upload <span style="color:#C33;font-size:20px">*</span></label>
                         <input type="file" name="image_thumb" class="form-control" id="image_thumb"/>
                    	<!--<input type="text" name="thumb" class="form-control" id="thumb" onBlur="showimage('thumb','viewthumb')" />-->
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