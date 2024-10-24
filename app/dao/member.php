<?php
  class Member {
    private $pdo;
    
    public function __construct() {
      require_once('Connection.php');
      $connect = new Connection();
      $this->pdo = $connect->getPdo();
    }

    public function getTravelIdListByUserId($user_id) {
      $sql = "SELECT travel_id FROM member WHERE user_id = :user_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':user_id', $user_id);
      try {
        $ps->execute();
        return $ps->fetchAll(PDO::FETCH_COLUMN);
      } catch (Exception $e) {
        $e->getMessage();
      }
    }
  }
?>