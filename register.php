<?php
	//reference to the database connection file
	include('dbcon.php');
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel = "stylesheet" type = "text/css" href = "css/editregister.css">
    <title>E-Commerce Online Platform System</title>
    <script>
        function inputnum(evt){
            var num = String.fromCharCode(evt.which);
            if(!(/[0-9]/.test(num))){
                evt.preventDefault();
            }
        }
        function maxlength(){
            var a = document.getElementById('length').value;
            var b = document.getElementById('username').value;
            var c = document.getElementById('password').value;
            var d = document.getElementById('add').value;
            if (a.length < 10 || a.length > 11){
                alert("Phone numbers must be ten or eleven digits!");
                return false;
            }
            if(b.length<5||b.length>10){
                alert("Username must be 5 to 10 characters");
                return false;
            }
            if(c.length<5||c.length>10){
                alert("Password must be 5 to 10 characters");
                return false;
            }
            if(d.length<10){
                alert("Address must be at least 10 characters");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class = "bgcolor">
        
        <div class = "headbox">
            <img src = "image/bbcd0d0616ba4d0a9d33cf1a48ac3f3b.PNG" >
            <h1>Register here!</h1>
        </div>
        <form method = "post" onsubmit = "return maxlength()">
            <div class = "main">
                <div class = "labelbox">
                    <label>Username : </label>
                    <label>Password : </label>
                    <label>Address : </label>
                    <label>Telephone number : </label>
                </div>
                <div class = "inputbox">
                    <input type = "text" name = "username" id = "username" placeholder = "username" required>
                    <input type = "password" name = "password" id = "password" placeholder = "password" required>
                    <input type = "text" name = "address" placeholder = "address" id = "add" required>
                    <input type = "text" name = "telnum" placeholder = "TelNo" id = "length" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" title = "Please enter correct phone number format." onkeypress = "inputnum(event)" required>
                </div>
            </div>
            
            <div class = "btn">
                <input type = "submit" name = "register" value = "Register">
                <input type = "button" name = "cancel" value = "Cancel" id = "cancel" onclick = "location.href='index.php'">
            </div>
        </form>
        
    </div>
</body>
</html>

<?php
    
    if(isset($_POST['register'])){
        $username =$_POST['username'];
        $password =$_POST['password'];
        $address =$_POST['address'];
        $telnum =$_POST['telnum'];
        
        if(!preg_match("/^[0-9]*$/", $telnum)){
            echo "<script>alert('Phone number can only enter number only!');</script>"; 
            exit();
        }
        
        $search = mysqli_query($db, "select 'username' from user where username='$username'");
        $result = mysqli_num_rows($search);
        if($result > 0)
		{
			//if exists in database, display error message
			echo "<script>alert('The username already in use. Please choose different one.');</script>";
		}
		else
		{
			//if no, insert new record into the database
			$sql = mysqli_query($db,"INSERT INTO user (username, password, address, telno)VALUES('{$username}', '{$password}', '{$address}', '{$telnum}')");
			// if insertion of data into database is successful
		    if ($sql == TRUE){ 
            //display message and directed user to Login interface
            echo "<script>alert('Register Successfully!');
                    window.location.href = 'index.php';</script>"; 
            }
		}
        
    } 
    
?>

























