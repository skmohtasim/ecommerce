<?php
class Utility
{
	function SetJSONFileName($categoryId)
	{
		if($categoryId!= NULL && $categoryId!="")
		{
			$categoryId=(int)$categoryId;
		}
		switch ($categoryId) {
			case 1:
				return "Animals";
				break;
			case 4:
				return "Animals";
				break;
			default:
				echo "Your favorite color is neither red, blue, nor green!";
		}
	}


	
	
	function CheckSession()
	{
		if($_SESSION["userid"]!="" && $_SESSION["userid"]!=NULL)
		{
			
			//echo("no session");
			if(is_numeric($_SESSION["userid"])!=1)
			{

				echo("<script>location.href = 'http://dealon.live/admin/v1/index.php';</script>");
			}

			
		}
		else
		{
			echo("<script>location.href = 'http://dealon.live/admin/v1/index.php';</script>");
			
		}
	}
	
	
	function SetSession($dbid,$name)
	{
		$_SESSION["userid"] = $dbid;
		$_SESSION["uname"] = $name;
		$cookie_name = "userid";
		$cookie_value = $dbid;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		echo("<script>location.href = 'http://dealon.live/admin/v1/viewpostedproducts.php';</script>");

	}
	
	function DateFormat($myDATE)
	{
		$timestamp = strtotime($myDATE);
		$ret=date('d/m/Y', $timestamp);
		return $ret;
	}
	
	function EnglishToBanglaNumber ($number)
	{
		$replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
		$search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
		$en_number = str_replace($search_array, $replace_array, $number);
	
		return $en_number;
	}
	
	function GetBanglaMonthName($monthnumber)
	{
		$monthnumber=(int)$monthnumber;
		$montharray=array("জানুয়ারী","জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "অগাস্ট", "সেপ্টেম্বর", "অক্টোবর","নভেম্বর", "ডিসেম্বর");
		return $montharray[$monthnumber];
	}
	
	function GetBanglaFullDate($postingdate)
	{
		$month = date("m",strtotime($postingdate));
		$day = date("d",strtotime($postingdate));
		$year = date("Y",strtotime($postingdate));
		$fpostingdate="";
		$fpostingdate=$this->EnglishToBanglaNumber($day)." ".$this->GetBanglaMonthName($month)." ".$this->EnglishToBanglaNumber($year);
		return $fpostingdate;
	}
	
	function GetBanglaFullDateNumeric($postingdate)
	{
		$month = date("m",strtotime($postingdate));
		$day = date("d",strtotime($postingdate));
		$year = date("Y",strtotime($postingdate));
		$fpostingdate="";
		$fpostingdate=$this->EnglishToBanglaNumber($day)."-".$this->EnglishToBanglaNumber($month)."-".$this->EnglishToBanglaNumber($year);
		return $fpostingdate;
	}
	
	function NullToEmpty($myvar)
	{
		if($myvar === NULL)
		{
			$myvar="";
		}
		return $myvar;
	}
	
	function GetDayDifference($startdate,$enddate)
	{
		$dStart = new DateTime($startdate);
	   	$dEnd  = new DateTime($enddate);
	   	$dDiff = $dStart->diff($dEnd);
	   	//echo $dDiff->format('%R'); // use for point out relation: smaller/greater
	   	return $dDiff->days;
	}
}

?>