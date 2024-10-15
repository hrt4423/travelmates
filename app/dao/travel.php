<?php
  namespace travel_mates;
  use \PDO;
  use \Connect;
  
  class Travel {
    private $pdo;
    
    public function __construct() {
      require_once('Connect.php');
      $connect = new Connection();
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