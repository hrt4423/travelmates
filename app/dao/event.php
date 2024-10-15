<?php
  class Event {
    private $pdo;
    
    public function __construct() {
      require_once('connect.php');
      $connect = new Connection();
      $this->pdo = $connect->getPdo();
    }
  }
?>