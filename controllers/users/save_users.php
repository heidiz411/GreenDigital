<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once '../../config/Database.php';
    include_once '../../model/users.php';
    header('Content-Type: application/json');
    $data = new Database();
    $db = $data->connect();
    $users = new users($db);

    $user_id = $_POST['user_id'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $full_name = $_POST['full_name'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $address = $_POST['address'] ?? null;
    $sub = $_POST['sub'] ?? null;
    $dis = $_POST['dis'] ?? null;
    $prov = $_POST['prov'] ?? null;
    $zipcode = $_POST['zipcode'] ?? null;
    $role = $_POST['role'] ?? null;
    $org_id = $_POST['org_id'] ?? null;
    $image_file = $_FILES['image'] ?? null;
    $image = null;

    if (isset($image_file) and $image_file['error'] === 0) {
        $imagetype = ['jpg', 'png', 'jpeg'];
        $ext = explode(".", $image_file['name']);
        $file_ext = strtolower(end($ext));
        $picture = uniqid() . "." . $file_ext;
        if (in_array($file_ext, $imagetype)) {
            move_uploaded_file($image_file['tmp_name'], '../../image/user/' . $picture);
            $image = $picture;
        } else {
            echo json_encode(["message" => "ชนิดรูปภาพไม่ถูกต้อง"]);
            exit;
        }
    }

    if ($user_id == null) {
        $sql = "SELECT * FROM tb_users WHERE email=:email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo json_encode(["message" => "มีชื่อผู้ใช้แล้ว"]);
            exit;
        } else {
            if ($users->saveuser($email,$password,$full_name,$phone,$address,$sub,$dis,$prov,$zipcode,$role,$image,$org_id)) {
                echo json_encode(["alert" => "สมัครสมาชิกสำเร็จ", "reload" => true]);
                exit;
            } else {
                echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
                exit;
            }
        }
    } else {
        $sql = "SELECT * FROM tb_users WHERE email=:email AND user_id !=:user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo json_encode(["message" => "email นี้ถูกใช้ไปแล้ว"]);
            exit;
        } else {
            $sql = "SELECT * FROM tb_users WHERE user_id =:user_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $image = $image ?? $row['image'];
            $password = $password ?? $row['password'];
            if ($users->updateuser($user_id,$email,$password,$full_name,$phone,$address,$sub,$dis,$prov,$zipcode,$role,$image,$org_id)) {
                echo json_encode(["alert" => "แก้ไขสำเร็จ", "reload" => true]);
                exit;
            } else {
                echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
                exit;
            }
        }
    }
} else {
    echo "not found request";
}