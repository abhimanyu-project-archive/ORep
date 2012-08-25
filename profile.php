<html>


<head>

<link href="css/bootstrap.css" rel="stylesheet">
<?php   include 'connect_db.php';
        include 'mysql_class.php';
?>




<?php
	$user=$_POST["username"];
	$pass=$_POST["password"];

	if($user!=NULL && $pass!=NULL)
	{
		
		//$dbaccess=new mysql("userinfo");
		$parameter="username=\"".$user."\"";
		//echo $parameter;
		$query="SELECT * FROM userinfo WHERE " . $parameter . ";";
		global $con;
		$result=NULL;	
		$result = mysql_query($query, $con);	
		$row=mysql_fetch_array($result);
		if($row["passwordhash"]==$pass)
		{
			
			//user authenticated,give details
			$userid=$row["userid"];
			$gross=$row["globalpoint"];
			echo "welcome" . $user;
			echo $gross;	
			//$dbaccess=new mysql("$userid");
			$query="SELECT * FROM user_".$userid.";";
			$con; 
			$result=NULL;	
			$result1 = mysql_query($query, $con);
			echo $result1;
			$row1=mysql_fetch_array($result1);
			echo "  row1: " . $row1;
			while($row=mysql_fetch_array($result1))
			{
				echo "   1" . $row;	
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
<a href="signup.php" ><b>Register with Karma!</b></a>
</div>
</body>
</html>
