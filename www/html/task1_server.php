<?php
function filter($content)
{
	$filter = "/script|img/i";
	preg_match($filter, $content) && die("Your code has been filtered, please go back to last page and try other methods to perform XSS <br><br> <input type = \"button\" value=\"back\" onclick=\"location='task1.php'\"/> ");
	return $content;
}
	$content = $_POST["content"];
    if ($content == '') {
        header("location: task1.php");
    }
    $content = filter($content);
	echo "Your input: [" . $content ."]";
?>

<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <script>
        function backclick() {
            window.location.href = "task1.php";
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