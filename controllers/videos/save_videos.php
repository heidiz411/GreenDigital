<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    header('Content-Type: application/json; charset=utf-8');
    include_once '../../config/Database.php';
    include_once '../../model/videos.php';
    $data=new Database();
    $db=$data->connect();
    $videos=new videos($db);
    session_start();
    $vie_id = $_POST['vie_id'] ?? null;
    $vie_title=$_POST['vie_title'] ?? null;
    $vie_detail=$_POST['vie_detail'] ?? null;
    $list_id=$_POST['list_id'] ?? null;
    $vie_date=date('Y-m-d');
    $user_id=$_SESSION['user_id'] ?? null;
    $file=$_FILES['vie_file'] ?? null;
    $vie_file=null;
    $poster=$_FILES['vie_poster'] ?? null;
    $vie_poster=null;

    if(isset($poster) AND $poster['error'] === 0){
    $imagetype=['jpg','png','jpeg'];
    $ext=explode(".",$poster['name']);
    $file_ext=strtolower(end($ext));
    $picture=uniqid().".".$file_ext;
        if(in_array($file_ext,$imagetype)){
            move_uploaded_file($poster['tmp_name'],'../../image/poster/'.$picture);
            $vie_poster=$picture;
        }else{
            echo json_encode(["message" => "ชนิดรูปภาพไม่ถูกต้อง"]);
            exit;
        }
    }

    if(isset($file) AND $file['error'] === 0){
    $file_type=['mp4','webm','ogg'];
    $ext=explode(".",$file['name']);
    $file_ext=strtolower(end($ext));
    $file_name=uniqid().".".$file_ext;
        if(in_array($file_ext,$file_type)){
            move_uploaded_file($file['tmp_name'],'../../image/video/'.$file_name);
            $vie_file=$file_name;
        }else{
            echo json_encode(["message" => "ชนิดวิดีโอไม่ถูกต้อง"]);
            exit;
        }
    }

    if($vie_id == null){
        if($videos->savevideo($vie_title,$vie_detail,$vie_date,$vie_file,$list_id,$user_id,$vie_poster)){
            echo json_encode(["alert" => "เพิ่มวิดีโอสำเร็จ","reload" => true ]);
            exit;
        }else{
            echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
            exit;
        }
    }else{
        $sql="SELECT * FROM tb_videos WHERE vie_id=:vie_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(":vie_id",$vie_id);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        // $vie_file=$vie_file ?? $row['vie_file'];

        if(!empty($vie_file)){
            unlink('../../image/video/'.$row['vie_file']);
        }else{
            $vie_file= $row['vie_file'];
        }

        if(!empty($vie_poster)){
            unlink('../../image/video/'.$row['vie_poster']);
        }else{
            $vie_poster= $row['vie_poster'];
        }

        // $vie_poster=$vie_poster ?? $row['vie_poster'];
        if($videos->updatevideo($vie_id,$vie_title,$vie_detail,$vie_date,$vie_file,$user_id,$vie_poster)){
            echo json_encode(["alert" => "แก้ไขสำเร็จ","reload" => true ]);
            exit; 
        }else{
            echo json_encode(["messsage" => "มีบางอย่างผิดพลาด"]);
            exit; 
        }
    }

    
}else{
    echo "not found method";
}


?>