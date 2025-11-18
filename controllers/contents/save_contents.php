<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once '../../config/Database.php';
    include_once '../../model/contents.php';
    header('Content-Type: application/json');

    $data = new Database();
    $db = $data->connect();
    $contents = new contents($db);
    session_start();

    $content_id = $_POST['content_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;
    $title = $_POST['title'] ?? null;
    $body = $_POST['body'] ?? null;
    $publish_at = date('Y-m-d');
    $expire_at = date('Y-m-d');
    $is_active = 1;
    $image_file = $_FILES['image'] ?? null;
    $image = null;

    if (isset($image_file) and $image_file['error'] === 0) {
        $imagetype = ['jpg', 'png', 'jpeg'];
        $ext = explode(".", $image_file['name']);
        $file_ext = strtolower(end($ext));
        $picture = uniqid() . "." . $file_ext;
        if (in_array($file_ext, $imagetype)) {
            move_uploaded_file($image_file['tmp_name'], '../../image/content/' . $picture);
            $image = $picture;
        } else {
            echo json_encode(["message" => "ชนิดรูปภาพไม่ถูกต้อง"]);
            exit;
        }
    }

    if ($content_id == null) {
        if ($contents->savecontent($user_id, $title, $body, $image, $publish_at, $expire_at, $is_active)) {
            echo json_encode(["alert" => "เพิ่มสำเร็จ", "reload" => true]);
            exit;
        } else {
            echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
            exit;
        }
    } else {
        $sql = "SELECT * FROM tb_contents WHERE content_id =:content_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":content_id", $content_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $image = $image ?? $row['image'];
        $password = $password ?? $row['password'];
        if ($contents->updatecontent($content_id, $user_id, $title, $body, $image, $publish_at, $expire_at, $is_active)) {
            echo json_encode(["alert" => "แก้ไขสำเร็จ", "reload" => true]);
            exit;
        } else {
            echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
            exit;
        }
    }
} else {
    echo "not found request";
}