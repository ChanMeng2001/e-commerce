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
        <div class = "search">
            <input type = "text" name = "search" placeholder = " Search here..." id = "alltextbox">
            <input type = "submit" value = "Search" id = "allsubmit">
        </div>
        <div class = "hyperlink">
            <a href = "addtocart.php">Add To Cart</a>
            <a href = "manageorder.php">Manage Order</a>
            <a href = "uploadproduct.php">Become a Seller</a>
            <a id = "highlight" href = "managemyproduct.php">My Product</a>
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
                    $query = mysqli_query($db, "select * from product where user_id = '$username'");
                    if(mysqli_num_rows($query)>0){
                        while($row = mysqli_fetch_assoc($query)){?>
                        <form method = "post" action = "managemyproduct.php">
                        <div class = "my-product-card">
                            <input type = "hidden" name = "productid" value = "<?php echo $row['id']; ?>">
                            <div id = "imagesize">
                                <img src = "upload/<?php echo $row['mainimage'];?>" id = "product-image">
                            </div>
                            <div>
                                <label>Name : </label>
                                <input type = "text" value = "<?php echo $row['name']; ?>" name = "productname" id = "textbox" required>
                            </div>
                            <div>
                                <label>Description : </label>
                                <input type = "text" value = "<?php echo $row['description']; ?>" name = "description"  id = "textbox" required>
                            </div>
                            <div>
                                <label>Category : </label>
                                <select id = "list" name = "category" required>
                                    <option selected = "selected"><?php echo $row['category']; ?></option>
                                    <option>Clothing</option>
                                    <option>Health and Beauty</option>
                                    <option>Mobile & Gadgets</option>
                                    <option>Watch</option>
                                    <option>Baby & Toys</option>
                                    <option>Home & Living</option>
                                    <option>Computer & Accessories</option>
                                    <option>Car & Accessories</option>
                                </select>
                            </div>
                            <div>
                                <label>Price : </label>
                                <input type = "text" value = "<?php echo $row['price']; ?> " name = "price" id = "textbox" required>
                            </div>
                            <div>
                                <label>Brand : </label>
                                <input type = "text" value = "<?php echo $row['brand']; ?> " name = "brand" id = "textbox" required>
                            </div>
                            <div>
                                <label>Stock : </label>
                                <input type = "text" value = "<?php echo $row['stock']; ?> " name = "stock" id = "textbox" required>
                            </div>
                            <div class = "setbuttonlocation">
                                <input type = "submit" name = "updatedetail" value = "Update" id = "updatebutton">
                                <input type = "submit" name = "deletedetail" value = "Delete" id = "deletebutton">
                                
                            </div>
                        </div>
                        </form>
                            <?php
                        }
                    }
                    else
                    {?>
                    <div class = "ptext">
                        <?php echo "You don't have product to sell yet";?>
                    </div>
                    <?php }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
<?php
if(isset($_POST['updatedetail']))
{
    $id = $_POST['productid'];
    $name = $_POST['productname'];
    $des = $_POST['description'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $query = mysqli_query($db, "update product set name='$name', description='$des', category='$category', brand='$brand', price='$price', stock='$stock' where id = '$id'");
    $query1 = mysqli_query($db, "update addtocart set name='$name', price='$price' where id = '$id'");

    if ($query==true) {
        echo "<script>alert('Product update successfully!');location.href = 'managemyproduct.php';</script>";
    }
    else
    {
        echo "<script>alert('Failed to upload product!');location.href = 'managemyproduct.php';</script>";
    }
}

if(isset($_POST['deletedetail'])){
    $id = $_POST['productid'];
    $query100 = mysqli_query($db, "delete from product where id = '$id'");
    $query200 = mysqli_query($db, "delete from addtocart where id = '$id'");
    if($query100==true && $query200==true)
    {
        echo "<script>alert('Product delete successfully!');location.href = 'managemyproduct.php';</script>";
    }
    else
    {
        echo "<script>alert('Failed to delete data !');location.href = 'managemyproduct.php';</script>";
    }
}
?>