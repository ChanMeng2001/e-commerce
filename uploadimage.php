<?php
	//start session
	session_start();
	
	//reference to the database connection file
	include('dbcon.php');
    
?>
<?php
if(isset($_POST['upload']))
{
    $name = $_POST['name1'];
    $des = $_POST['description'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];

    $file1 = $_FILES['image1'];
    $fileName1 = $_FILES['image1']['name'];
    $fileTmpName1 = $_FILES['image1']['tmp_name'];
    $fileSize1 = $_FILES['image1']['size'];
    $fileError1 = $_FILES['image1']['error'];

    $file2 = $_FILES['image2'];
    $fileName2 = $_FILES['image2']['name'];
    $fileTmpName2 = $_FILES['image2']['tmp_name'];
    $fileSize2 = $_FILES['image2']['size'];
    $fileError2 = $_FILES['image2']['error'];

    $file3 = $_FILES['image3'];
    $fileName3 = $_FILES['image3']['name'];
    $fileTmpName3 = $_FILES['image3']['tmp_name'];
    $fileSize3 = $_FILES['image3']['size'];
    $fileError3 = $_FILES['image3']['error'];

    $file4 = $_FILES['image4'];
    $fileName4 = $_FILES['image4']['name'];
    $fileTmpName4 = $_FILES['image4']['tmp_name'];
    $fileSize4 = $_FILES['image4']['size'];
    $fileError4 = $_FILES['image4']['error'];

    $fileExt = explode('.', $fileName);//0 = file name, 1 = file type
    $fileActualExt = strtolower(end($fileExt));//store file type

    $fileExt1 = explode('.', $fileName1);
    $fileActualExt1 = strtolower(end($fileExt1));

    $fileExt2 = explode('.', $fileName2);
    $fileActualExt2 = strtolower(end($fileExt2));

    $fileExt3 = explode('.', $fileName3);
    $fileActualExt3 = strtolower(end($fileExt3));

    $fileExt4 = explode('.', $fileName4);
    $fileActualExt4 = strtolower(end($fileExt4));

    $allow = array("jpg", "jpeg", "png");
    if(in_array($fileActualExt, $allow) || in_array($fileActualExt1, $allow) || in_array($fileActualExt2, $allow) || 
    in_array($fileActualExt3, $allow) || in_array($fileActualExt4, $allow)){
        if($fileError === 0 || $fileError1 === 0 || $fileError2 === 0 || $fileError3 === 0 || $fileError4 === 0){
            if($fileSize < 3000000 || $fileSize1 < 3000000 || $fileSize2 < 3000000 || $fileSize3 < 3000000 || $fileSize4 < 3000000)
            {
                $fileNewName = uniqid('', true).'.'.$fileActualExt;
                if($fileActualExt1 != NULL)
                {
                    $fileNewName1 = uniqid('', true).'.'.$fileActualExt1;
                }
                if($fileActualExt2 != NULL)
                {
                    $fileNewName2 = uniqid('', true).'.'.$fileActualExt2;
                }
                if($fileActualExt3 != NULL)
                {
                    $fileNewName3 = uniqid('', true).'.'.$fileActualExt3;
                }
                if($fileActualExt4 != NULL)
                {
                    $fileNewName4 = uniqid('', true).'.'.$fileActualExt4;
                }
                
                $destination = 'upload/'.$fileNewName;
                if(isset($fileNewName1)){
                    $destination1 = 'upload/'.$fileNewName1;
                }
                if(isset($fileNewName2)){
                    $destination2 = 'upload/'.$fileNewName2;
                }
                if(isset($fileNewName3)){
                    $destination3 = 'upload/'.$fileNewName3;
                }
                if(isset($fileNewName4)){
                    $destination4 = 'upload/'.$fileNewName4;
                }
                
                move_uploaded_file($fileTmpName, $destination);
                if(isset($destination1)){
                    move_uploaded_file($fileTmpName1, $destination1);
                }
                if(isset($destination2)){
                    move_uploaded_file($fileTmpName2, $destination2);
                }
                if(isset($destination3)){
                    move_uploaded_file($fileTmpName3, $destination3);
                }
                if(isset($destination4)){
                    move_uploaded_file($fileTmpName4, $destination4);
                }

                $username = $_SESSION['username'];    
                $query = mysqli_query($db, "insert into product (name, description, category, brand, price, stock, user_id, mainimage)values('$name', '$des', '$category', '$brand', '$price', '$stock', '$username', '$fileNewName')");
                if(isset($fileNewName1)){
                    $query1 = mysqli_query($db, "update product set subimage1 = '$fileNewName1' where mainimage = '$fileNewName'");
                }
                if(isset($fileNewName2)){
                    $query2 = mysqli_query($db, "update product set subimage2 = '$fileNewName2' where mainimage = '$fileNewName'");
                }
                if(isset($fileNewName3)){
                    $query3 = mysqli_query($db, "update product set subimage3 = '$fileNewName3' where mainimage = '$fileNewName'");
                }
                if(isset($fileNewName4)){
                    $query4 = mysqli_query($db, "update product set subimage4 = '$fileNewName4' where mainimage = '$fileNewName'");
                }
                
                if ($query==true) {
                    echo "<script>alert('Product upload successfully!');location.href = 'menu.php';</script>";
                }
                else
                {
                    echo "<script>alert('Failed to upload product!');location.href = 'uploadproduct.php';</script>";
                }
                
            }
            else
            {
                echo "<script>alert('Your file is too big!');location.href = 'uploadproduct.php';</script>";
            }
        }
        else
        {
            echo "<script>alert('There was an error uploading your file!');location.href = 'uploadproduct.php';</script>";
        }
    }
    else
    {
        echo "<script>alert('You cannot upload this file type!');location.href = 'uploadproduct.php';</script>";
    }
     
}    
?>