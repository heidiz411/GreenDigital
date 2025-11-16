<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    include_once '../../config/Database.php';
    include_once '../../model/lists.php';
    header('Content-Type: application/json');
    $data=new Database();
    $db=$data->connect();
    $lists=new lists($db);
    session_start();
    $list_id=$_POST['list_id'] ?? null;
    $list_title=$_POST['list_title'] ?? null;
    $user_id=$_SESSION['user_id'];
    $list_date=date('Y-m-d');
    $image_file=$_FILES['list_image'] ?? null;
    $list_image=null;

    if(isset($image_file) AND $image_file['error'] === 0){
    $imagetype=['jpg','png','jpeg'];
    $ext=explode(".",$image_file['name']);
    $file_ext=strtolower(end($ext));
    $picture=uniqid().".".$file_ext;
        if(in_array($file_ext,$imagetype)){
            move_uploaded_file($image_file['tmp_name'],'../../image/list/'.$picture);
            $list_image=$picture;
        }else{
            echo json_encode(["message" => "ชนิดรูปภาพไม่ถูกต้อง"]);
            exit;
        }
    }

    if($list_id == null){
        if($lists->savelist($list_title,$list_image,$list_date,$user_id)){
            echo json_encode(["alert" => "เพิ่มลิสย์สำเร็จ","reload" => true ]);
            exit;
        }else{
            echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
            exit;
        }
    }else{
        $sql="SELECT * FROM tb_lists WHERE list_id=:list_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(":list_id",$list_id);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        $list_image=$list_image ?? $row['list_image'];
        if($lists->updatelist($list_id,$list_title,$list_image,$list_date,$user_id)){
            echo json_encode(["alert" => "แก้ไขลิสย์สำเร็จ" ,"reload" => true ]);
            exit;
        }else{
            echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
            exit;
        }
    }
    
}else{
    echo "not found request";
}

?>