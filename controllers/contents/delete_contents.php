<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once '../../config/Database.php';
    include_once '../../model/contents.php';
    $data = new Database();
    $db = $data->connect();
    $contents = new contents($db);

    $id = $_POST['id'] ?? null;
    if ($contents->deletecontent($id)) {
        echo json_encode(["alert" => "ลบสำเร็จ", "reload" => true]);
        exit;
    } else {
        echo json_encode(["alert" => "มีบางอย่างผิดพลาด", "reload" => true]);
        exit;
    }
} else {
    echo "not found method";
}
