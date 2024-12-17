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
        function inputnum(evt){
            var num = String.fromCharCode(evt.which);
            if(!(/[0-9.]/.test(num))){
                evt.preventDefault();
            }
        }
    </script>
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
            <a id = "highlight" href = "#">Become a Seller</a>
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
        <form method = "post" action = "uploadimage.php" enctype = "multipart/form-data">
            <div class = "container10">
                <fieldset class = "productbox">
                    <legend>Product Details</legend>
                    <div class = "detail">
                        <label>Product Name : </label>
                        <input type = "text" name = "name1" id = "type" required>
                    </div>
                    <div class = "detail">
                        <label>Product Desciption : </label><br/>
                        <textarea name = "description" id = "type" cols = "90" rows = "10" required></textarea>
                    </div>
                    <div class = "detail">
                        <label>Category : </label>
                        <select id = "list" name = "category" required>
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
                    <div class = "detail">
                        <label>Brand : </label>
                        <input type = "text" name = "brand" id = "type">
                    </div>
                    <div class = "detail">
                        <label>Price : </label>
                        <input type = "text" name = "price" id = "type" onkeypress = "inputnum(event)">
                    </div>
                    <div class = "detail">
                        <label>Stock : </label>
                        <input type = "text" name = "stock" id = "type" onkeypress = "inputnum(event)">
                    </div>
                </fieldset>
                <fieldset class = "productbox">
                    <legend>Product Image</legend>
                    <div class = "detail">
                        <label>Main image : </label>
                        <input type = "file" name = "image" required>
                    </div>
                    <div class = "detail">
                        <label>Subimage : </label>
                        <input type = "file" name = "image1">
                    </div>
                    <div class = "detail">
                        <label>Subimage : </label>
                        <input type = "file" name = "image2">
                    </div>
                    <div class = "detail">
                        <label>Subimage : </label>
                        <input type = "file" name = "image3">
                    </div>
                    <div class = "detail">
                        <label>Subimage : </label>
                        <input type = "file" name = "image4">
                    </div>
                </fieldset>
            </div>
            <div class = "btncenter">
                    <input type = "submit" value = "Upload" name = "upload" id = "allsubmit">
                    <input type = "button" value = "Cancel" onclick = "location.href='menu.php'" id = "allsubmit">
            </div>
        </form>
    </main>
</body>
</html>
