    <?php
	require_once('basicfun.php');
	?>
	<html>
    <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    </head>

    <body>

	<?php
		define('server', 'localhost');
		define('database', 'orep');
		define('username', 'orepuser');
		define('password', 'oi8yLU&789jbkl');

		$con = mysql_connect(server, username, password);
		$db = mysql_select_db(database, $con) or die("Unable to select database")
		
	?>


	<?php

		$user = $_POST["username"];
		$pass = $_POST["password"];
		//$submitted = $_POST["submitted"];

		//echo $user. "   ". $pass . "\n";
		if(isset($user) && isset($pass))
		{
			$result=NULL;
			//$result = $dbaccess -> select("*", $parameter);
			
			$query = "select * from userinfo where username='".$user."'";
			//echo $query."\n";
			$result = mysql_query($query);

			//$row = mysql_fetch_array($result);
			$rows = mysql_num_rows($result);
			//echo "Rows: ";
			//echo $rows;
			if($rows > 0)
			{
				$usernameexists = "User Name Already Exists";

			}
			else
			{
				
				$usernameexists = "";
				//echo "generating uid\n";
				$userid = random_gen(20);
				//echo "userid: ". $userid. "\n";

				while(1)
				{
					$query = "select * from userinfo where userid='".$userid."'";
					//echo $query."\n";
					$result = mysql_query($query);

					$row = mysql_fetch_array($result);

					if(empty($row["userid"]))
					{
						$query = "insert into userinfo values('".$userid."', '".$user."', '0', '".md5($pass)."')";
						//echo $query."\n";
						mysql_query($query);

						$query = "create table user_".$userid." (siteid char(20), 
											tag varchar(50), 
											points float)";
						//echo $query."\n";
						mysql_query($query);
						echo "successfully registered";
						header('Location: http://orep.manyu.in');
						//die('');
						break;
					}
				}
			}

				
		}

	?>
	

    <form id='signup' action='signup.php' method='post' accept-charset='UTF-8'>
	<fieldset >
		<div id = "signupform" align="center">
		<legend>Register</legend>
		<font color = "Red"><h4><?=$usernameexists?></h4></font>
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
