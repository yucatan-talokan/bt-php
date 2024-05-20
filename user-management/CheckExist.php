<?php
include_once "DbConnection.php";

class CheckExist
{
    function existedUsername($username): bool
    {
        $sql = "SELECT count(*) FROM tbl_user WHERE username=:username";
        $database = new DbConnection();
        $conn = $database->openConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $usernameExist = $stmt->fetchColumn();
        $conn = $database->closeConnection();
        $stmt = null;
        if ($usernameExist<=0){
            return false;
        }
        return true;
    }function existedEmail($email): bool
    {
        $sql = "SELECT count(*) FROM tbl_user WHERE email=:email";
        $database = new DbConnection();
        $conn = $database->openConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $emailExist = $stmt->fetchColumn();
        $conn = $database->closeConnection();
        $stmt = null;
        if ($emailExist<=0){
            return false;
        }
        return true;
    }
}