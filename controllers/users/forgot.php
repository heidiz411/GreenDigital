<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once '../../config/Database.php';
    $data = new Database();
    $db = $data->connect();

    $email = $_POST['email'] ?? '';
    $question = $_POST['question'] ?? '';
    $answer = $_POST['answer'] ?? '';

    include_once '../../models/users.php';
    $model = new users($db);

    $sql = "SELECT * FROM tb_users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM tb_forgotpassword WHERE user_id = :user_id AND question =: question AND answer = :answer";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $row['user_id']);
    $stmt->bindParam(':question', $question);
    $stmt->bindParam(':answer', $answer);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        $resetPass = $model->resetPassword($id, '12345678');
        $message = ['message' => 'รีเซตรหัสผ่านแล้ว รหัสผ่านใหม่ของคุณคือ: 12345678'];
    } else {
        $message = ['message' => 'คำตอบไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง'];
    }
    echo json_encode($message);
}
?>