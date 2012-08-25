    <html>
    <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<?php
		define('server', 'localhost');
		define('database', 'orep');
		define('username', 'orepuser');
		define('password', 'oi8yLU&789jbkl');

		$con = mysql_connect(server, username, password);
		$db = mysql_select_db(database, $con) or die("Unable to select database")

		//include 'mysql_class.php';
	?>


	<?php

		$user = $_POST["username"];
		$pass = $_POST["password"];
		//$submitted = $_POST["submitted"];

		echo $user. "   ". $password . "\n";
		if(isset($user) && isset($password))
		{
			$result=NULL;
			//$result = $dbaccess -> select("*", $parameter);
			
			$query = "select * from userinfo where username='".$user."'";
			echo $query."\n";
			$result = mysql_query($query);

			$row = mysql_fetch_array($result);
			if(!empty($row))
			{
				echo "The username already exists";
			}
			else
			{

				$userid = random_gen(20);
				echo "userid: ". $userid. "\n";

				while(1)
				{
					$query = "select * from userinfo where userid='".$userid."'";
					echo $query."\n";
					$result = mysql_query($query);

					$row = mysql_fetch_array($result);

					if(empty($row["userid"]))
					{
						$query = "insert into userinfo values('".$userid."', '".$username."', '-1', '".md5($pass)."')";
						echo $query."\n";
						mysql_query($query);
						echo "successfully inserted";
						break;
					}
				}
			}

				
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
