<?php

include "db.php";

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$db = new DbConnect();
$conn = $db->connect();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $user = json_decode(file_get_contents('php://input'));
        $sql = "SELECT * FROM Exam WHERE email LIKE '$user->email' AND password LIKE '$user->password' ";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            $data = ['status' => 1, 'message' => ""];
        } else {
            $data = ['status' => 0, 'message' => "Failed to login"];
        }
        echo json_encode($data);
        break;
    case 'GET':
        $user = json_decode(file_get_contents('php://input'));
        $sql = "SELECT * FROM Exam WHERE id LIKE '$user->id' ";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            $data = ['status' => 1, 'message' => ""];
        } else {
            $data = ['status' => 0, 'message' => "Failed to fectch data"];
        }
        break;
}
