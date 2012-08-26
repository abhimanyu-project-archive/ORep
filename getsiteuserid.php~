<?php
require_once('connect_db.php');
require_once('mysql_class.php');
require_once('basicfun.php');
function getssid()
{
    $result = array(
               'res' => false,
               'ssid' => "",
               'error' => "",
              );
    if(empty($_GET['ssid']))
    {
        $result['res']=false;
        $result['error']="SSid Ommitted";
    }
    $ssid = $_GET['ssid'];
    $qstring = "ssid='".$ssid."'";
    //echo $qstring;	
    //$authtable=$siteinfo->select("*",$qstring);
    $query = "SELECT * FROM ssidtable WHERE " . $qstring . ";";
    global $con;
    $auth_table = NULL;
    $auth_table = mysql_query($query, $con);
    //echo $auth_table;
    if ($row=mysql_fetch_array($auth_table);)
   {
	$result['res']=false;
        $result['error']="Authentication failed";
        return $result;
   }
   else
   {
	$result['res']=true;
        $result['suid']=$row['siteuserid'];  
	return $result;
   }
}

$answer=getssid();

echo json_encode($answer);
?>
