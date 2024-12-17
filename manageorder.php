<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    $username = $_SESSION['username'];
   
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
            <a href = "manageorder.php" id = "highlight">Manage Order</a>
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
        
        <div class = "tabspage">
            <input type = "radio" value = "Your Order" id = "tabyourorder" name = "tabs" checked = "checked">
            <label for = "tabyourorder" id = "yourorder">Your Order</label>
            <div class = "tabcontent">
                
                <?php
                    $query = mysqli_query($db, "select * from orderproduct where buyer = '$username' && status = '1'");
                    if(mysqli_num_rows($query)>0)
                    {
                        while($row=mysqli_fetch_assoc($query))
                        {?>
                        <form method = "post" action = "processorder.php">
                        <input type = "hidden" value = "<?php echo $row['orderproductid']; ?>" name = "proid">
                        <input type = "hidden" value = "<?php echo $row['productid']; ?>" name = "proid1">

                        <div class = "orderbox">
                        <a href = "productdetail.php?productid=<?php echo $row['productid']; ?> " id = "orderlink">
                            <div class = "ordercontent">
                                <label>Name : </label>
                                <p id = "ordertxt"><?php echo $row['name']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Quantity : </label>
                                <p id = "ordertxt"><?php echo $row['quantity']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Status : </label>
                                <p id = "ordertxt"><?php echo $row['deliverystatus']; ?></p>
                            </div>
                            </a>
                            <div class = "receiveitembtnlocate">
                                <input type = "submit" name = "receive" value = "Receive" id = "receiveitembtn">
                            </div>
                        </div>
                        </form>
                       
                        <?php }
                    }
                    else
                    {
                        echo "You haven't buy any product yet";
                    }
                ?>
            
            </div>


            <input type = "radio" value = "Update Order" id = "tabupdate" name = "tabs">
            <label for = "tabupdate" id = "updateorder">Update Order</label>
            <div class = "tabcontent">
                <?php
                    $query = mysqli_query($db, "select * from orderproduct where seller = '$username' && status = '1'");
                    
                    if(mysqli_num_rows($query)>0)
                    {
                        while($row=mysqli_fetch_assoc($query))
                        {
                        $query1 = mysqli_query($db, "select address from user where username = '$row[buyer]'");
                        $row1 = mysqli_fetch_assoc($query1);
                    ?>
                        <form method = "post" action = "processorder.php">
                        <input type = "hidden" value = "<?php echo $row['orderproductid']; ?>" name = "proid">
                        <div class = "orderbox">
                            <div class = "ordercontent">
                                <label>Buyer : </label>
                                <p id = "ordertxt"><?php echo $row['buyer']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Name : </label>
                                <p id = "ordertxt"><?php echo $row['name']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Quantity : </label>
                                <p id = "ordertxt"><?php echo $row['quantity']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Buyer Address : </label>
                                <p id = "ordertxt"><?php echo $row1['address']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Status : </label>
                                <select id = "list" name = "selectdestatus">
                                    <option disabled selected = "selected">Selected : <?php echo $row['deliverystatus']; ?></option>
                                    <option>To be shipped</option>
                                    <option>To be received</option>
                                </select>
                            </div>
                            <div class = "receiveitembtnlocate">
                                <input type = "submit" name = "update" value = "Update" id = "receiveitembtn">
                            </div>
                        </div>
                        </form>
                        <?php }
                    }
                    else
                    {
                        echo "No people buy your product yet";
                    }
                ?>
            </div>


            <input type = "radio" value = "Purchase History" id = "tabhistory" name = "tabs">
            <label for = "tabhistory" id = "history">Purchase History</label>
            <div class = "tabcontent">
            <?php
                    $query = mysqli_query($db, "select * from orderproduct where buyer = '$username' && status = '2'");
                    if(mysqli_num_rows($query)>0)
                    {
                        while($row=mysqli_fetch_assoc($query))
                        {?>
                        <form method = "post" action = "processorder.php">
                        <a href = "productdetail.php?productid=<?php echo $row['productid']; ?>" id = "orderlink">
                        <div class = "orderbox" style = "margin-top:10px;">
                            <div class = "ordercontent">
                                <label>Name : </label>
                                <p id = "ordertxt"><?php echo $row['name']; ?></p>
                            </div>
                            <div class = "ordercontent">
                                <label>Quantity : </label>
                                <p id = "ordertxt"><?php echo $row['quantity']; ?></p>
                            </div>
                        </div>
                        </a>
                        </form>
                        <?php }
                    }
                    else
                    {
                        echo "No purchase history";
                    }
                ?>
            </div>
        </div>
                
        
    </main>
</body>
</html>
<?php

?>