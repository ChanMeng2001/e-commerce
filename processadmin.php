<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    
?>

<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $username = $_SESSION['username'];
    if($username == $id){
        echo "<script>alert('You cannot delete this account because you are opening this account!');location.href = 'adminpage.php';</script>";
    }
    else
    {
        $query = mysqli_query($db, "delete from admin where username = '$id'");
        header("location: adminpage.php");
    }
    
}

?>
