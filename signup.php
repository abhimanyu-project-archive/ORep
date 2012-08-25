    <html>
    <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<?php
		include 'connect_db.php';
		include 'mysql_class.php';
	?>


	<?php

		$user = $_POST["username"];
		$pass = $_POST["password"];
		$submitted = $_POST["submitted"];


		if(isset($user) && isset($password))
		{
			$dbaccess = new mysql("userinfo");
			$parameter = "username=\"".$user."\"";
			$result = $dbaccess -> select("*", $parameter);

			$row = mysql_fetch_array($result);
			if(!empty($row))
			{
				echo "The username already exists";
			}
			else
			{

				$userid = random_gen(20);

				while(1)
				{
					$parameter = "userid='".$userid."'";
					

					$result = $dbaccess -> select("*", $parameter);

					$row = mysql_fetch_array($result);

					if(!isset($row["userid"]))
					{
						$dbaccess -> insert(array($userid, $username, -1, md5($pass)));
						break;
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
	

    <form id='signup' action='signup.php' method='post' accept-charset='UTF-8'>
	<fieldset >
		<div id = "signupform" align="center">
		<legend>Login</legend>
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
