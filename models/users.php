<?php

class users
{
    private $conn;
    private $tb = "tb_users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM " . $this->tb . " ORDER BY user_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT * FROM " . $this->tb . " WHERE user_id=:user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveUser($data, $user_id = null)
    {
        if ($user_id) {
            $sql = "UPDATE " . $this->tb . " SET
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
             org_id=:org_id
             WHERE user_id=:user_id";
        } else {
            $sql = "INSERT INTO " . $this->tb . " SET
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
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":password", $data['password']);
        $stmt->bindParam(":full_name", $data['full_name']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":address", $data['address']);
        $stmt->bindParam(":sub", $data['sub']);
        $stmt->bindParam(":dis", $data['dis']);
        $stmt->bindParam(":prov", $data['prov']);
        $stmt->bindParam(":zipcode", $data['zipcode']);
        $stmt->bindParam(":role", $data['role']);
        $stmt->bindParam(":image", $data['image']);
        $stmt->bindParam(":org_id", $data['org_id']);
        if ($user_id) {
            $stmt->bindParam(":user_id", $user_id);
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM " . $this->tb . " WHERE user_id=:user_id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPassword($user_id, $new_password = null)
    {
        $sql = "UPDATE " . $this->tb . " SET password=:password WHERE user_id=:user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":password", $new_password);
        $stmt->bindParam(":user_id", $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
