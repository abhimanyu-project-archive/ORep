<?php
//Author  : Mangat Rai Modi [mangatmodi@gmail.com]
//version : 1.0
//Updated : 15:43, 25,aug,2012
//Description : It changes/display points of the user

//GETTING VALUES FROM URL
$siteid = $_GET["siteid"];
$sitekey = $_GET["sitekey"];
$usid = $_GET["usid"];
$tag = $_GET["tag"];
$points = $_GET["points"];
$mysiteonly = $_GET["mysiteonly"];

//ADD POINTS
if(isset($points)){

}
//GET POINTS
else{
	echo "EMPTY POINTS!!";
}
?>
