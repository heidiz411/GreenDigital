<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once '../../config/Database.php';
    $data = new Database();
    $db = $data->connect();

    include_once '../../model/users.php';
    $users = new users($db);

    $id = $_POST['user_id'] ?? null;
    if ($users->deleteUser($id)) {
        echo json_encode(["alert" => "ลบสำเร็จ", "reload" => true]);
        exit;
    } else {
        echo json_encode(["alert" => "มีบางอย่างผิดพลาด", "reload" => true]);
        exit;
    }
} else {
    echo "not found method";
}
?>