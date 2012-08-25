    <html>
    <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<?php
		require_once('connect_db.php');
		require_once('mysql_class.php');
	?>


	<?php

		$user = $_POST["username"];
		$pass = $_POST["password"];
		$ssid = $_GET["ssid"];

		if(isset($ssid))		
		{
		$ssidaccess = new mysql("ssidtable");
		$parameter = "ssid=\"".$ssid."\"";

		$result = $ssidaccess -> select("*", $parameter);
		//$row = mysql_fetch_array($result);
		if(isset($result))
		{
			$row = mysql_fetch_array($result);
			$siteid = $row["siteid"];
			$parameter = "ssid=\"".$ssid."\"";
			$ssidaccess -> delete($parameter);

			if(isset($user) && isset($password))
			{
				$dbaccess = new mysql("userinfo");
				$parameter = "username=\"".$user."\"";
				$result = $dbaccess -> select("*", $parameter);
	
				$row = mysql_fetch_array($result);
				if($row["passwordhash"]==$pass)
				{
					//user authenticated
					$userid = $row["userid"];
					$dbaccess2 = new mysql("permission");
					

					while(1)
					{
						$siteuserid = random_gen(20);

						$parameter = "siteuserid=\"".$siteuserid."\"";
						$result = $dbaccess2 -> select("*", $parameter);

						$row = mysql_fetch_array($result);

						if(!isset($row["siteuserid"]))
						{
							$dbaccess2 -> insert(array($siteid, $userid, $siteuserid));
						}
					}
				}

				
			}
		}
		}

	?>
    </head>
    <body>
	

    <form id='login' action='login.php' method='post' accept-charset='UTF-8'>
	<fieldset >
		<div id = "loginform" align="center">
		<legend>Login</legend>
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		UserName*:<input type='text' name='username' id='username'  maxlength="50"/>
		Password*:<input type='password' name='password' id='password' maxlength="50"/>
		<br>
		<input type='submit' name='Submit' value='Submit'/>
		</div>
	</fieldset>
    </form>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://yui.yahooapis.com/3.6.0/build/yui/yui-min.js"></script>
    </body>
    </html>
