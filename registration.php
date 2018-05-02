<?php

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
    
        $id=$_POST['id'];
        $name=$_POST['txt_uname'];
        $password=$_POST['txt_password'];
        $ConfirmPassword = $_POST['ConfirmPassword'];
        $gender=$_POST['radio_gender'];
        $email=$_POST['txt_email'];
        $address=$_POST['txtarea_info'];
        $city=$_POST['city'];
        $tech=implode(',',$_POST['technology']);
        
        if($name != '' && $email != '' && $password != '' && $password != ''){
            if($password == $ConfirmPassword){
                $checkuser = "SELECT * FROM user WHERE username='$name' OR email='$email'";
                $res = mysqli_query($con,$checkuser);
                $user =  mysqli_fetch_assoc($res);
                //print_r($user);
                if($user>0){
                    $_SESSION['err'] = "User already exist";    
                } else {
                    $pwd = md5($_POST['txt_password']);
                    $filename=$_FILES['image']['name'];
                    $filetmpname=$_FILES['image']['tmp_name'];  
                    $target_dir="upload/";
                    $path=$target_dir.$filename;    
                        //$target_file=$target_dir.basename($_FILES['image']['name']);
                        
                    move_uploaded_file($filetmpname,$path);
                    $query1="INSERT into user (username,password,gender,email,address,city,technology,image) VALUES ('$name','$pwd','$gender','$email','$address','$city','$tech','$filename')";   
                    mysqli_query($con,$query1);
                    header("location:index.php");
                    $_SESSION['err'] = "Register successfully";
                }
            } else {
                $_SESSION['err'] = "Password not match";    
            }
        } else {
            $_SESSION['err'] = "Enter Required field.";
        }
    }
?>
    <div class="container">
        <div class="content">
            <h2>Registration</h2>
            <h3>Already have an account? Login in <a href="index.php"> here.</a></h3>
            <?php if(isset($_SESSION['err'])) { echo $_SESSION['err']; } ?>
            <div class="add-form">
            	<form action="" method="POST" name="registration" enctype="multipart/form-data" onsubmit="return formValidation()">
                	<table>
                    <tr>
                    	<td><input type="hidden" name="id" value="<?php echo $id; ?>"/></td>
                    </tr>
                    	<tr>
                        	<td>Username</td>
                            <td><input type="text" name="txt_uname" id="username" required placeholder="Enter your name"/></td><td id="message"></td>
                            
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="txt_email" required placeholder="Enter your email"/></td>
                        </tr>
                        <tr>
                        	<td>Password</td>
                            <td><input type="password" name="txt_password" required placeholder="Enter Password"/</td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" name="ConfirmPassword" required placeholder="Confirm Password"/</td>
                        </tr>
                        <tr>
                        	<td>Gender</td>
                            <td><input type="radio" name="radio_gender" required checked value="Male" />Male<input type="radio" name="radio_gender" value="Female"/>Female
                            </td>
                        </tr>
                        <tr>
                        	<td>Language</td>
                            <td><input type="checkbox" name="technology[]" checked  value="PHP" />PHP
                            <input type="checkbox" name="technology[]"  value="JAVA" />JAVA
                            <input type="checkbox" name="technology[]" value="RUBY" />RUBY
                            </td>
                        </tr>
                        <tr>
                        	<td>City</td>
                            <td><select id="ct" name="city">
                            	<option value=""></option>
                            	<option value="Ahmedabad" selected>Ahmedabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Valsad">Valsad</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Rajkot">Rajkot</option>
                            </select></td>
                        </tr>
                        
                        <tr>
                        	<td>Address</td>
                            <td><textarea rows="5" cols="20" name="txtarea_info" required></textarea></td>
                        </tr>
                        
                        <tr>
                            <td>Image</td>
                        	<td><input type="file"  name="image" required id="image"/></td>
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