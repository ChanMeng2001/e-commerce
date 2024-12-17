<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');

    if(isset($_POST['submitsearch']))
        {
          // Assign the value/keyword entered by user into $keyword
          $keyword = $_POST['search'];
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
        <form method = "post" action = "search.php">
        <div class = "search">
            <input type = "text" name = "search" placeholder = " Search here..." id = "alltextbox">
            <input type = "submit" value = "Search" id = "allsubmit" name = "submitsearch">
        </div>
        </form>
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
    
        <section class = "section1">
            <div class = "product-list">
                <?php
                    $query = mysqli_query($db, "select * from product where name like '%$keyword%'");
                    if(mysqli_num_rows($query)>0){
                        while($row = mysqli_fetch_assoc($query)){?>
                        <form method = "post" action = "productdetail.php">
                        <div class = "product-card" onclick = "location.href='productdetail.php?productid=<?php echo $row['id']; ?>'">
                            <div id = "imagesize">
                                <img src = "upload/<?php echo $row['mainimage'];?>" id = "product-image">
                            </div>
                            <div class = "namecol">
                                <label><?php echo $row['name']; ?></label>
                            </div>
                            <div class = "pricecol">
                                <label><?php echo "RM ".$row['price']; ?></label>
                            </div>
                        </div>
                        </form>
                            <?php
                        }
                    }
                ?>
            </div>
            <div class = "btnlocation">
                <input type = "button" value = "Back" id = "back" onclick = "location.href='menu.php'">
            </div>
        </section>
        
       
    </main>

    
 
    
</body>
</html>
