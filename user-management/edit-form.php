<?php
include_once "DbConnection.php";
$id = $_GET['id'];
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
    $sql = "UPDATE tbl_user SET username=:username,email=:email,password=:password WHERE id=:id";
    $database = new DbConnection();
    $conn = $database->openConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_POST["id"]);
    $stmt->bindParam(":username", $_POST["username"]);
    if ($_POST["password"]!=$user["password"]){
        $encryptedPassword = md5($_POST["password"]);
        $stmt->bindParam(":password", $encryptedPassword);
    }
    $stmt->bindParam(":email", $_POST["email"]);
    $stmt->execute();
    $conn = $database->closeConnection();
    $stmt = null;
    header("Location:/user-management/quanly.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<h1>EDITING USER</h1>
<body>
<form action="edit-form.php" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $user["username"] ?>"
               name="username" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $user["email"] ?>"
               name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputEmail1" value="<?php echo $user["password"] ?>"
               name="password" aria-describedby="emailHelp">
    </div>
    <input type="hidden" value="<?php echo $user["id"] ?>" name="id">
    <div class="mb-3">
        <input class="btn btn-primary" type="submit" value="Cập nhật">
    </div>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
