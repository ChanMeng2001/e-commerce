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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/demo.css">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css">
    <title>E-Commerce Online Platform System</title>
    <script>
    
        function inputnum(evt){
            var num = String.fromCharCode(evt.which);
            if(!(/[0-9]/.test(num))){
                evt.preventDefault();
            }
            document.getElementById('cardNumber').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
            });
        }
        
         
        function inputvar(evt){
            var owner = String.fromCharCode(evt.which);
            if(!(/[a-zA-Z ]/.test(owner))){
                evt.preventDefault();
            }
        }
        function checkvalue(divId1, divId2, divId3, paybtn, element)
        {
            if(element.value == "Visa/Master Card")
            {
                document.getElementById(divId1).style.display = "flex";
                document.getElementById(divId2).style.display = "none";
                document.getElementById(divId3).style.display = "block";
                document.getElementById(paybtn).style.display = "inline";
            }
            else
            if(element.value == "Paypal")
            {
                document.getElementById(divId1).style.display = "none";
                document.getElementById(divId2).style.display = "block";
                document.getElementById(divId3).style.display = "none";
                document.getElementById(paybtn).style.display = "none";
            }

        }
        
        function maxlength()
        {
            
            var owner = document.getElementById('owner').value;
            var cvv = document.getElementById('cvv').value;
            var cn = document.getElementById('cardNumber').value;

            
            if(owner.length < 5)
            {
                alert("Wrong owner name");
                return false;
            }
            if(cvv.length != 3 && cvv.length != 4)
            {
                alert("Wrong cvv number");
                return false;
            }
           //19 because include white space
            if(cn.length!=19)
            {
                alert("Wrong card number");
                return false;
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
    <form method = "post" onsubmit = "return maxlength()">
        <div class = "containtable">
            <table>
                <tr>
                    <th style = "width:15%;">Image</th>
                    <th style = "width:40%;">Name</th>
                    <th style = "width:7%;">Quantity</th>
                    <th>Price (RM)</th>
                    <th>Total Price (RM)</th>
                </tr>
                
                <?php
                $total = 0;
                if(isset($_POST['purchase'])){
                    if(!empty($_POST['checkboxid'])) {   
                        foreach($_POST['checkboxid'] as $value){
                            $query2 = mysqli_query($db, "select stock from product where id = '$value'");
                            $query1 = mysqli_query($db, "select * from addtocart where id = '$value' && username = '$username'");
                            
                            if(mysqli_num_rows($query1)>0)
                            {
                                while($row = mysqli_fetch_assoc($query1))
                                {
                                    if(mysqli_num_rows($query2)>0)
                                    {
                                        while($row3=mysqli_fetch_assoc($query2))
                                        {
                                            if($row['quantity'] > $row3['stock'])
                                            {
                                                echo "<script>alert('Your add to cart product quantity is larger than stock. Please change it.');location.href = 'addtocart.php';</script>";
                                            }
                                            else
                                            {

                                        
                                    
                                    ?>
                                   <input type = "hidden" value = <?php echo $value; ?> name = "getid[]">
                                    <tr>
                                        <td id = "setimageheight">
                                            <a href = "productdetail.php?productid=<?php echo $row['id'];?>" id = "textcolor"><img src = "upload/<?php echo $row['image'];?>" id = "setimagesize"></a>
                                            <input type = "hidden" value = "<?php echo $row['image'];?>" name= "getimage[]">
                                        </td>
                                        <td>
                                            <a href = "productdetail.php?productid=<?php echo $row['id'];?>" id = "textcolor"><?php echo $row['name']; ?></a>
                                            <input type = "hidden" value = "<?php echo $row['name'];?>" name= "getname[]">
                                        </td>
                                        <td>
                                            <?php echo $row['quantity']; ?>
                                            <input type = "hidden" value = "<?php echo $row['quantity']; ?>" name = "getquantity[]">
                                        </td>
                                        <td>
                                            <?php echo $row['price']; ?>
                                            <input type = "hidden" value = "<?php echo $row['price'];?>" name= "getprice[]">
                                        </td>
                                        <td>
                                            <?php echo ($row['price']*$row['quantity']); ?>
                                            <input type = "hidden" value = "<?php echo ($row['price']*$row['quantity']); ?>" name= "getsmalltotal[]">
                                        </td>
                                    </tr>
                                    <?php
                                    $total += $row['price'] * $row['quantity'];
                                            }        
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        echo "<script>alert('Please select the item that you want to buy');location.href = 'addtocart.php';</script>";
                    }
                
                }
                
                ?>
                <input type = "hidden" value = "<?php echo $total; ?>" name= "getpaytotal[]">
               <tr>
                    <td colspan = "4">Total Pay (RM)</td>
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
                </tr>
            </table>
            
            <div class = "paymentmethoddiv">
                <label>Select payment method :</label>
                <select id = "list" onchange = "checkvalue('pay1', 'pay2', 'pay3', 'confirm-purchase', this)">
                    <option value = "Visa/Master Card">Visa/Master Card</option>
                    <option value = "Paypal">Paypal</option>
                </select>
            </div>

            <div class = "cardnumdiv" id ="pay1">
                <div class = "leftside">
                    <label for="owner">Owner</label>
                    <br/>
                    <label for="cvv">CVV</label>
                    <br/>
                    <label for="cardNumber">Card Number</label>
                    <br/>
                    <label id = "datelocate">Expiration Date</label>
                </div>
                <div class = "rightside">
                    <input type="text" class="form-control" id="owner" onkeypress = "inputvar(event)" required>
                    <br/>
                    <input type="text" class="form-control" id="cvv" onkeypress = "inputnum(event)" required>
                    <br/>
                    <input type="text" class="form-control" id="cardNumber" onkeypress = "inputnum(event)" required>
                    <br/>
                    <div class = "dropdirect">
                    <select id = "month">
                        <option value="01">January</option>
                        <option value="02">February </option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select id = "year">
                        <option value="16"> 2016</option>
                        <option value="17"> 2017</option>
                        <option value="18"> 2018</option>
                        <option value="19"> 2019</option>
                        <option value="20"> 2020</option>
                        <option value="21"> 2021</option>
                        <option value="22"> 2022</option>
                        <option value="23"> 2023</option>
                        <option value="24"> 2024</option>
                        <option value="25"> 2025</option>
                        <option value="26"> 2026</option>
                        <option value="27"> 2027</option>
                        <option value="28"> 2028</option>
                        <option value="29"> 2029</option>
                        <option value="30"> 2030</option>
                        <option value="31"> 2031</option>
                        <option value="32"> 2032</option>
                    </select>
                    </div>
                </div>
                
            </div>
            
            <div class="form-group" id="pay3">
                <img src="image/visa.jpg" id="visa">
                <img src="image/mastercard.jpg" id="mastercard">
            </div>
            
            <div class = "paypal" id = "pay2">
                <br/><br/>
                <script src="https://apps.elfsight.com/p/platform.js" defer></script>
                <div class="elfsight-app-5cdc5f53-4e15-41b9-b8f8-5218d2a3cc2b"></div>
            </div>        

            <div class = "btnlocation">
                <button type="submit" class="btn btn-default" id="confirm-purchase" name = "pay">Confirm</button>
                <input type = "button" value = "Back" id = "back" onclick = "location.href='addtocart.php'">
            </div>
        </div>
    </form>
    </main>
</body>
</html>
<?php
if(isset($_POST['pay']))
{
    $username = $_SESSION['username'];
    $getid = $_POST['getid'];
    
    foreach($_POST['getid'] as $value)
    {
        $query1 = mysqli_query($db, "select * from addtocart where id = '$value' && username = '$username'");
        $row = mysqli_fetch_assoc($query1);
        $image1 = $row['image'];
        $name = $row['name'];
        $quantity = $row['quantity'];
        $status = 1;
        $deliverystatus = "To be shipped";
        
        $v[] = array(
            "productid" =>$value, 
            "image" =>$image1,
            "name" =>$name,
            "quantity" =>$quantity,
            "buyer" =>$username,
            "status" =>$status,
            "deliverystatus" =>$deliverystatus
        );
        
    }
    //insert array into database
    foreach ($v as $vid => $item)
    {
        $proid = $item['productid'];
        $proimage = $item['image'];
        $proname = $item['name'];
        $proquantity = $item['quantity'];
        $probuyer = $item['buyer'];
        $prostatus = $item['status'];
        $prodeliverystatus = $item['deliverystatus'];
        $query4 = mysqli_query($db, "select user_id from product where id = '$proid'");
        $row4 = mysqli_fetch_assoc($query4);
        $proseller = $row4['user_id'];
        $query5 = mysqli_query($db, "insert into orderproduct (productid, image, name, quantity, buyer, seller, status, deliverystatus)values('".$proid."','".$proimage."','".$proname."','".$proquantity."','".$probuyer."','".$proseller."','".$prostatus."','".$deliverystatus."')");

        $sql1 = mysqli_query($db, "delete from addtocart where id = '$proid' && username = '$username'");
        $sql2 = mysqli_query($db, "select * from product where id = '$proid'");
        $row2 = mysqli_fetch_assoc($sql2);
        $row2['stock'] -= $item['quantity'];
        $row2['sold'] += $item['quantity'];
        $sql3 = mysqli_query($db, "update product set stock = '$row2[stock]', sold = '$row2[sold]' where id = '$proid'");

    }
   
    
    if($query5==true && $sql1 ==true && $sql2==true && $sql3 ==true)
    {
        
        echo "<script>alert('Purchase successfully!');location.href = 'manageorder.php';</script>"; 
        
    }
    else
    {
        echo "<script>alert('Purchase failed!');location.href = 'addtocart.php';</script>";
    }
   
    
}
?>