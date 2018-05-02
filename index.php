<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    include("config.php");
    if(isset($_POST['submit'])) {
        $password=$_POST['txt_password'];
        $email=$_POST['txt_email'];
        $pwd = md5($password);
        if($email != '' && $password != ''){
                $checkuser = "SELECT * FROM user WHERE email='$email' OR password='$password'";
                $res = mysqli_query($con,$checkuser);
                $user =  mysqli_fetch_assoc($res);
                //print_r($user);
                if($user>0){
                    $_SESSION['userdata'] = $user;
                    header('location:welcome.php');
                } else {
                    $_SESSION['err'] = "UserName and Password does not Match";
                }
        } else {
            $_SESSION['err'] = "Enter Required field.";
        }
    }
?>
    <div class="container">
        <div class="content">
            <h2>Login</h2>
            <?php if(isset($_SESSION['err'])) { echo $_SESSION['err']; unset($_SESSION['err']); } ?>
            <h3>Don't have an account click <a href="registration.php">here. </a> to signup</h3>
            <div class="add-form">
            	<form action="" method="POST" name="registration" enctype="multipart/form-data">
                	<table>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="txt_email" required placeholder="Enter your email"/></td>
                        </tr>
                        <tr>
                        	<td>Password</td>
                            <td><input type="password" name="txt_password" required placeholder="Enter Password"/</td>
                        </tr>
            	        <tr>
                        	<td></td>
                            <td><input type="submit" name="submit" value="Submit"   />
                            <input type="reset" name="reset" value="Clear" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>