<?php 	session_start();
	require 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		
		$title = $_POST['blogTitle'];
		$content = $_POST['blogContent'];
		
		$user = $_SESSION['Username'];

		$sql = "INSERT INTO `blogdata`( `blogUser`, `blogTitle`, `blogContent`)
			   VALUES ('$user', '$title', '$content')";
		$result = mysqli_query($conn, $sql);
		if(!$result)
		{
			$_SESSION['message'] = "Unable to post Blog !!!";
			header("Location: blogView.php");
		}
		else {
            header("Location: blogView.php");
			$_SESSION['message'] = "Blog Posted successfull !!!";
		}

    }