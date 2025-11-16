<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once '../../config/Database.php';
    include_once '../../model/lists.php';
    include_once '../../model/videos.php';
    $data=new Database();
    $db=$data->connect();
    $lists=new lists($db);
    $videos=new videos($db);

    $id=$_POST['id'] ?? null;
    if($lists->deletelist($id)){
        $sql="SELECT * FROM tb_videos WHERE list_id=:list_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam(":list_id",$id);
        $stmt->execute();
        $video=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($video as $row){
            if (!empty($row['vie_file'])) {
                $videoPath = '../../image/video/' . $row['vie_file'];
                if (file_exists($videoPath)) {
                    unlink($videoPath);
                }
            }

            if (!empty($row['vie_poster'])) {
                $posterPath = '../../image/poster/' . $row['vie_poster'];
                if (file_exists($posterPath)) {
                    unlink($posterPath);
                }
            }
            $videos->deletevideo($row['vie_id']);
        }
        echo json_encode(["alert" => "ลบสำเร็จ","reload" => true]);
        exit;
    }else{
        echo json_encode(["message" => "มีบางอย่างผิดพลาด"]);
        exit;
    }
}else{
    echo "not found method";
}


?>