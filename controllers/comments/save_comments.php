<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    include_once '../../model/comments.php';
    header('Content-Type: application/json');

    $data=new Database();
    $db=$data->connect();
    $comments=new comments($db);
    session_start();
   
    $com_content=$_POST['com_content'] ?? null;
    $com_date=date('Y-m-d');
    $vie_id=$_POST['vie_id'] ?? null;
    $user_id=$_SESSION['user_id'];

    if($comments->savecomments($com_content,$com_date,$vie_id,$user_id)){
        echo json_encode(["reload" => true ]);
    }
}

?>