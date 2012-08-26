<html>


<head>

<link href="css/bootstrap.css" rel="stylesheet">
</head>

<body bgcolor="#C0C0C0">

<?php 
	 session_start();
	 include 'connect_db.php';
        //include 'mysql_class.php';
?>




<?php
	$flag = false;

	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
		$flag = true;
	}
	else
	{
		$user=$_POST["username"];
		$pass=$_POST["password"];

		$pass=md5($pass);
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
			$flag = true;
		}
		}
	}
		if($flag == true)
		{
				
			echo '<div align="right"><a href=\'logout.php\'>Log Out</a></div>';
			echo "Connect to:<a href='connectgit.php'>GitHub</a>";

			$parameter="username=\"".$user."\"";
			//echo $parameter;
			$query="SELECT * FROM userinfo WHERE " . $parameter . ";";
			global $con;
			$result=NULL;	
			$result = mysql_query($query, $con);	
			$row=mysql_fetch_array($result);

			$_SESSION['username'] = $user;
			$userid=$row["userid"];
			$gross=$row["globalpoint"];


			$query = "select siteid from siteapi where sitename='github'";
			//echo $query;
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			$gitsiteid = $row['siteid'];

			$query = "select gituserid from gitusers where userid='".$userid."'";
			//echo $query;
			$result = mysql_query($query);
			$rows = mysql_num_rows($result);
			if($rows > 0)
			{
				$row = mysql_fetch_array($result);
				$gituserid = $row['gituserid'];

				$ch = curl_init();

			        $url = "https://api.github.com/users/".$gituserid."/followers";

        			curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			        $json = curl_exec($ch);
			        curl_close($ch);
			        $obj = json_decode($json);

			        //echo $json."\n";

			        $numFollowers = count($obj);
			       // echo $numFollowers;

				$query = "select points from user_".$userid." where tag = 'opensource'";
				//echo $query;
				$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				$row = mysql_fetch_array($result);
				if(!($rows == 0))
					$points = $row['points'];
				else
					$points = 0;

				$query = "update user_".$userid." set points='".$numFollowers."' where tag = 'opensource'";
				//echo $query;
				mysql_query($query);
			
				$query = "update userinfo set globalpoint=globalpoint-'".$points."' + '".$numFollowers."' where userid='".$userid."'";
				//echo $query;
				mysql_query($query);
			}
			

			


			echo "<br><br><div style='backgournd:gray' align='center'>";
			echo "<strong>Welcome " . $user . "</strong>";
			echo "<hr></div>";
			
			echo "<div align='center'><br>";
			echo "<br><cite>Gross:" . $gross . "</cite>";	
			echo "</div>";
			$query="SELECT siteid,SUM(points) FROM user_".$userid." GROUP BY siteid ORDER BY SUM(points) DESC;";
			$result=NULL;
			$result1=NULL;	
			$result1 = mysql_query($query, $con);
			echo "<table width=100%>";
			
			echo "<td align='center'>";
			while($row=mysql_fetch_array($result1))
			{
				$query="SELECT sitename  FROM siteapi WHERE siteid='" . $row["siteid"] . "';";	
				$result=mysql_query($query, $con);
				$row1=mysql_fetch_array($result);
				echo "<br>" . $row1["sitename"];
				//echo "<br>Area Tag:" . $row["tag"];	
				echo "   :";
				printf("%.2f",$row["SUM(points)"]);
			}
			echo "</td>";
			$query="SELECT tag,SUM(points) FROM user_".$userid." GROUP BY tag ORDER BY SUM(points) DESC;";
                        $result1=NULL; 
				  
                        $result1 = mysql_query($query, $con);
			echo "<td align='center'>";
                        while($row=mysql_fetch_array($result1))
                        {
                                
                                //echo "<br>SiteId:" . $row["siteid"];
                                echo "<br>" . $row["tag"];   
                                echo "   :";
				printf("%.2f",$row["SUM(points)"]);
                        }

			echo "</td></table>";
			echo "</br></br></br></hr>";
			die();
		}
	

?>

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
<a href="signup.php" ><b>Register with ORep!</b></a>
</div>

<hr>
</body>
</html>
