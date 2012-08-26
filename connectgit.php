<?php

	session_start();

	define('server', 'localhost');
	define('database', 'orep');
	define('username', 'orepuser');
	define('password', 'oi8yLU&789jbkl');



	// Connecting to the database

	$con = mysql_connect(server, username, password);
	$db = mysql_select_db(database, $con) or die("Unable to select database");

	$gituser = $_POST["gituser"];
	
	if(isset($gituser))
	{
		$username=$_SESSION['username'];
		$query = "select userid from userinfo where username='".$username."'";

		$result = mysql_query($query);
		$row = mysql_fetch_array($result);

		$query = "insert into gitusers values('".$row['userid']."', '".$gituser."')";
		mysql_query($query);		

		$query = "select siteid from siteapi where sitename='".$sitename."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$siteid = $row['siteid'];

		$query = "insert into user_".$userid."values($siteid, "opensource", "0");
		header('Location: http://orep.manyu.in/profile.php');
	}

	

?>


	<form id = "connectgit" action="connectgit.php" method='post' >
		Git UserName* : <input id = "gituser" name="gituser" type= "text" value=""/>

		<input id = "submit" name = "submit" type="submit" value="submit"/>

	</form>
