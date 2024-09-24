<?php
  namespace travel_mates;
  use \PDO;
  class Member {
    private $pdo;
    
    public function __construct() {
      require_once('connect.php');
      $connect = new Connect();
      $this->pdo = $connect->getPdo();
    }
  }
?>