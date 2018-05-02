<?php
session_start();
if(!isset($_SESSION["userdata"])){
header("Location: index.php");
exit(); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="list-box">
                <h2>Welcome <?php print_r($_SESSION['userdata']['username']); ?></h2>
                <a href="list.php">User List</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>