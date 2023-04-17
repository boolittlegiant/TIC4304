<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <script>
        function triggerclick() {
            window.location.href = "trigger_task2.php";
        }
        function logoutclick() {
            window.location.href = "logout.php";
        }
        function checkpost() {
            if (myform.content.value=="") {
                alert("Please input xss attack code!");
            }
        }
    </script>
    <div class="page-header">
        <h1>Hi, This Page Is for Task2.</h1>
    </div>
	<form action="./task2_submit.php" name="myform" method="POST" onsubmit="return checkpost();">
        <legend>Please Insert Your Attack Code:</legend>
        <br>
		<input value="" name="content" style="width:300px; height:20px;"/>
		<button value="submit" name="submit" class="button">Submit</button>
	</form>
    <br>
    <br>
    <p>
        <button name="trigger" class="button" onclick = "triggerclick()">Load</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button name="logout" class="button" onclick = "logoutclick()">Sign out</button>
    </p>
</body>
</html>