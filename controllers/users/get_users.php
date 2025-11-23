<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    $data=new Database();
    $db=$data->connect();

    $id=$_POST['user_id'];
    
    include_once '../../models/users.php';
    $model=new users($db);
    $row=$model->getUserById($id);
    echo json_encode($row);
}
?>