<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    include_once '../../model/videos.php';
    $data=new Database();
    $db=$data->connect();
    $videos=new videos($db);

    $id=$_POST['vie_id'] ?? null;
    if($videos->deletevideo($id)){
        echo json_encode(["alert" => "ลบสำเร็จ"]);
        exit;
    }else{
        echo json_encode(["alert" => "มีบางอย่างผิดพลาด"]);
        exit;
    }
}else{
    echo "not found method";
}


?>