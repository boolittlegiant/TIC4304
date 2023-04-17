<?php
	$content = $_POST["content"];
    if ($content == '') {
        header("location: task1.php");
    }
	echo "The last xss code: [" . $content ."]";
?>

<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <script>
        function backclick() {
            window.location.href = "warmup.php";
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