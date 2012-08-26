
<body bgcolor=#C0C0C0>
<?php


	session_start();

	define('server', 'localhost');
	define('database', 'orep');
	define('username', 'orepuser');
	define('password', 'oi8yLU&789jbkl');

	echo"
	<center><Legend>Connecting to GitHub</Legend></center>
	<hr>";
	// Connecting to the database

	$con = mysql_connect(server, username, password);
	$db = mysql_select_db(database, $con) or die("Unable to select database");

	$gituser = $_POST["gituser"];
	
	if(isset($gituser))
	{
		$username=$_SESSION['username'];
		$query = "select userid from userinfo where username='".$username."'";
		//echo $query;
	
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$userid = $row['userid'];

		$query = "insert into gitusers values('".$userid."', '".$gituser."')";
		//echo $query;
		mysql_query($query);		


		$query = "select siteid from siteapi where sitename='github'";
		//echo $query;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$siteid = $row['siteid'];

		$query = "insert into user_".$userid." values('".$siteid."', 'opensource', '0.0')";
		//echo $query;
		mysql_query($query);
		header('Location: http://orep.manyu.in/profile.php');
	}

	

?>


	<form id = "connectgit" action="connectgit.php" method='post' >
		Git UserName* : <input id = "gituser" name="gituser" type= "text" value=""/>

		<input id = "submit" name = "submit" type="submit" value="submit"/>

	</form>

</body>
