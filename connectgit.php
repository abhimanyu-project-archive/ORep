<?php

	session_start();

	$gituser = $_POST["gituser"];
	
	if(isset($gituser))
	{
		
	}

	

?>


	<form id = "connectgit" action="connectgit.php" method='post' >
		Git UserName* : <input id = "gituser" name="gituser" type= "text" value=""/>

		<input id = "submit" name = "submit" type="submit" value="submit"/>

	</form>
