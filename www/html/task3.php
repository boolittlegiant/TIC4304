<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <script>
        function logoutclick() {
            window.location.href = "logout.php";
        }
        function checkget() {
            if (myform.content.value=="") {
                alert("Please input xss attack code!");
            }
        }
    </script>
    <div class="page-header">
        <h1>Hi <?php session_start();echo "[".$_SESSION["username"]."]";?>, This Page Is for Task3.</h1>
        <p> <b>Task 3 Introduction:</b> <br>There are four buttons A, B, C and D representing four users.<br> Current user can click an arbitray button to read the lastest user input stored in the database.<br>
        Also, Current user can update its last record with following textbox.</p>
    </div>

    <p>
    <input type="button" value="A" onclick="location='task3_check.php?username=A'" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value="B" onclick="location='task3_check.php?username=B'" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value="C" onclick="location='task3_check.php?username=C'" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value="D" onclick="location='task3_check.php?username=D'" />
    </p>

	<form action="./task3_submit.php" name="myform" method="GET" onsubmit="return checkget();">
        <legend>Please Insert Your Attack Code:</legend>
        <br>
		<input value="" name="content" style="width:300px; height:20px;"/>
		<button value="submit" name="submit" class="button">Submit</button>
	</form>
    <br>
    <br>
    <p>
        <button name="logout" class="button" onclick = "logoutclick()">Sign out</button>
    </p>
</body>
</html>