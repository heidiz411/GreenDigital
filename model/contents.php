<?php

class contents
{
    private $conn;
    private $tb = "tb_contents";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function savecontent($user_id, $title, $body, $image, $publish_at, $expire_at, $is_active)
    {
        $sql = "INSERT INTO " . $this->tb . " SET user_id=:user_id,title=:title,body=:body,image=:image,publish_at=:publish_at,expire_at=:expire_at,is_active=:is_active";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":publish_at", $publish_at);
        $stmt->bindParam(":expire_at", $expire_at);
        $stmt->bindParam(":is_active", $is_active);
        return $stmt->execute();
    }

    public function updatecontent($content_id, $user_id, $title, $body, $image, $publish_at, $expire_at, $is_active)
    {
        $sql = "UPDATE " . $this->tb . " user_id=:user_id,title=:title,body=:body,image=:image,publish_at=:publish_at,expire_at=:expire_at,is_active=:is_active WHERE content_id=:content_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":content_id", $content_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":publish_at", $publish_at);
        $stmt->bindParam(":expire_at", $expire_at);
        $stmt->bindParam(":is_active", $is_active);
        return $stmt->execute();
    }

    public function deletecontent($content_id)
    {
        $sql = "DELETE FROM " . $this->tb . " WHERE content_id=:content_id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":content_id", $content_id);
        return $stmt->execute();
    }
}


?>