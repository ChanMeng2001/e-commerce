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
            <a id = "highlight" href = "addtocart.php">Add To Cart</a>
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
    <form method = "post" action = "payment.php">
        <div class = "containtable">
            <t1><b>Add To Cart</b></t1>
            <table>
                <tr id = "tableheader">
                    <th style = "width:3%;">Select Item</th>
                    <th style = "width:15%;">Image</th>
                    <th style = "width:40%;">Name</th>
                    <th style = "width:7%;">Quantity</th>
                    <th>Price (RM)</th>
                    <th>Total Price (RM)</th>
                    <th>Action</th>
                </tr>
                
                <?php
                $query1 = mysqli_query($db, "select * from addtocart where username = '$username'");
                    if(mysqli_num_rows($query1)>0)
                    {
                        $total = 0;
                        while($row = mysqli_fetch_assoc($query1))
                        {?>
                            <tr>
                                <td><input type = "checkbox" name = "checkboxid[]" value = "<?php echo $row['id'];?>"></td>
                                <td id = "setimageheight"><a href = "productdetail.php?productid=<?php echo $row['id'];?>" id = "textcolor"><img src = "upload/<?php echo $row['image'];?>" id = "setimagesize"></a></td>
                                <td><a href = "productdetail.php?productid=<?php echo $row['id'];?>" id = "textcolor"><?php echo $row['name']; ?></a></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo ($row['price']*$row['quantity']); ?></td>
                                <td>
                                    <a href = "addtocart.php?remove=<?php echo $row['id']; ?>" name = "remove" id = "hl2">Remove</a>
                                </td>
                                
                                
                            </tr>
                            <?php
                            $total += $row['price'] * $row['quantity'];
                         }
                    }
                ?>
               <tr>
                    <td colspan = "5">Total (RM)</td>
                    <td><?php 
                    if(empty($total))
                    {
                        echo "0";
                    }
                    else
                    {
                        echo $total;
                    }
                    
                    ?></td>
                    <td>
                        <a href = "addtocart.php?clear=<?php echo $username; ?>" name = "clear">Clear</a>
                    </td>
                </tr>
            </table>
            
            <div class = "btnlocation">
                <input type = "submit" value = "Purchase" name = "purchase" id = "back">
                <input type = "button" value = "Back" id = "back" onclick = "location.href='menu.php'">
            </div>
        </div>
    </form>
    </main>
</body>
</html>
<?php
if(isset($_GET['clear'])){
    $query2 = mysqli_query($db, "delete from addtocart where username = '$username'");
    echo "<script>location.href = 'addtocart.php';</script>";
}
if(isset($_GET['remove']))
{
    $id = $_GET['remove'];
    $query3 = mysqli_query($db, "delete from addtocart where id = '$id'");
    echo "<script>alert('Item Removed');location.href = 'addtocart.php';</script>";
}

?>