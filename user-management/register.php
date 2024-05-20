<?php
include_once "DbConnection.php";
include_once "CheckExist.php";
$checkExist = new CheckExist();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($checkExist->existedUsername($_POST["username"])){
        $usernameError="Username existed";
    }
    if ($checkExist->existedEmail($_POST["email"])){
        $emailError="Email existed";
    }
    if (!$checkExist->existedUsername($_POST["username"])&&!$checkExist->existedEmail($_POST["email"])){
        $sql = "INSERT INTO tbl_user (username, password, email) VALUES (:username, :password, :email)";
        $database = new DbConnection();
        $conn = $database->openConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $_POST["username"]);
        $encryptedPassword = md5($_POST["password"]);
        $stmt->bindParam(":password", $encryptedPassword);
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $conn = $database->closeConnection();
        $stmt = null;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="register.php" method="post">
    <div>Username: <input type="text" name="username"></div>
    <p  style="color: red"><?php echo $usernameError?></p>
    <div>Password: <input type="text" name="password"></div>
    <div>Email: <input type="email" name="email"></div>
    <p  style="color: red"><?php echo $emailError?></p>
    <div><input type="submit" value="Đăng kí"></div>
</form>
</body>
</html>
