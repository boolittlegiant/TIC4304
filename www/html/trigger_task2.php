<?php
	require_once("./config.php");
	session_start();
	$user = $_SESSION["username"];
	$sql = "select content from xss where username='$user' order by id DESC limit 1";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result)["content"];
	echo "The last xss code: [" . $row ."]";
?>

<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <script>
        function backclick() {
            window.location.href = "task2.php";
        }
        function logoutclick() {
            window.location.href = "logout.php";
        }
    </script>
    <p>
        <button name="back" class="button" onclick = "backclick()">Back</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button name="logout" class="button" onclick = "logoutclick()">Sign out</button>
    </p>
</body>
</html>