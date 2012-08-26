<html>
<head>

<link href="css/bootstrap.css" rel="stylesheet">
<?php
session_start();
unset($_SESSION['username']);
echo "<div align='center'>";
echo "Logged Out!";
echo "<a href='profile.php'>Go to Login Page</a>";
echo "</div>";
?>
</head>
</html>
