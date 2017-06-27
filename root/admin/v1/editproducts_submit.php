<?php 
session_start();
?>
<?php
include_once('class/Repository.php');
include_once('Utility.php');

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

$strErr="";
$objDBClass=new Repository();
$objUtility=new Utility();
$objUtility->CheckSession();
$connectionServer="ecommerce";
$objDBClass->OpenConnection($connectionServer,$strErr);

if (!empty($_POST))
{
	$category=addslashes($_POST["category"]);
	$name=addslashes($_POST["name"]);
	$price=addslashes($_POST["Price"]);
	$description=addslashes($_POST["description"]);
	$specification=addslashes($_POST["Specification"]);
	$extrafeatures=addslashes($_POST["extrafeatures"]);
	$imagestatus=false;
	//echo($_FILES[$imagefileName]['name']);
	//die();
	if($_FILES['image_thumb']['name']!=""){
		$temptopid=GetTopId($objDBClass);
		$imageurl=$temptopid."_".$_FILES['image_thumb']['name'];
		$imagestatus=UploadImage('image_thumb',$temptopid);
		echo($imageurl);
	}
	$id=$_POST["hid"];
	$sqlupdate="";
	if($imagestatus)
	{
		//echo($imagestatus);
		$sqlupdate="update  Products set name='".$name."',price=".$price.",description='".$description."',specification='".$specification."',extrafeatures='".$extrafeatures."',imageurl='".$imageurl."',categoryid=".$category." where productid=".$id;
		//echo($sqlupdate);
	}
	else
	{
		//echo($imagestatus);
		$sqlupdate="update  Products set name='".$name."',price=".$price.",description='".$description."',specification='".$specification."',extrafeatures='".$extrafeatures."',categoryid=".$category." where productid=".$id;
		//echo($sqlupdate);
	}
		
	echo($sqlupdate);
	$objDBClass->ExecuteQuery($sqlupdate,$strErr);
	$objDBClass->CloseConnection();
	echo($strErr);
	//die();
	if($strErr=="")
	{
		
		
			echo("<script type='text/javascript'>alert('successfullyupdated');</script>"); 
			echo("<script>location.href = 'http://dealon.live/admin/v1/viewproducts.php';</script>");

		
	}
	else
	{
		
		echo($strErr);
	}
}

?>