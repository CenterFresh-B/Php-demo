<!DOCTYPE HTML>
<html>
<title>Login</title>
<Body style="background-color :aliceblue;">
    <div style="margin: 0 auto;display: flex;background-color : aquamarine;justify-content:center;align-items:center;width:700px;height:550px;">
        <div style="justify-content:center;background-color: coral;width:300px;height:200px;">
            <form method="POST">
                <label>Username : </label>
                <input type="text" name="username"><br>
                <label>Password : </label>
                <input type="password" name="password"><br>
                <input type="submit" name="Submit">
            </form>
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST" && isset( $_POST['username'],$_POST['password'] )){
                $uname = $_POST['username'];
                $password = $_POST['password'];
                
                echo "Username : $uname<br>";
                echo "Password : $password";
            }
            ?>
        </div>
    </div>
</Body>
</html>