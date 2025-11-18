<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once '../../config/Database.php';
    $data = new Database();
    $db = $data->connect();

    $content_id = $_POST['id'] ?? null;
    $sql = "SELECT * FROM tb_contents WHERE content_id=:content_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":content_id", $content_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
}