<?php
class videos{
    private $conn;
    private $tb="tb_videos";

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function savevideo($vie_title,$vie_detail,$vie_date,$vie_file,$list_id,$user_id,$vie_poster){
        $sql="INSERT INTO ".$this->tb." SET vie_title=:vie_title,vie_detail=:vie_detail,vie_date=:vie_date,vie_poster=:vie_poster,vie_file=:vie_file,list_id=:list_id,user_id=:user_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":vie_title",$vie_title);
        $stmt->bindParam(":vie_detail",$vie_detail);
        $stmt->bindParam(":vie_date",$vie_date);
        $stmt->bindParam(":list_id",$list_id);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":vie_poster",$vie_poster);
        $stmt->bindParam(":vie_file",$vie_file);
        return $stmt->execute();
    }

    public function updatevideo($vie_id,$vie_title,$vie_detail,$vie_date,$vie_file,$user_id,$vie_poster){
        $sql="UPDATE ".$this->tb." SET vie_title=:vie_title,vie_detail=:vie_detail,vie_date=:vie_date,vie_poster=:vie_poster,user_id=:user_id,vie_file=:vie_file WHERE vie_id=:vie_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":vie_title",$vie_title);
        $stmt->bindParam(":vie_detail",$vie_detail);
        $stmt->bindParam(":vie_date",$vie_date);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":vie_poster",$vie_poster);
        $stmt->bindParam(":vie_file",$vie_file);
        $stmt->bindParam(":vie_id",$vie_id);
        return $stmt->execute();
    }

    public function deletevideo($vie_id){
        $sql="DELETE FROM ".$this->tb." WHERE vie_id=:vie_id ";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":vie_id",$vie_id);
        return $stmt->execute();
    }
}


?>