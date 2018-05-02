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
    <div class="container">
        <div class="content">
            <?php
            	include("config.php");
                if(isset($_POST['delete'])) {
                    for($i=0;$i<count($_POST['del']);$i++)
                    {
                        $new_id=$_POST['del'][$i];
                        $sql="DELETE FROM user WHERE id='$new_id'";
                        $res=mysqli_query($con,$sql);
                    }
                    header("location:list.php");
                }
            	if(isset($_POST['submit'])) {
                	$id=$_POST['id'];
                	$name=$_POST['txt_uname'];
                	$gender=$_POST['radio_gender'];
                	$email=$_POST['txt_email'];
                	$address=$_POST['txtarea_info'];
                	$city=$_POST['city'];
                	$tech=implode(',',$_POST['technology']);

                	$filename=$_FILES['image']['name'];
                	$filetmpname=$_FILES['image']['tmp_name'];	
                	$target_dir="upload/";
                	$path=$target_dir.$filename;	
                		
                	move_uploaded_file($filetmpname,$path);
            		
            		$query1="INSERT into user (username,password,gender,email,address,city,technology,image) VALUES ('$name','$password','$gender','$email','$address','$city','$tech','$filename')";	
            		mysqli_query($con,$query1);
            		}
            ?>

            <div class="list-box">
                <h2>Welcome <?php print_r($_SESSION['userdata']['username']); ?></h2>
                <a href="list.php">User List</a>
                <a href="logout.php">Logout</a>
                <form method="post" action="">
                    <table border="1">
                        <tr>
                        	<th><input type="submit" name="delete" value="Delete" id="delete" /></th>
                        	<th>ID</th>
                        	<th>username</th>
                            <th>gender</th>
                            <th>email</th>
                            <th>address</th>
                            <th>city</th>
                            <th>technology</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $num_rec_per_page=3;
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                        $start_from = ($page-1) * $num_rec_per_page;

                        $query2="Select * from user LIMIT $start_from, $num_rec_per_page";
                    	$result=mysqli_query($con,$query2);
                    		
                		while($res=mysqli_fetch_array($result))
                		{
                			echo "<tr>";
                			?>
                			 <td><input type="checkbox" name="del[]" id="del[]" value="<?php echo $res['id']; ?>" /></td>
                             <?php
                            echo "<td>".$res['id']."</td>";
                			echo "<td>".$res['username']."</td>";
                			echo "<td>".$res['gender']."</td>";
                			echo "<td>".$res['email']."</td>";
                			echo "<td>".$res['address']."</td>";
                			echo "<td>".$res['city']."</td>";
                			echo "<td>".$res['technology']."</td>";
                			?>
                			<td><img src='upload/<?php echo $res['image'];  ?>' style="height:50px; width:50px;"></td>
                            <?php
                			echo "<td><a href=\"edit.php?id=$res[id]\" >Edit</a> | <a href=\"delete.php?id=$res[id]\"> delete</a></td>"; 
                			echo "</tr>";
                		}	
                         	?>
                    </table>
                </form>
                <?php 
                $sql = "SELECT * FROM user"; 
                $rs_result = mysqli_query($con,$sql); //run the query
                $total_records = mysqli_num_rows($rs_result);  //count number of records
                $total_pages = ceil($total_records / $num_rec_per_page); 
                //$first_pages = floor($total_records / $num_rec_per_page); 

                echo "<a href='list.php?page=1'>"."First"."</a> "; // Goto 1st page  

                for ($i=1; $i<=$total_pages; $i++) { 
                            echo "<a href='list.php?page=".$i."'>".$i."</a> "; 
                }; 
                echo "<a href='list.php?page=$total_pages'>"."Last"."</a> "; // Goto last page
                ?>
            </div>
        </div>
    </div>
</body>
</html>