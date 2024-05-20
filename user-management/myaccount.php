<?php
session_start();
include_once "DbConnection.php";
$id=$_GET["id"];
$sql = "SELECT * FROM tbl_user WHERE id=:id";
$database = new DbConnection();
$conn = $database->openConnection();
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$conn = $database->closeConnection();
$stmt = null;
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password=md5($_POST["password"]);
    $sql="UPDATE tbl_user SET password=:password WHERE id=:id";
    $database = new DbConnection();
    $conn = $database->openConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_POST['id']);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $conn = $database->closeConnection();
    $stmt = null;
    session_destroy();
    header("location: index.php");
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
<h1>Change Password</h1>
<form action="myaccount.php" method="post">
    <p>Username: <?php echo $user["username"]?></p>
    Password <input type="password" name="password">
    <input type="hidden" name="id" value="<?php echo $user["id"]?>">
    <input type="submit" value="Submit">

</form>
</body>
</html>
