<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel = "stylesheet" type = "text/css" href = "css/editprofile1.css">
    <title>E-Commerce Online Platform System</title>
    <script>
    function maxlength(){
            var c = document.getElementById('pw').value;
            if(c.length<5||c.length>10){
                alert("Password must be 5 to 10 characters");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class = "bgcolor">
        <form action = "adminprofile.php" method = "POST" enctype="multipart/form-data" onsubmit = "return maxlength()" >
            <div id = "logo">
                <img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG" >
            </div>
            <div class = "content">
                <div class = "labelbox">
                    <label>Username :</label>
                    <label>Password :</label>
                </div>
                <?php 
                    $username = $_SESSION['username'];
                    $query = mysqli_query($db, "select * from admin where username = '$username'");
                    while($row = mysqli_fetch_assoc($query))
                    {?>
                    <div class = "inputbox1">
                        <input type = "text" id = "un" name = "username" value = "<?php echo $row['username']; ?>" disabled>
                        <input type = "text" name = "password" id = "pw" value = "<?php echo $row['password']; ?>" required>
                    </div>
                    <?php }
                ?>
                
            </div>
            <div class = "btn">
                    <input type = "submit" name = "submitadminprofile" value = "Save" id= "savebtn">
                    <input type = "button" value = "Cancel" onclick = "location.href='adminpage.php'" id= "savebtn">
            </div>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submitadminprofile'])){
        $password =$_POST['password'];
			
        $query1 = mysqli_query($db, "update admin set password = '$password' where username = '$username'");
        
        if($query == true)
        {
            echo "<script>alert('Update password successfully!');
				location.href = 'adminpage.php';</script>";
        }
        else
        {
            echo "<script>alert('Failed to update password!');
            location.href = 'adminpage.php';</script>";
        }
    }


?>