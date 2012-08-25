    <html>
    <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<?php
		require_once('basicfun.php');
		define('server', 'localhost');
		define('database', 'orep');
		define('username', 'orepuser');
		define('password', 'oi8yLU&789jbkl');



		// Connecting to the database
		$con = mysql_connect(server, username, password);
		$db = mysql_select_db(database, $con) or die("Unable to select database");
	?>


	<?php

		$user = $_POST["username"];
		$pass = $_POST["password"];
		$ssid = $_POST["ssid"];
		$ssid1 = $_GET["ssid"];
		$submitted = $_POST["submitted"];

		if(isset($ssid1))
		{
			$ssid = $ssid1;
		}

		if(isset($ssid) || isset($submitted))		
		{
			//$ssidaccess = new mysql("ssidtable");
			$query = "select * from ssidtable where ssid='".$ssid."'";
			//$parameter = "ssid=\"".$ssid."\"";

			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);
			//$row = mysql_fetch_array($result);
			if($num_rows > 0)
			{
				$row = mysql_fetch_array($result);
				$siteid = $row["siteid"];
				//$query = "update ssidtable set userid=".$where ssid='".$ssid."'";
				//$parameter = "ssid='".$ssid."'";
				//$ssidaccess -> delete($parameter);
				//mysql_query($query);

				if(isset($user) && isset($password))
				{
					//$dbaccess = new mysql("userinfo");
					//$parameter = "username='".$user."'";
					$query = "select * from userinfo where username='".$user."'";
					//$result = $dbaccess -> select("*", $parameter);
					$result = mysql_query($query);
	
					$row = mysql_fetch_array($result);
					if($row["passwordhash"]==md5($pass))
					{
						//user authenticated
						$userid = $row["userid"];
						//$dbaccess2 = new mysql("permission");
						$query_part = "select * from permission where siteuserid='";
						

						while(1)
						{
							$siteuserid = random_gen(20);

							$query = $query_part.$siteuserid."'";
							//$parameter = "siteuserid='".$siteuserid."'";
							//$result = $dbaccess2 -> select("*", $parameter);

							$result = mysql_query($query);
							$rows = mysql_num_rows($result);
							//$row = mysql_fetch_array($result);

							if(!($rows>0))
							{
								$query = "insert into permission values('".$siteid."', '".$userid."','".$siteuserid."')";
								mysql_query($query);
								$query = "update ssidtable set userid='".$siteuserid."' where ssid='".$ssid."'";
								mysql_query($query);
								break;
							}
						}
					}

				
				}
			}
		}
		else
		{
			die("you are not permitted to acces this page on the server");
		}

	?>
    </head>
    <body>
	

    <form id='login' action='login.php' method='post' accept-charset='UTF-8'>
	<fieldset >
		<div id = "loginform" align="center">
		<legend>Login</legend>
		<input type = 'hidden' name = "ssid" value = <?=$ssid?>/>
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		UserName*:&nbsp <input type='text' name='username' id='username'  maxlength="50"/>
		<br>

		Password*&nbsp &nbsp: &nbsp <input type='password' name='password' id='password' maxlength="50"/>
		<br>
		<input type='submit' name='Submit' value='Submit'/>
		</div>
	</fieldset>
    </form>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://yui.yahooapis.com/3.6.0/build/yui/yui-min.js"></script>
    </body>
    </html>
