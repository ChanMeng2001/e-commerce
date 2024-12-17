<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    
?>
<?php
if(isset($_GET['ban'])){
    $id = $_GET['ban'];
    $status = 0;
    $query = mysqli_query($db, "update user set status = '$status' where username = '$id'");
    echo "<script>alert('Ban successfully!');location.href = 'adminmanageuser.php';</script>";
    
}
?>