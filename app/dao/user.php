<?php
  class User {
    private $pdo;
    
    public function __construct() {
      require_once('connect.php');
      $connect = new Connect();
      $this->pdo = $connect->getPdo();
    }
    public function registUser($userData) {
        $sql = "INSERT INTO user (name, password, email, icon_path) 
                VALUES (?, ?, ?, ?)";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(1, $userData['name'], PDO::PARAM_STR);
        $ps->bindValue(2, password_hash($userData['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $ps->bindValue(3, $userData['email'], PDO::PARAM_STR);
        $ps->bindValue(4, $userData['icon_path'], PDO::PARAM_STR);
        $ps->execute();
    }
    public function getUserId($password,$email) {
        $sql = "SELECT * FROM user WHERE $password = ? AND  $email = ?";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(1, $password, PDO::PARAM_STR);
        $ps->bindValue(2, $email, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetch(PDO::FETCH_ASSOC);
        return $result['user_id']; 
    }
  }
?>