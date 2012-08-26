<html>
<head>

<link href="css/bootstrap.css" rel="stylesheet">
<?php
session_start();
unset($_SESSION['username']);
echo "<div align='center'>";
echo "<cite>Logged Out!</cite>";
echo "<br><strong><a href='profile.php'>Go to Login Page</a></strong>";
echo "</div>";
?>
</head>
</html>
