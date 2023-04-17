<?php
function strong_filter($content)
{
	$content = str_replace("alert","", $content);
	$filter = "/script|img/i";
	preg_match($filter, $content) && die("Your code has been filtered, please go back to last page and try other methods to perform XSS. <br><br> <input type = \"button\" value=\"back\" onclick=\"location='task2.php'\"/> ");
	return $content;
}
	require 'config.php';
	session_start();
    $content = $_POST["content"];
	$content = strong_filter($content);
	$user = $_SESSION["username"];

    // add filter function
	$sql = "INSERT INTO xss (username, content) VALUES (?, ?)";

    if ($content !== "" && $stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_content);
        $param_username = $user;
        $param_content = $content;

        // attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            header("location: task2.php");
        }
        else {
            echo "<script>alert('Something Wrong, please check it!');</script>";
        }
    }
?>