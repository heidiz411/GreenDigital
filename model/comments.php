<?php
class comments{
    private $conn;
    private $tb="tb_comments";

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function savecomments($com_content,$com_date,$vie_id,$user_id){
        $sql="INSERT INTO ".$this->tb." SET com_content=:com_content,com_date=:com_date,vie_id=:vie_id,user_id=:user_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":com_content",$com_content);
        $stmt->bindParam(":com_date",$com_date);
        $stmt->bindParam(":vie_id",$vie_id);
        $stmt->bindParam(":user_id",$user_id);
        return $stmt->execute();
    }

    public function updatecomments($com_id,$com_content,$com_date,$vie_id,$user_id){
        $sql="UPDATE ".$this->tb." SET com_content=:com_content,com_date=:com_date,vie_id=:vie_id,user_id=:user_id WHERE com_id=:com_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":com_content",$com_content);
        $stmt->bindParam(":com_date",$com_date);
        $stmt->bindParam(":vie_id",$vie_id);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":com_id",$com_id);
        return $stmt->execute();
    }

    public function deletecomments($com_id){
        $sql="DELETE FROM ".$this->tb." WHERE com_id=:com_id ";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":com_id",$com_id);
        return $stmt->execute();
    }
}
?>