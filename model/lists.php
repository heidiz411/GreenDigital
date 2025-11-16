<?php
class lists{
    private $conn;
    private $tb="tb_lists";

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function savelist($list_title,$list_image,$list_date,$user_id){
        try {
        $this->conn->beginTransaction();

        $sql = "INSERT INTO ".$this->tb." SET list_title=:list_title,list_image=:list_image,list_date=:list_date,user_id=:user_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":list_title", $list_title);
        $stmt->bindParam(":list_image", $list_image);
        $stmt->bindParam(":list_date", $list_date);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
        $this->conn->commit();
        return true;
    } catch (Exception $e) {
        $this->conn->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }

    }

    public function updatelist($list_id,$list_title,$list_image,$list_date,$user_id){

        try {
            $this->conn->beginTransaction();
            $sql="UPDATE ".$this->tb." SET list_title=:list_title,list_image=:list_image,list_date=:list_date,user_id=:user_id WHERE list_id=:list_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->bindParam(":list_title",$list_title);
            $stmt->bindParam(":list_image",$list_image);
            $stmt->bindParam(":list_date",$list_date);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":list_id",$list_id);
            $stmt->execute();
            $this->conn->commit();
        return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deletelist($list_id){
        $sql="DELETE FROM ".$this->tb." WHERE list_id=:list_id ";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":list_id",$list_id);
        return $stmt->execute();
    }
}
?>