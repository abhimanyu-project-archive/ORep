<?php
require_once('connect_db.php');
require_once('mysql_class.php');
require_once('basicfun.php');
$siteinfo =new mysql("siteinfo");
$ssidtable =new mysql("ssidtable");
function getssid()
{
    $result = array(
               'res' => false,
               'ssid' => "",
               'error' => "",
              );
    if(empty($_GET['siteid']))
    {
        $result['res']=false;
        $result['error']="SiteId Ommitted";

        return $result;
    }
    if(empty($_GET['sitekey']))
    {
        $result['res']=false;
        $result['error']="SiteKey Ommitted";
        return $result;
    }

    $siteid = $_GET['siteid'];
    $sitekey = $_GET['sitekey'];
    $qstring = "siteid='".$siteid."' AND "."sitekey='".$sitekey."'";
    //echo $qstring;	
    //$authtable=$siteinfo->select("*",$qstring);
    $query = "SELECT * FROM siteinfo WHERE " . $qstring . ";";
    global $con;
    $auth_table = NULL;
    $auth_table = mysql_query($query, $con);
    //echo $auth_table;
    if (!mysql_fetch_row($auth_table))
   {
	$result['res']=false;
        $result['error']="Authentication failed";
        return $result;
   }
   else
   {
	$ssid=random_gen(20);
	$qstring ="'".$siteid."','".$ssid."'";
	$query="INSERT into ssidtable values (".$qstring.");";	
	$insert_result=mysql_query($query,$con);
	$result['res']=true;
        $result['ssid']=$ssid;  
	return $result;
   }
}

$answer=getssid();

echo json_encode($answer);
?>
