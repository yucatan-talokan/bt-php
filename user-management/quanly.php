<?php
include_once "DbConnection.php";
$limit = 5;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM tbl_user LIMIT :limit OFFSET :offset";
$database = new DbConnection();
$conn = $database->openConnection();
$stmt = $conn->prepare($sql);
$stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
$stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$conn = $database->closeConnection();
$stmt = null;
?>
<?php
$sql = "SELECT count(*) FROM tbl_user";
$database = new DbConnection();
$conn = $database->openConnection();
$stmt = $conn->prepare($sql);
$stmt->execute();
$total = ceil(($stmt->fetchColumn()) / $limit);
$conn = $database->closeConnection();
$stmt = null;
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
<body>
<h1>USER MANAGEMENT</h1>
<a href="add-form.php" class="btn btn-primary">Thêm mới</a>
<table class="table table-striped">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Hành động</th>
    </tr>
    <?php
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user["username"] . "</td>";
        echo "<td>" . $user["email"] . "</td>";
        echo "<td>";
        echo '<a href="edit-form.php?id=' . $user["id"] . '" class="btn btn-primary">Sửa</a>';
        echo '<a href="delete.php?id=' . $user["id"] . '" class="btn btn-danger">Xóa</a>';
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
<div class="row">
    <div class="col-sm-1"><a href="quanly.php?page=<?php echo $page - 1 ?>" class="btn <?php if ($page <= 1) {
            echo "disabled";
        } ?> btn-success">Previous</a></div>
    <div class="col-sm-1"><p class="text-center">Page <?php echo $page . "/" . $total ?></p></div>
    <div class="col-sm-1"><a href="quanly.php?page=<?php echo $page + 1 ?>" class="btn <?php if ($page >= $total) {
            echo "disabled";
        } ?> btn-success">Next</a></div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
