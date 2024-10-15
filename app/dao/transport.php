<?php
  class Transport {
    private $pdo;
    
    public function __construct() {
      require_once('connect.php');
      $connect = new Connect();
      $this->pdo = $connect->getPdo();
    }
  }
?>