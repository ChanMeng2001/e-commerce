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
            <a href = "adminmanageuser.php">Manage User</a>
            <a href = "showmessage.php" id = "highlight">Message</a>
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
        <?php
            $query = mysqli_query($db, "select * from message");
            if(mysqli_num_rows($query)>0)
            {
                while($row=mysqli_fetch_assoc($query))
                {?>
                    <div class = "messagelocation">
                        <div class = "containmessage">
                            <div class = "messagebox">
                                <label>Send from : </label>
                                <p id = "textmargin"><?php echo $row['sender']; ?></p>
                            </div>
                            <div class = "messagebox">
                                <label>Reported seller : </label>
                                <p id = "textmargin"><?php echo $row['reportedseller']; ?></p>
                            </div>
                            <div class = "messagebox">
                                <label>Reason : </label>
                                <p id = "textmargin"><?php echo $row['message']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
            }        
        ?>
    </main>
</body>
</html>













