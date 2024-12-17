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
    <link rel = "stylesheet" type = "text/css" href = "css/editlogin.css">
    <title>E-Commerce Online Platform System</title>
</head>
<body>
    <div class = "bgcolor">
        <form method = "post">
            <div id = "logo">
                <img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG" >
            </div>

            <h1>Username</h1>
            <div id = "textbox">
                <input type = "text" name = "username" placeholder = "Username" required>
            </div>

            <h1>Password</h1>
            <div id = "textbox">
                <input type = "password" name = "password" placeholder = "Password" required>
            </div>
            
            <div class = "btn">
                <input type = "submit" name = "submit" value = "Login">
                <input type = "reset" name = "cancel" value = "Reset">
            </div>
            
            <div class = "text">
                <p>Don't have an account yet? <a href="register.php">Register here</a></p>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query1 = mysqli_query($db, "select * from user where username = '$username' && password = '$password'");
        $query2 = mysqli_query($db, "select * from admin where username = '$username' && password = '$password'");
        $checkStatus = mysqli_query($db, "select status from user where username = '$username' && password = '$password'");
        $row = mysqli_fetch_assoc($checkStatus);
        
        if(mysqli_num_rows($query1) == 0)
        {
            if(mysqli_num_rows($query2)==0)
            {
                echo "<script>alert('Your username or password is wrong!');</script>";
            }
            else
            {
        
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                echo "<script>alert('Login Successfully!'); window.location.href='adminpage.php';</script>";
                exit();
                
                
            }
        }
        else
        {
            if($row['status'] == 0)
            {
                    echo "<script>alert('Your account had been banned!'); window.location.href='index.php';</script>";
            }
            else
            {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                echo "<script>alert('Login Successfully!'); window.location.href='menu.php';</script>";
                exit();
            }
        
        }
        
    }

?>