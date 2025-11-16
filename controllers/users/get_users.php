<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    $data=new Database();
    $db=$data->connect();

    $user_id=$_POST['id'] ?? null;
    $sql="SELECT * FROM tb_users WHERE user_id=:user_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
}
?>