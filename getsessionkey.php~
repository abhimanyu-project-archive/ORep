<?php
require_once('connect_db.php');
require_once('mysql_class.php');
require_once('basicfun.php');
$siteinfo =new mysql("siteinfo");
$siteinfo =new mysql("ssidtable");
echo "Wow";
function getssid()
{
    $result = array(
               'res' => false,
               'ssid' => "",
               'error' => "",
              );
    echo "Boom";
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
    $siteid = SanitizeForSQL(trim($_GET['siteid']));
    $sitekey = SanitizeForSQL(trim($_GET['sitekey']));
    $qstring = "siteid=".$siteid." AND "."sitekey=".$sitekey;
    $authtable=siteinfo.select("*",$qstring);

   if (!(mysql_fetch_array($authtable)))
   {
	$result['res']=false;
        $result['error']="Authentication failed";
        return $result;
   }
   else
   {
	$ssid=random_gen(20);
	$qstring ="'".$siteid."','".$ssid."'";
	$ssidtable=siteinfo.insert($qstring);	
	$result['res']=true;
        $result['ssid']=$ssid;  
   }
}

$answer=getssid();

echo json_encode($answer);
?>
