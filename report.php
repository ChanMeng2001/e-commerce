<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    
    if(isset($_GET['reportedseller']))
    {
        $_SESSION['productdetailid'] = $_GET['productid'];
        $id = $_SESSION['productdetailid'];
        $reportedseller = $_GET['reportedseller'];
        $username = $_SESSION['username'];
        if($_GET['reportedseller'] == $username)
        {
            echo '<script>alert("You cannot report yourself")</script>';
            echo "<script>location.href = 'productdetail.php?productid=$id';</script>";
        }
    }

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
            <a href= "menu.php"><img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG"></a>
        </div>
        <div class = "search">
            <input type = "text" name = "search" placeholder = " Search here..." id = "alltextbox">
            <input type = "submit" value = "Search" id = "allsubmit">
        </div>
        <div class = "hyperlink">
            <a href = "addtocart.php">Add To Cart</a>
            <a href = "manageorder.php">Manage Order</a>
            <a href = "uploadproduct.php">Become a Seller</a>
            <a href = "managemyproduct.php">My Product</a>
        </div>
        <div class = "profile">
             <?php
                $username = $_SESSION['username'];
            ?>
            <a href = "userprofile.php"><?php
                echo $username;
                ?></a>
            <form method = "post" action = "logout.php"><input type = "submit" name = "logout" value = "Logout" id = "allbutton"></form>
        </div>
        
    </nav>
    
    <main>
        <form method = "post">
            <div class = "reportalign">
                    <div class = "reportedseller">
                        <label>Reported Seller :</label>
                        <input type = "text" value = "<?php echo $reportedseller; ?>" id = "reported" name = "reportedseller" disabled>
                    </div>
                    <div class = "reason">
                        <label>Reason : </label><br/>
                    </div>
                    <div class = "writereason">
                        <textarea cols = "150" rows = "15" id = "reportreason" name = "reason"></textarea>
                    </div>
                    <div class = "reportpagebutton">
                        <input type = "submit" value = "Submit" name = "submit" id = "back">
                        <input type = "button" value = "Back" id = "back" onclick = "location.href = 'productdetail.php?productid=<?php echo $id; ?>'">
                    </div>
            </div>
       </form>
    </main>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $id = $_SESSION['productdetailid'];
    $reportedseller = $_GET['reportedseller'];
    $reason = $_POST['reason'];
    $username = $_SESSION['username'];
    if($_POST['reason'] == "")
    {
        echo "<script>alert('You cannot empty the reason textarea');location.href = 'report.php?reportedseller=$reportedseller&productid=$id';</script>";
    }
    else
    {
        $query1 = mysqli_query($db, "select * from message where sender = '$username' && reportedseller = '$reportedseller'");
        if(mysqli_num_rows($query1)>0)
        {
            while($row = mysqli_fetch_assoc($query1))
            {
                $query2 = mysqli_query($db, "update message set sender = '$username', message = '$reason', reportedseller = '$reportedseller'");
                if($query2 == true)
                {
                    echo "<script>alert('Report successfully');location.href = 'productdetail.php?productid=$id';</script>";
                }
                else
                {
                    echo "<script>alert('Report failed');location.href = 'productdetail.php?productid=$id';</script>";
                }
            }
        }
        else
        {
            $query = mysqli_query($db, "insert into message (sender, message, reportedseller)values('$username','$reason','$reportedseller')");
            if($query == true)
            {
                echo "<script>alert('Report successfully');location.href = 'productdetail.php?productid=$id';</script>";
            }
            else
            {
                echo "<script>alert('Report failed');location.href = 'productdetail.php?productid=$id';</script>";
            }
        }
        
    }
    
    
}
?>