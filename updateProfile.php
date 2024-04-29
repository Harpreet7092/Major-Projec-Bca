<?php
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = dataFilter($_POST['name']);
	$mobile = dataFilter($_POST['mobile']);
	$user = dataFilter($_POST['uname']);
	$email = dataFilter($_POST['email']);
	$pass =	dataFilter(password_hash($_POST['pass'], PASSWORD_BCRYPT));
	$hash = dataFilter( md5( rand(0,1000) ) );
	$category = dataFilter($_POST['category']);
    $addr = dataFilter($_POST['addr']);

	$_SESSION['Email'] = $email;
    $_SESSION['Name'] = $name;
    $_SESSION['Password'] = $pass;
    $_SESSION['Username'] = $user;
    $_SESSION['Mobile'] = $mobile;
    $_SESSION['Category'] = $category;
    $_SESSION['Hash'] = $hash;
    $_SESSION['Addr'] = $addr;
    $_SESSION['Rating'] = 0;
}


require 'db.php';

$length = strlen($mobile);

if($length != 10)
{
	$_SESSION['message'] = "Invalid Mobile Number !!!";
	header("location: error.php");
	die();
}

if( $_SESSION['Category'] == 1)
{
    $where=$_SESSION['Email'];
    	$sql = "UPDATE `farmer` SET `fname`='$name',`fusername`='$user',`fpassword`='$pass',`fhash`='$hash',`femail`='$email',`fmobile`='$mobile',`faddress`='$addr' WHERE `femail`='$where'";

    	if (mysqli_query($conn, $sql))
    	{
			header("location: profileView.php");
            $_SESSION['message'] = "Data Updated Sucessfully";
            //$check = mail( $to, $subject, $message_body );

            //header("location: profileView.php");
    	}
    	else
    	{
    	    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    	    $_SESSION['message'] = "Registration failed!";
            header("location: error.php");
    	}


		
		
    
}

else
{   
    $where=$_SESSION['Email'];
    
    	$sql = "UPDATE `buyer` SET `bname`='$name',`busername`='$user',`bpassword`='$pass',`bhash`='$hash',`bemail`='$email',`bmobile`='$mobile',`baddress`='$addr' WHERE `bemail`='$where'";

        if (mysqli_query($conn, $sql))
    	{
			header("location: profileView.php");
            $_SESSION['message'] = "Data Updated Sucessfully";
            //$check = mail( $to, $subject, $message_body );

            //header("location: profileView.php");
    	}
    	else
    	{
    	    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    	    $_SESSION['message'] = "Updation failed!";
            header("location: error.php");
    	}
    
}

function dataFilter($data)
{
	$data = trim($data);
 	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  	return $data;
}

?>
