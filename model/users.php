<?php
class users{
    private $conn;
    private $tb="tb_users";

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function saveuser($email,$password,$full_name,$phone,$address,$sub,$dis,$prov,$zipcode,$role,$image,$org_id){
        $sql="INSERT INTO ".$this->tb." SET
         email=:email,
         password=:password,
         full_name=:full_name,
         phone=:phone,
         address=:address,
         sub=:sub,
         dis=:dis,
         prov=:prov,
         zipcode=:zipcode,
         role=:role,
         image=:image,
         org_id=:org_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":full_name",$full_name);
        $stmt->bindParam(":phone",$phone);
        $stmt->bindParam(":address",$address);
        $stmt->bindParam(":sub",$sub);
        $stmt->bindParam(":dis",$dis);
        $stmt->bindParam(":prov",$prov);
        $stmt->bindParam(":zipcode",$zipcode);
        $stmt->bindParam(":role",$role);
        $stmt->bindParam(":image",$image);
        $stmt->bindParam(":org_id",$org_id);
        return $stmt->execute();
    }

    public function updateuser($user_id,$email,$password,$full_name,$phone,$address,$sub,$dis,$prov,$zipcode,$role,$image,$org_id){
        $sql="UPDATE ".$this->tb." SET
         email=:email,
         password=:password,
         full_name=:full_name,
         phone=:phone,
         address=:address,
         sub=:sub,
         dis=:dis,
         prov=:prov,
         zipcode=:zipcode,
         role=:role,
         image=:image,
         org_id=:org_id,
         WHERE user_id=:user_id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":full_name",$full_name);
        $stmt->bindParam(":phone",$phone);
        $stmt->bindParam(":address",$address);
        $stmt->bindParam(":sub",$sub);
        $stmt->bindParam(":dis",$dis);
        $stmt->bindParam(":prov",$prov);
        $stmt->bindParam(":zipcode",$zipcode);
        $stmt->bindParam(":role",$role);
        $stmt->bindParam(":image",$image);
        $stmt->bindParam(":org_id",$org_id);
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
