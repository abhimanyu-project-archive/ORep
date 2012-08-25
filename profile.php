<html>


<head>

<link href="css/bootstrap.css" rel="stylesheet">
<?php
   require_once('mysql_class.php');
?>





<?php
	$user=$_POST["username"];
	$pass=$_POST["password"];
	
	if(isset($user) && isset($password))
	{
		$dbaccess=new mysql("userinfo");
		$parameter="username=\"".$user."\"";
		$result=$dbaccess->select("*",$parameter);	
		$raw=mysql_fetch_array($result);
		if($row["passwordhash"]==$pass)
		{
			//user authenticated,give details
			$userid=$row["userid"];
			$gross=$row["globalpoint"];
			echo "welcome" + $user;
			echo $gross;	
			$dbaccess=new mysql("$userid");
			$result=$dbaccess->select("*");			
			while($row=mysql_fetch_array($result))
			{
				echo $row["siteid"];
				echo $row["tag"];	
				echo $row["points"];
			}
			
		}
	}

?>
</head>
<body>

<form id='login' action='profile.php' method='post' accept-charset='UTF-8'>
        <fieldset >
                <div id = "loginform" align="center">
                <legend>Login</legend>
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                UserName*: &nbsp <input type='text' name='username' id='username'  maxlength="50"/>
                <br>
                Password*&nbsp&nbsp: &nbsp <input type='password' name='password' id='password' maxlength="50"/>
                <br>
                <input type='submit' name='Submit' value='Submit'/>
                </div>
        </fieldset>
    </form>

<br>
<br>
<div align="center">
<a href="http://localhost/ORep/register.php" ><b>Register with Karma!</b></a>
</div>
</body>
</html>
