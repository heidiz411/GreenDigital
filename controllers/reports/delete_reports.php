<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    
    $data=new Database();
    $db=$data->connect();

    $id=$_POST['id'] ?? null;
    $sql="DELETE FROM tb_reports WHERE rep_id=:rep_id";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(":rep_id",$id);
    if($stmt->execute()){
        echo json_encode(["alert" => "ลบสำเร็จ","reload" => true]);
        exit;
    }else{
        echo json_encode(["alert" => "มีบางอย่างผิดพลาด","reload" => true]);
        exit;
    }
}else{
    echo "not found method";
}


?>