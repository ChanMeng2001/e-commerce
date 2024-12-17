<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');

    $getproid = $_GET['productid'];
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
        <div class = "containsection">
            <section class = "slidersection">
                <?php
                    $query = mysqli_query($db, "select * from product where id = '$getproid'");
                    if(mysqli_num_rows($query)>0){
                        while($row = mysqli_fetch_assoc($query)){?>
                        <div class = "productdetailwidth">
                            <div class = "slider">
                                <input type = "radio" name = "radiobtn" id = "radio1" class = "radiogroup">
                                <?php
                                if($row['subimage1'] != NULL){?>
                                <input type = "radio" name = "radiobtn" id = "radio2" class = "radiogroup">
                                <?php } ?>
                                <?php
                                if($row['subimage2'] != NULL){?>
                                <input type = "radio" name = "radiobtn" id = "radio3" class = "radiogroup">
                                <?php } ?>
                                <?php
                                if($row['subimage3'] != NULL){?>
                                <input type = "radio" name = "radiobtn" id = "radio4" class = "radiogroup">
                                <?php } ?>
                                <?php
                                if($row['subimage4'] != NULL){?>
                                <input type = "radio" name = "radiobtn" id = "radio5" class = "radiogroup">
                                <?php } ?>
                                

                                <div class = "slide main">
                                    <img src = "upload/<?php echo $row['mainimage'];?>" id = "sliderimage">
                                </div>
                                <?php
                                if($row['subimage1'] != NULL){?>
                                    <div class = "slide">
                                        <img src = "upload/<?php echo $row['subimage1'];?>" id = "sliderimage">
                                    </div>
                                <?php } ?>
                                <?php
                                if($row['subimage2'] != NULL){?>
                                    <div class = "slide">
                                        <img src = "upload/<?php echo $row['subimage2'];?>" id = "sliderimage">
                                    </div>
                                <?php } ?>
                                <?php
                                if($row['subimage3'] != NULL){?>
                                    <div class = "slide">
                                        <img src = "upload/<?php echo $row['subimage3'];?>" id = "sliderimage">
                                    </div>
                                <?php } ?>
                                <?php
                                if($row['subimage4'] != NULL){?>
                                    <div class = "slide">
                                        <img src = "upload/<?php echo $row['subimage4'];?>" id = "sliderimage">
                                    </div>
                                <?php } ?>
                            </div>

                            <div class = "clickradio">
                                <label for = "radio1" class = "radiobtn"></label>
                                
                                <?php
                                    $query = mysqli_query($db, "select * from product where id = '$getproid'");
                                    if(mysqli_num_rows($query) > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($query)){
                                            if($row['subimage1']!=NULL){?>
                                                <label for = "radio2" class = "radiobtn"></label>
                                            <?php }
                                            if($row['subimage2']!=NULL){?>
                                                <label for = "radio3" class = "radiobtn"></label>
                                            <?php }
                                            if($row['subimage3']!=NULL){?>
                                                <label for = "radio4" class = "radiobtn"></label>
                                            <?php }
                                            if($row['subimage4']!=NULL){?>
                                                <label for = "radio5" class = "radiobtn"></label>
                                            <?php }
                                        }
                                    }
                                 ?>

                            </div>
                        </div>
                        <?php
                        }
                    }
                ?>
            </section>






            <section class = "infosection">
                <div class = "info">
                    <?php
                        
                        $query = mysqli_query($db, "select * from product where id = '$getproid'");
                        if(mysqli_num_rows($query)>0){
                            while($row = mysqli_fetch_assoc($query)){?>
                            
                        <form method = "post">
                        <input type = "hidden" value = "<?php echo $row['id']; ?>" name = "productid">
                        <input type = "hidden" value = "<?php echo $row['mainimage']; ?>" name = "Imagee">
                            <div>
                                <label>Name : </label>
                                <label><?php echo $row['name']; ?></label>
                                <input type = "hidden" name = "productname" value = "<?php echo $row['name']; ?>">
                            </div>
                            <div>
                                <label>Price : </label>
                                <label><?php echo "RM ".$row['price']; ?></label>
                                <input type = "hidden" name = "price" value = "<?php echo $row['price']; ?>">
                            </div>
                            <div>
                                <label>Description : </label>
                                <label><?php echo $row['description']; ?></label>
                            </div>
                            <div>
                                <label>Category : </label>
                                <label><?php echo $row['category']; ?></label>
                            </div>
                            <div>
                                <label>Brand : </label>
                                <label><?php echo $row['brand']; ?></label>
                            </div>
                            <div>
                                <label>Stock : </label>
                                <label><?php echo $row['stock']; ?></label>
                                <input type = "hidden" name = "stock" value = "<?php echo $row['stock']; ?>">
                            </div>
                            <div>
                                <label>Sold : </label>
                                <label><?php echo $row['sold']; ?></label>
                            </div>
                            <div>
                                <label>Seller : </label>
                                <label><?php echo $row['user_id']; ?></label>
                                <input type = "hidden" name = "sellername" value = "<?php echo $row['user_id']; ?>">
                            </div>
                            <div>
                                <label>Quantity : </label>
                                <input type = "number" name = "quantity" value = "1" id = "quan" min="1" max = "<?php echo $row['stock']; ?>"> 
                            </div>
                            <div class = "fourbtn">
                                <input type = "submit" value = "Add To Cart" name = "addtocart" id = "addtocart">
                                <input type = "button" value = "Report" name = "Report" onclick = "location.href='report.php?reportedseller=<?php echo $row['user_id']; ?>&productid=<?php echo $row['id']; ?>'">
                            </div>
                            </form>
                            <?php
                            }
                        }
                    ?>
                </div>
            </section>
        </div>
        <div class = "btnlocation">
            <input type = "button" value = "Back" id = "back" onclick = "location.href='menu.php'">
        </div>
    </main>
</body>
</html>
<?php
if(isset($_POST['addtocart']))
{
    $id = $_POST['productid'];
    $name = $_POST['productname'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $mimage = $_POST['Imagee'];
    $stock = $_POST['stock'];
    $seller = $_POST['sellername'];
    $username = $_SESSION['username'];
    if($seller == $username)
    {
        echo '<script>alert("You cannot add your own product to the cart")</script>';
        echo "<script>location.href = 'productdetail.php?productid=$id';</script>"; 
    }
    else
    {
        if($quantity > $stock)
        {
            echo "<script>alert('You cannot enter the quantity that larger than the stock')</script>";
            echo "<script>location.href = 'productdetail.php?productid=$id';</script>"; 
        }
        else
        {
            if($quantity <= 0)
            {
                echo '<script>alert("You cannot enter 0 or smaller than 0 quantity")</script>';
                echo "<script>location.href = 'productdetail.php?productid=$id';</script>";
            }
            else
            {
                $query1 = mysqli_query($db, "select id from addtocart where id = '$id' && username = '$username'");
                if(mysqli_num_rows($query1)>0)
                {
                    $query = mysqli_query($db, "update addtocart set quantity = '$quantity' where id = '$id' && username = '$username'");
                    echo '<script>alert("Item added successfully")</script>';
                    echo "<script>location.href = 'productdetail.php?productid=$id';</script>";
                }
                else
                {
                    $query = mysqli_query($db, "insert into addtocart (id, name, price, quantity, image, username)values('$id', '$name', '$price', '$quantity', '$mimage', '$username')");    
                    if($query == true)
                    {
                        echo '<script>alert("Item added successfully")</script>';
                        echo "<script>location.href = 'productdetail.php?productid=$id';</script>";
                    }
                }
                
            }
            
        }
    } 
}




?>