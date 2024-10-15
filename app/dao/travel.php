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
    public function getTravelTitle($travel_id) {
        $sql = "SELECT title FROM travel";
        $ps = $this->pdo->prepare($sql);
        $ps->execute();
        return $ps->fetch(PDO::FETCH_ASSOC);
    }
  }
?>