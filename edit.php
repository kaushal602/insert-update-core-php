<?php
include 'config.php';
	if(isset($_POST['update']))
	{
			$id=$_POST['id'];
			$name=$_POST['txt_uname'];
			$gender=$_POST['radio_gender'];
			$email=$_POST['txt_email'];
			$address=$_POST['txtarea_info'];
			$city=$_POST['city'];
			$tech=implode(',',$_POST['technology']);
			if($_FILES['image']['name'] != '') {
				$filename=$_FILES['image']['name'];
				$filetmpname=$_FILES['image']['tmp_name'];
				$target_dir="upload/";	
				$uploadOk=1;
				$path=$target_dir.$filename;
				
				move_uploaded_file($filetmpname,$path);
			} else {
                $filename = $_POST['oldimg'];
            }
			$query="UPDATE user SET username='".$name."',gender='".$gender."',email='".$email."',address='".$address."',city='".$city."',technology='".$tech."',image='".$filename."' where id='".$id."' ";
			
			mysqli_query($con,$query);
			header("Location:list.php");
		}

?>
<?php
		$id=$_GET['id'];
		$query2="SELECT * FROM user WHERE id=$id";
		$result=mysqli_query($con,$query2);
		
		while ($res=mysqli_fetch_assoc($result))
		{
			 $name=$res['username'];
			 $gen=$res['gender'];
			 $email=$res['email'];
			 $address=$res['address'];
			 $city=$res['city'];
			 $tech=explode(',',$res['technology']);
			 $filename=$res['image'];
			 $path=$res['image'];
			 
				

			}
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="content">
    <form action="edit.php" method="post" enctype="multipart/form-data">
        	<table>
            	<tr>
                	<td><input type="hidden" required  name="id" value="<?php echo $id;?>" /></td>
                </tr>
            
            	<tr>
                	<td>Username</td>
                    <td><input type="text" required name="txt_uname" value="<?php echo $name;?>"/></td>
                    
                </tr>
                <tr>
                	<td>Email</td>
                    <td><input type="email" required name="txt_email" value="<?php echo $email;?>"/></td>
                </tr>
                <tr>
                	<td>Gender</td>
                    <td><input type="radio" name="radio_gender" value="Male" <?php echo ( $gen=='Male') ? "checked" : ""; ?>/>Male					                    <input type="radio" name="radio_gender" value="Female" <?php echo ( $gen=='Female') ? "checked" : ""; ?>/>Female</td>
                </tr>
                <tr>
                	<td>Language</td>
                    <td><input type="checkbox" name="technology[]"  value="PHP" <?php foreach($tech as $technology){ if($technology=="PHP") { echo "checked='checked'";}} ?>/>PHP
                        <input type="checkbox" name="technology[]"  value="JAVA" <?php foreach($tech as $technology) {if($technology=="JAVA") { echo "checked='checked'";}}?> />JAVA
                        <input type="checkbox" name="technology[]" value="RUBY" <?php foreach($tech as $technology) {if($technology=="RUBY") { echo "checked='checked'";}}?> />RUBY 
                    </td>
                </tr>
                <tr>
                	<td>City</td>
                    <td><select name="city" >
                    	
                    	<option id="1" value="Ahmedabad" <?php echo($city=="Ahmedabad") ? "selected" : ""; ?>>Ahmedabad</option>
                        <option id="1" value="Surat" <?php echo($city=="Surat")  ? "selected" : ""; ?> >Surat</option>
                        <option id="1" value="Valsad" <?php echo($city=="Valsad") ? "selected" : ""; ?>>Valsad</option>
                        <option id="1" value="Baroda" <?php echo($city=="Baroda") ? "selected" : ""; ?>>Baroda</option>
                        <option id="1" value="Rajkot" <?php echo($city=="Rajkot") ? "selected" : ""; ?>>Rajkot</option>
                    </select></td>
                </tr>
                
                <tr>
                	<td>Address</td>
                    <td><textarea rows="5" cols="20" required name="txtarea_info" ><?php echo $address;?></textarea></td>
                </tr>
                
                <tr><td>Image</td> 
                <td><img src='upload/<?php echo $filename ;?>' style="width:50px; height:50px">
                	<input type="file"  name="image" required id="image" value="<?php echo $res['image']?>"/></td>
                   	<input type="hidden" name="oldimg" value="<?= $path; ?>">
                </tr>
                	<td></td>
                    <td><input type="submit" name="update" value="Update" />
                    </td>
                </tr>
            </table>
      
        </form>
    </div>
</div>
</body>
</html>