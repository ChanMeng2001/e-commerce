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
    <link rel = "stylesheet" type = "text/css" href = "css/style.css">
    <title>E-Commerce Online Platform System</title>
    <script>
        function check()
        {
            var a = document.getElementById('un').value;
            var b = document.getElementById('pw').value;
            var msg = document.getElementById('message');
            if(a == ""||b==""){
                msg.innerHTML="Please do not empty the textbox";
                msg.style.color = "red";
                return false;
            }
            if(a.length<5||a.length>10){
                msg.innerHTML="Username must be 5 to 10 characters";
                msg.style.color = "red";
                return false;
            }
            if(b.length<5||b.length>10){
                msg.innerHTML="Password must be 5 to 10 characters";
                msg.style.color = "red";
                return false;
            }
            
        }
        
    </script>
</head>
<body>
    <nav class = "container">
        
        <div class = "logo">
            <img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG">
        </div>
        <div class = "hyperlink">
            <a href = "adminpage.php" id = "highlight">Manage Admin</a>
            <a href = "adminmanageuser.php">Manage User</a>
            <a href = "showmessage.php">Message</a>
        </div>
        <div class = "profile">
             <?php
                $username = $_SESSION['username'];
            ?>
            <a href = "adminprofile.php"><?php
                echo $username;
                ?></a>
            <form method = "post" action = "logout.php"><input type = "submit" name = "logout" value = "Logout" id = "allbutton"></form>
        </div>
        
    </nav>
    
    <main>
        <form method = "post" onsubmit = "return check()">
        <div class = "table">
            <div class = "userinput">
                Username:
                <input type="text" name = "adminUsername" id = "un">
                Password:
                <input type = "password" name = "adminPassword" id = "pw">
                <input type = "submit" name = "addAdmin" value = "Add" id = "allsubmit">
                <span id = "message"></span>
            </div>
            <div class = "header">
                <label>Username</label>
                <label>Password</label>
                <label>Action</label>
            </div>
            
            <?php
                $query = mysqli_query($db, "select * from admin where username != '$username'");
                if(mysqli_num_rows($query)>0){
                    while($row = mysqli_fetch_assoc($query)){?>
                        <div class = "row">
                            <div id = "col1"><label><?php echo $row['username'];?></label></div>
                            <div id = "col2"><label id = "secondCol"><?php echo $row['password'];?></label></div>
                            <div id = "col3"><a href = "processadmin.php?delete=<?php echo $row['username']; ?>" name = "delete" id = "delBtn">Delete</a></div>
                        </div><?php
                    }
                }
                else
                {
                    echo "No data.";
                }
            ?>
            
        </div>
        </form>
    </main>
</body>
</html>
<?php 
if(isset($_POST['addAdmin'])){
$username = $_POST['adminUsername'];
$password = $_POST['adminPassword'];
$search = mysqli_query($db, "select 'username' from admin where username='{$username}'");
$result = mysqli_num_rows($search);
    if($result > 0)
    {
        //if exists in database, display error message
        echo "<script>alert('The username already in use. Please choose different one.');</script>";
    }
    else
    {
        //if no, insert new record into the database
        $query = mysqli_query($db, "insert into admin (username, password)values('$username','$password')");
        if ($query==true) {
          echo "<script>alert('Add record successfully!');
				location.href = 'adminpage.php';</script>";
        } else 
        {
          echo "<script>alert('Failed to add record!');
				location.href = 'adminpage.php';</script>"; 
        }

    }
    
}
?>














