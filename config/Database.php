<?php

class Database
{
    private $host = '127.0.0.1';
    private $db_name = 'greendigital';
    private $username = 'root';
    private $password = '1234';
    private $charset = 'utf8mb4';
    public $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $str = sprintf("mysql:host=%s;dbname=%s;charset=%s", $this->host, $this->db_name, $this->charset);
            $this->conn = new PDO($str,$this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;            
        } catch (PDOException $exception) {

        }
    }
}

?>