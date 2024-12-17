<?php
  class Transport {
    private $pdo;
    
    public function __construct() {
      require_once('Connection.php');
      $connect = new Connection();
      $this->pdo = $connect->getPdo();
    }

    public function findTransportIdByName($transportation) {
      $sql = "SELECT transport_id FROM transport WHERE name = :name";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':name', $transportation);
      try {
        $ps->execute();
        return $ps->fetch(PDO::FETCH_COLUMN);
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function fetchAllTransport() {
      $sql = "SELECT * FROM transport";
      $ps = $this->pdo->prepare($sql);
      try {
        $ps->execute();
        return $ps->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
  }
?>