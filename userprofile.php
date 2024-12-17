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
        function getImageName(imagename)
        {
            var newimg = imagename.replace(/^.*\\/,"");
            var a = document.getElementById("uploadimagebox");
            a.innerHTML = newimg;
        }
        function inputnum(evt){
            var num = String.fromCharCode(evt.which);
            if(!(/[0-9]/.test(num))){
                evt.preventDefault();
            }
        }
        function maxlength(){
            var b = document.getElementById('length').value;
            if (b.length < 10 || b.length > 11){
                alert("Phone numbers must be ten or eleven digits!");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class = "bgcolor">
        <form action = "userprofile.php" method = "POST" enctype="multipart/form-data" onsubmit = "return maxlength()" >
            <div id = "logo">
                <img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG" >
            </div>
            <div class = "content">
                <div class = "labelbox">
                    <label>Username :</label>
                    <label>Password :</label>
                    <label>Address :</label>
                    <label>Telephone number :</label>
                </div>
                <?php 
                    $username = $_SESSION['username'];
                    $query = mysqli_query($db, "select * from user where username = '$username'");
                    while($row = mysqli_fetch_assoc($query))
                    {?>
                    <div class = "inputbox">
                        <input type = "text" id = "un" name = "username" value = "<?php echo $row['username']; ?>" disabled>
                        <input type = "text" name = "password" id = "pw" value = "<?php echo $row['password']; ?>" required>
                        <input type = "text" name = "address" value = "<?php echo $row['address']; ?>" required>
                        <input type = "text" name = "telnum" id = "length" value = "<?php echo $row['telno']; ?>" onkeypress = "inputnum(event)" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" title = "Please enter correct phone number format." required>
                    </div>
                    <?php }
                    
                ?>
                
            </div>
            <div class = "btn">
                    <input type = "submit" name = "submit" value = "Save" id= "savebtn">
                    <input type = "button" value = "Cancel" onclick = "location.href='menu.php'" id= "savebtn">
            </div>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $password =$_POST['password'];
        $address =$_POST['address'];
        $telnum =$_POST['telnum'];
        if(!preg_match("/^[0-9]*$/", $telnum)){
            echo "<script>alert('Phone number can only enter number only!');</script>"; 
            exit();
        }
			
        $query1 = mysqli_query($db, "update user set password = '$password', address = '$address', telno = '$telnum' where username = '$username'");
        
        if ($query1 == true) {
          echo "<script>alert('Record updated successfully!');
				location.href = 'menu.php';</script>"; 
        } else {
          echo "<script>alert('Failed to update record!');
				location.href = 'userprofile.php';</script>"; 
        }
        
    }


?>