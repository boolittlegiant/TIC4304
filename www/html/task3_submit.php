<?php
	require 'config.php';
	session_start();

	$content = $_GET["content"];
	$user = $_SESSION["username"];

    // add filter function
	$sql = "INSERT INTO xss (username, content) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_content);
        $param_username = $user;
        $param_content = $content;

        // attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            header("location: task3.php");
        }
        else {
            echo "<script>alert('Something Wrong, please check it!');</script>";
        }
    }
?>