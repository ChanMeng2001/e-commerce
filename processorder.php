<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    $username = $_SESSION['username'];
   
?>
<?php
if(isset($_POST['update']))
{
    $select = $_POST['selectdestatus'];
    $getproductid = $_POST['proid'];
    
    $query3 = mysqli_query($db,"select * from orderproduct where orderproductid = '$getproductid'");
    $row3 = mysqli_fetch_assoc($query3);

    if($select == $row3['deliverystatus'])
    {
        echo "<script>location.href = 'manageorder.php';</script>";
    }
    else
    {
        $query1 = mysqli_query($db,"update orderproduct set deliverystatus = '$select' where orderproductid = '$getproductid'");
        if($query1 == true)
        {
            echo "<script>alert('Status update successfully!');location.href = 'manageorder.php';</script>";
        }
    }
    
    

}

if(isset($_POST['receive']))
{
    $getproductid = $_POST['proid'];
    $deliverystatus1 = "Delivery completed";
    $query2 = mysqli_query($db, "select * from orderproduct where buyer = '$username' && orderproductid = '$getproductid'");
    if(mysqli_num_rows($query2)>0)
    {
        while($row2 = mysqli_fetch_assoc($query2))
        {
            if($row2['deliverystatus']==="To be shipped")
            {
                echo "<script>alert('You cannot receive this item yet as the seller not yet send this item to you!');location.href = 'manageorder.php';</script>";
            }
            else
            {
               
                $query1 = mysqli_query($db,"update orderproduct set status = '2', deliverystatus = '$deliverystatus1' where orderproductid = '$getproductid'");
            }
        }
    }
    
    
    
    
    if($query1 == true)
    {
        echo "<script>location.href = 'manageorder.php';</script>";
    }

}
?>