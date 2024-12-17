<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');

    if(isset($_POST['logout']))
    {
        session_destroy();
        unset($_SESSION['productid']);
        unset($_SESSION['proid']);
        unset( $_SESSION['productdetailid']);
        header("Location: index.php");
       
        
    }
    
    
?>