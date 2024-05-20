<?php
session_start();
include_once "DbConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_user WHERE username = :username AND password = :password";
    $database = new DbConnection();
    $conn = $database->openConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['id']=$user['id'];
        $error="";
        header('Location: index.php');
        exit();
    }
    else{
        $error="Invalid Username or Password";
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
<h2>Đăng nhập</h2>
<form action="login.php" method="post">

    <div>Username: <input type="text" name="username"></div>

    <div>Password: <input type="text" name="password"></div>
    <?php if (!empty($error)):?>
        <p style="color: red"><?php echo $error;?></p>
    <?php endif;?>

    <div><input type="submit" value="Đăng nhập"></div>
</form>
</body>
</html>
