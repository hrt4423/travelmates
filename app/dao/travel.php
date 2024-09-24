<?php
  namespace travel_mates;
  use \PDO;
  class Travel {
    private $pdo;
    
    public function __construct() {
      require_once('connect.php');
      $connect = new Connect();
      $this->pdo = $connect->getPdo();
    }
    public function getTravelTitle($password,$email) {
        $sql = "SELECT * FROM user , member WHERE $password = ? AND  $email = ?";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(1, $password, PDO::PARAM_STR);
        $ps->bindValue(2, $email, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetch(PDO::FETCH_ASSOC);
        return $result['user_id']; 
    }
  }
?>