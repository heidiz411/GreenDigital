<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../config/Database.php';
    header('Content-Type: application/json');
    $data=new Database();
    $db=$data->connect();

    $email=$_POST['email'] ?? null;
    $password=$_POST['password'] ?? null;
    $remember=$_POST['remember'] ?? null;

    $sql="SELECT * FROM tb_users WHERE email=:email";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    if(!$row){
        echo json_encode(["message" => "ไม่มีชื่อผู้ใช้"]);
        exit;
    }elseif(!password_verify($password,$row['password'])){
        echo json_encode(["message" => "รหัสผ่านไม่ถูกต้อง"]);
        exit;
    }else{
        if(isset($remember)){
            setcookie("user_id",$row['user_id'],time() + (365 * 24 * 60 *60),"/");
        }
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        if($row['usertype'] == 'user'){
            echo json_encode(["alert" => "ยินดีต้อนรับ","page" => "views/home.php"]);
        }else{
            echo json_encode(["alert" => "ยินดีต้อนรับแอดมิน","page" => "views/edit_users.php"]);
        }
        exit;
    }
}

?>