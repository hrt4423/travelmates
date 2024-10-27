<?php
  class Event {
    private $pdo;
    
    public function __construct() {
      require_once('Connection.php');
      $connect = new Connection();
      $this->pdo = $connect->getPdo();
    }

    public function searchEventByTravelId($travel_id) {
      $sql = "SELECT * FROM event WHERE travel_id = :travel_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':travel_id', $travel_id);
      try {
        $ps->execute();
        return $ps->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
        $e->getMessage();
      }
    }
  }
?>