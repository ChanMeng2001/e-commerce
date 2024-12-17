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
</head>
<body>
    <nav class = "container">
        
        <div class = "logo">
            <img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG">
        </div>
        <div class = "hyperlink">
            <a href = "adminpage.php">Manage Admin</a>
            <a href = "adminmanageuser.php" id = "highlight">Manage User</a>
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
        <form method = "GET">
        <div class = "table">
            <h3 id = "userlist">User List</h3>
            <div class = "header">
                <label>Username</label>
                <label>Password</label>
                <label>Action</label>
            </div>

            <?php
                $query = mysqli_query($db, "select * from user where status = '1'");
                if(mysqli_num_rows($query)>0){
                    while($row = mysqli_fetch_assoc($query)){?>
                        <div class = "row" id = "row">
                            <div id = "col1"><label id = "firstColumn"><?php echo $row['username'];?></label></div>
                            <div id = "col2"><label id = "secondCol"><?php echo $row['password'];?></label></div>
                            <div id = "col3"><a href = "banuser.php?ban=<?php echo $row['username']; ?>" name = "ban" id = "delBtn">Ban</a></div>
                        </div><?php
                    }
                }
                else
                {
                    echo "No user account.";
                }
            ?>


            <h3 id = "userlist">Banned List</h3>
            <div class = "header">
                <label>Username</label>
                <label>Password</label>
                <label>Action</label>
            </div>

            <?php
                $query = mysqli_query($db, "select * from user where status = '0'");
                if(mysqli_num_rows($query)>0){
                    while($row = mysqli_fetch_assoc($query)){?>
                        <div class = "row" id = "row">
                            <div id = "col1"><label id = "firstColumn"><?php echo $row['username'];?></label></div>
                            <div id = "col2"><label id = "secondCol"><?php echo $row['password'];?></label></div>
                            <div id = "col3"><a href = "unbanuser.php?unban=<?php echo $row['username']; ?>" name = "unban" id = "delBtn">Unban</a></div>
                        </div><?php
                    }
                }
                else
                {
                    echo "No banned account.";
                }
            ?>
            
        </div>
        </form>
    </main>
</body>
</html>












