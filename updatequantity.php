<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    $username = $_SESSION['username'];
?>
<?php
if(isset($_GET['updatenum']))
{
    $quan = $_POST['addtocartquantity'];
    $id = $_SESSION['productid'];
    $query1 = mysqli_query($db, "update addtocart set quantity = '$quan' where id = '$id'");
    //echo "<script>location.href = 'addtocart.php';</script>";
}
?>