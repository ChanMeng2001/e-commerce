<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    
?>
<?php
if(isset($_GET['unban'])){
    $id = $_GET['unban'];
    $status = 1;
    $query = mysqli_query($db, "update user set status = '$status' where username = '$id'");
    echo "<script>alert('Unban successfully!');location.href = 'adminmanageuser.php';</script>";
}
?>