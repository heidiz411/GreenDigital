<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    header('Content-Type: application/json');
    $data=new Database();
    $db=$data->connect();
    session_start();
    $rep_content=$_POST['rep_content'] ?? null;
    $rep_date=date('Y-m-d');
    $user_id=$_SESSION['user_id'];

    $sql="INSERT INTO tb_reports SET rep_content=:rep_content,rep_date=:rep_date,user_id=:user_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":rep_content",$rep_content);
    $stmt->bindParam(":rep_date",$rep_date);
    $stmt->bindParam(":user_id",$user_id);
    

    if($stmt->execute()){
        
            echo json_encode(["alert" => "รายงานแล้ว"]);
            exit; 
    }else{
       echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
        exit;
    }
}else{
    echo "not found request";
}

?>