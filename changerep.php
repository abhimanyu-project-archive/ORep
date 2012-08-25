<?php
//Author  : Mangat Rai Modi [mangatmodi@gmail.com]
//version : 1.0
//Updated : 15:43, 25,aug,2012
//Description : It changes/display points of the user

require_once('connect_db.php');
require('mysql_class.php');

//GETTING VALUES FROM URL
$siteid = $_GET["siteid"];
$sitekey = $_GET["sitekey"];
$usid = $_GET["usid"];
$tag = $_GET["tag"];
$points = $_GET["points"];
$mysiteonly = $_GET["mysiteonly"];

//ADD POINTS
if(isset($points)){
	//get if site has permission for that user
	$perm = new mysql("permission");
	$string = "siteid="."'".$siteid."'"." and siteuserid="."'".$usid."'";
	echo $string;
	$res = $perm->select('userid',$string);
	$num_rows = mysql_num_rows($res);
	if($num_rows > 0){
	   //now update further
	   $row = mysql_fetch_array($result);
	   $userid = $row['userid'];
	   $val = intval($points);

	   //UPDATE GROSS POINTS IN USERINFO
	   global $con;
	   if($val<0){
	   	$val = 0 - $val;
		echo $val;
	   	$string = "UPDATE userinfo SET globalpoint=globalpoint-".$val." WHERE userid="."'".$userid."'";
		mysql_query($string, $con);
	   }
	}
	else{
	   //return -1 tupple to show error
	   echo " EMPTY";
	}
}
//GET POINTS
else{
	echo "EMPTY POINTS!!";
}
?>
