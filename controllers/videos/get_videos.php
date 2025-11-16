<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    $data=new Database();
    $db=$data->connect();

    $vie_id=$_POST['id'] ?? null;
    $sql="SELECT * FROM tb_videos as v LEFT JOIN tb_users as u on v.user_id=u.user_id WHERE v.vie_id=:vie_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":vie_id",$vie_id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
}
?>