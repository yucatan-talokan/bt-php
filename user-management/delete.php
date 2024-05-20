<?php
include_once "DbConnection.php";
$id = $_GET['id'];
$sql="DELETE FROM tbl_user WHERE id=:id";
$database = new DbConnection();
$conn = $database->openConnection();
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$conn = $database->closeConnection();
$stmt = null;
header("Location:/user-management/quanly.php");