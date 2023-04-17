<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <script>
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
        <h1>Hi, This Page Is for Task1.</h1>
    </div>
	<form action="./task1_server.php" name="myform" method="POST" onsubmit="return checkpost();">
        <legend>Please Insert Your Attack Code:</legend>
        <br>
		<input value="" name="content" style="width:300px; height:20px;"/>
		<button value="submit" name="submit" class="button">Submit</button>
	</form>
    <br>
    <br>
    <button name="logout" class="button" onclick = "logoutclick()">Sign out</button>
</body>
</html>