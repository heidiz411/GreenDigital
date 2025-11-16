<?php
class users{
    private $conn;
    private $tb="tb_users";

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function saveuser($email,$password,$fname,$lname,$image,$usertype,$user_id){
        $sql="INSERT INTO ".$this->tb." SET email=:email,password=:password,fname=:fname,lname=:lname,image=:image,usertype=:usertype,user_id=:user_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":fname",$fname);
        $stmt->bindParam(":lname",$lname);
        $stmt->bindParam(":image",$image);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":usertype",$usertype);
        return $stmt->execute();
    }

    public function updateuser($user_id,$email,$password,$fname,$lname,$image,$usertype){
        $sql="UPDATE ".$this->tb." SET email=:email,password=:password,fname=:fname,lname=:lname,image=:image,usertype=:usertype WHERE user_id=:user_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":fname",$fname);
        $stmt->bindParam(":lname",$lname);
        $stmt->bindParam(":image",$image);
        $stmt->bindParam(":usertype",$usertype);
        $stmt->bindParam(":user_id",$user_id);
        return $stmt->execute();
    }

    public function deleteuser($user_id){
        $sql="DELETE FROM ".$this->tb." WHERE user_id=:user_id ";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":user_id",$user_id);
        return $stmt->execute();
    }
}


?>