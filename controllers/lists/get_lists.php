<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    $data=new Database();
    $db=$data->connect();

    $list_id=$_POST['id'] ?? null;
    $sql="SELECT * FROM tb_lists WHERE list_id=:list_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":list_id",$list_id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
}
?>