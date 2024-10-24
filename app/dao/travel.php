<?php
  class Travel {
    private $pdo;
    
    public function __construct() {
      require_once('Connection.php');
      $connect = new Connection();
      $this->pdo = $connect->getPdo();
    }
    public function getTravelTitle($travel_id) {
        $sql = "SELECT title FROM travel";
        $ps = $this->pdo->prepare($sql);
        $ps->execute();
        return $ps->fetch(PDO::FETCH_ASSOC);
    }

    public function addSampleData() {
      $sql = "INSERT INTO travel (title, management_id) VALUES ('サンプルデータ', 1)";
      $ps = $this->pdo->prepare($sql);
      $ps->execute();
    }

    public function getTravelByTravelId($travel_id) {
      $sql = "SELECT * FROM travel WHERE travel_id = :travel_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':travel_id', $travel_id);
      try {
        $ps->execute();
        return $ps->fetch(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
        $e->getMessage();
      }
    }

  }

?>