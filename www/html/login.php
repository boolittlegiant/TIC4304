<?php

// initialize the session
session_start();

// check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if ($_SESSION["username"] == "task1") {
        header("location: task1.php");
    } else if ($_SESSION["username"] == "task2") {
        header("location: task2.php");
    } else if ($_SESSION["username"] == "task0") {
        header("location: warmup.php");
    }
     else {
        header("location: task3.php");
    }
    exit;
}


require "config.php";

$username = $password = $username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
        $result = mysqli_query($link, $sql);
        // check the row number
        if (mysqli_num_rows($result) == 1) {
            // fetch the row
            $row = mysqli_fetch_assoc($result);

            if (strcmp($password, $row["password"]) == 0) {
                // password is correct, so start a new session
                session_start();                           
                // store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
		        $_SESSION["username"] = $username;               
                // redirect user to other page
                if ($username == "task1") {
                    header("location: task1.php");
                } else if ($_SESSION["username"] == "task2") {
                    header("location: task2.php");
                } else if ($_SESSION["username"] == "task0") {
                    header("location: warmup.php");
                } else {
                    header("location: task3.php");
                }
            } else {
                $password_err = "The password you entered was not valid.";
            }
        } else {
            $username_err = "No account found with that username.";
        }
    }
    mysqli_close($link);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="register.css">

</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h1>Login</h1>
            <p>Use your name and password to login the website.</p>
            <hr>

            <label for="user"><b>User</b></label>
            <input type="text" name="username" class="form-control" value="<?php echo $user; ?>">
      

            <label for="psw"><b>Password</b></label>
            <input type="password" name="password" class="form-control" value="<?php echo $pwd; ?>">
      
            <hr>

            <button type="submit" class="registerbtn">Login</button>
        </div>
    </form>    
</body>
</html>

