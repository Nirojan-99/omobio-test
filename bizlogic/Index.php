<?php

include "db.php";
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$db = new DbConnect();
$conn = $db->connect();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $user = json_decode(file_get_contents('php://input'));
        $sql = "SELECT * FROM Exam WHERE email LIKE '$user->email' AND password LIKE '$user->password' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            $obj = mysqli_fetch_object($result);
            $_SESSION['id'] = $obj->id;
            echo json_encode($obj);
        }
        break;
    case 'GET':
        $user = json_decode(file_get_contents('php://input'));
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM Exam WHERE id LIKE '$id' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            $obj = mysqli_fetch_object($result);
            echo json_encode($obj);
        }
        break;
}
