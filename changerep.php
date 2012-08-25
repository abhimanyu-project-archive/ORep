<?php
//Author  : Mangat Rai Modi [mangatmodi@gmail.com]
//version : 1.3
//Updated : 23:02	 25,aug,2012
//Description : It changes/display points of the user

require_once('connect_db1.php');
require('mysql_class.php');

//GETTING VALUES FROM URL
$siteid = $_GET["siteid"];
$sitekey = $_GET["sitekey"];
$usid = $_GET["usid"];
$tag = $_GET["tag"];
$points = $_GET["points"];
$mysiteonly = $_GET["mysiteonly"];
$flag = 0; //denotes an error
$flag_site = 0;
//ADD POINTS
if(isset($points)){
	//get if site has permission for that user
	$perm = new mysql("permission");
	$siteinfo = new mysql("siteinfo");
	$string = "siteid="."'".$siteid."'"." and siteuserid="."'".$usid."'";
	$string3 = "siteid="."'".$siteid."'"." and sitekey="."'".$sitekey."'";
	//echo $string3;
	//Validating site
	$res3 = $siteinfo->select('weight',$string3);
	$num_rows3 = mysql_num_rows($res3);
	if($num_rows3 > 0){
	$res = $perm->select('userid',$string);
	$num_rows = mysql_num_rows($res);
	if($num_rows > 0){
	   //now update further
	   $row = mysql_fetch_array($res);
	   $userid = $row['userid'];
	   $val = intval($points);
	   //UPDATE GROSS POINTS IN USERINFO
	   global $con;
	   $query = "select weight from siteinfo where siteid="."'".$siteid."'";
	  // echo $query;
	   $res1 = mysql_query($query, $con);
	   $row1 = mysql_fetch_array($res1);
	   $weight = $row1['weight'];
	  // echo $weight;
	   $val = round(floatval($weight) * $val);
	 //  echo"-->".$val;

	//**prepare for UID Table
	   $temp = "user_".$userid;
	   $user_table = new mysql($temp);
	   $string_check = "siteid="."'".$siteid."'"." and tag="."'".$tag."'";
	   $result_site = $user_table->select('tag',$string_check);//CHECK IF TAG EXISTS
	   $tempoints = intval($points);
	   $num_rows_site = mysql_num_rows($result_site);
	   echo $num_rows_site;
	   if($num_rows_site > 0){$flag_site = 1;}//IT EXISTS, UPDATE ONLY
	   else{
		 //echo "DONT EXIST";
		$string_insert = "'".$siteid."','".$tag."',".$tempoints;
		$user_table->insert($string_insert);	
		
	   }
	   //**ENDS

	   if($val<0){
	   	$val = 0 - $val;
		$tempoints = 0 - $tempoints;
		//echo $val;
	   	$string = "UPDATE userinfo SET globalpoint=globalpoint-".$val." WHERE userid="."'".$userid."'";
	   	$string_insert = "UPDATE ".$temp." SET points=points-".$tempoints." WHERE siteid="."'".$siteid."' and tag="."'".$tag."'";
		echo $string_insert;
		//echo $string;
		if($flag_site == 1){
			mysql_query($string_insert, $con);
		}
		mysql_query($string, $con);
	   }
	   else{

	   	$string = "UPDATE userinfo SET globalpoint=globalpoint+".$val." WHERE userid="."'".$userid."'";
	  	$string_insert = "UPDATE ".$temp." SET points=points+".$tempoints." WHERE siteid="."'".$siteid."' and tag="."'".$tag."'";
		echo $string_insert;
		//echo $string;
		if($flag_site == 1){
			mysql_query($string_insert, $con);
		}
		mysql_query($string, $con);
	   }
	
	}
	else{
	   //return -1 tupple to show error, SITE DON"T HAVE ACCESS TO USER
	   echo " EMPTY";$flag = -1;
	}
	}
	else{$flag = -1; echo "Sitefraud";}//SITE FRAUD
}
//GET POINTS
else{
	echo "EMPTY POINTS!!";
}
?>
