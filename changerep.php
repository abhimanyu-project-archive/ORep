<?php
//Author  : Mangat Rai Modi [mangatmodi@gmail.com]
//version : 1.3.1
//Updated : 04:17	 26,aug,2012
//Description : It changes/display points of the user

require_once('connect_db1.php');//Change when hosted  server!!
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
	//get if site has permission for that user
$perm = new mysql("permission");
$siteinfo = new mysql("siteinfo");
$string = "siteid="."'".$siteid."'"." and siteuserid="."'".$usid."'";
$string3 = "siteid="."'".$siteid."'"." and sitekey="."'".$sitekey."'";
//echo $string3;
//Validating site
$res3 = $siteinfo->select('weight',$string3);
$num_rows3 = mysql_num_rows($res3);
if($num_rows3 > 0){//SITE IS VALID
	$res = $perm->select('userid',$string);
	$num_rows = mysql_num_rows($res);
	if($num_rows > 0){
	   //now update further
	   $row = mysql_fetch_array($res);
	   $userid = $row['userid'];
	 if(isset($points)){
	   //ADD POINTS;
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
	  // echo $num_rows_site;
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
	//	echo $string_insert;
		//echo $string;
		if($flag_site == 1){
			mysql_query($string_insert, $con);
		}
		mysql_query($string, $con);
	   }
	   else{

	   	$string = "UPDATE userinfo SET globalpoint=globalpoint+".$val." WHERE userid="."'".$userid."'";
	  	$string_insert = "UPDATE ".$temp." SET points=points+".$tempoints." WHERE siteid="."'".$siteid."' and tag="."'".$tag."'";
	//	echo $string_insert;
		//echo $string;
		if($flag_site == 1){
			mysql_query($string_insert, $con);
		}
		mysql_query($string, $con);
	   }
	
	}
	//GET POINTS
	else{
	   	$temp = "user_".$userid;
		$mysite = $_GET["mysiteonly"];
	//	echo "EMPTY POINTS!!";
		$tag_array = explode(",",$tag);
		//echo $tag_array[1];

		//**GET GROSS POINTS**//
		$query1 = "select globalpoint from userinfo where userid="."'".$userid."'";
		$ans = mysql_fetch_array(mysql_query($query1, $con));
		$global =  $ans['globalpoint'];
		//**DONE GROSS**//

		//** GROSS SITE POINTS **//
		$query2 = "SELECT SUM( points ) AS OrderTotal FROM ".$temp." WHERE siteid = '".$siteid."'";
	//	echo $query2;
		$ans2 = mysql_fetch_array(mysql_query($query2, $con));
		$gross_site =  $ans2['OrderTotal'];
		if($mysite == 1){ //SITE ONLY
		
		//CREATING THE TAG QUERY STRING
		$total = count($tag_array);
		$n =0;
		$tag_string = "";
		while($n < $total-1){
		$tag_string = $tag_string.$tag_array[$n]."'||tag='";
		$n = $n + 1;
		}
		$tag_string = $tag_string.$tag_array[$total-1];
//		echo $tag_string;
		
		//-------------------------
		$query3 = "SELECT SUM( points ) AS OrderTotal FROM ".$temp." WHERE siteid = '".$siteid."' && ( tag='".$tag_string."')";
		//echo $query3;
		$ans3 = mysql_fetch_array(mysql_query($query3, $con));
		$sum =  $ans3['OrderTotal'];
	//	echo $sum;
		
		//NOW GETTING TABLE OF GIVEN TAGS FOR THE SITE
		$query4 = "SELECT tag,points FROM ".$temp." WHERE siteid = '".$siteid."' && ( tag='".$tag_string."')";
		echo $query4;
		$tag_res = mysql_query($query4, $con);
		$site_tags = array();
		while($ans4 = mysql_fetch_array($tag_res)){
			$tag_temp = $ans4['tag']; //we have to push tag => points
			$site_tags[$tag_temp] = $ans4['points'];
			}
		echo json_encode($site_tags);
		}
	}
	}	
	else{
	   //return -1 tupple to show error, SITE DON"T HAVE ACCESS TO USER
	   echo " EMPTY";$flag = -1;
	}
	}
	else{$flag = -2; echo "Sitefraud";}//SITE FRAUD
	if($flag == 0){
	   $arr = array ('result'=>'Y');
	   echo json_encode($arr);
	
	}
	elseif($flag == -2){
	   $arr = array ('result'=>'N','error'=>'Not a valid Site Key');	
	   echo json_encode($arr);
	}
	elseif($flag == -1){
	   $arr = array ('result'=>'N','error'=>'Site don\'t have access to the user records');	
	   echo json_encode($arr);
	}



?>
