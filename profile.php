<html>


<head>

<link href="css/bootstrap.css" rel="stylesheet">
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
			
			echo "<div align='right'><a href='logout.php'>Log Out</a></div>";
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
			echo "<br><br><div align='center'>";
			echo "<strong>welcome" . $user . "</strong>";
			echo "<br>";
			echo "<br><cite>Gross:" . $gross . "</cite>";	
			echo "</div>";	

			$query="SELECT siteid,SUM(points) FROM user_".$userid." GROUP BY siteid ORDER BY SUM(points) DESC;";
			$result=NULL;
			$result1=NULL;	
			$result1 = mysql_query($query, $con);
			echo "<table width=100%>";
			echo "<td> </td>";
			echo "<td align='center'>";
			while($row=mysql_fetch_array($result1))
			{
				$query="SELECT sitename  FROM siteapi WHERE siteid=" . $row["siteid"] . ";";	
				echo $query;	
				$result=mysql_query($query, $con);
				echo $result;
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
			echo "<td align='left'>";
                        while($row=mysql_fetch_array($result1))
                        {
                                
                                //echo "<br>SiteId:" . $row["siteid"];
                                echo "<br>" . $row["tag"];   
                                echo "   :";
				printf("%.2f",$row["SUM(points)"]);
                        }

			echo "</td></table>";
			die();
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
