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

    public function registerItineraray(array $post) {
      $sql = "INSERT INTO event 
        (travel_id, route_id, is_transport, start_datetime, place, detail) values 
        (:travel_id, :route_id, :is_transport, :start_datetime, :place, :detail)";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':travel_id', $post['travel_id']);
      $ps->bindValue(':route_id', $post['route_id']);
      $ps->bindValue(':is_transport', $post['is_transport']);
      $ps->bindValue(':start_datetime', $post['start_datetime']);
      $ps->bindValue(':place', $post['place']);
      $ps->bindValue(':detail', $post['detail']);
      try {
        $ps->execute();
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function registerTransport(array $post) {
      $sql = "INSERT INTO event (
        travel_id, 
        route_id, 
        is_transport, 
        charge, 
        departure_place, 
        arrival_place, 
        start_datetime, 
        end_datetime, 
        transport_id
      ) values (
        :travel_id, 
        :route_id, 
        :is_transport, 
        :charge, 
        :departure_place, 
        :arrival_place, 
        :start_datetime, 
        :end_datetime, 
        :transport_id
      )";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':travel_id', $post['travel_id']);
      $ps->bindValue(':route_id', $post['route_id']);
      $ps->bindValue(':is_transport', $post['is_transport']);
      $ps->bindValue(':charge', $post['charge']);
      $ps->bindValue(':departure_place', $post['departure_place']);
      $ps->bindValue(':arrival_place', $post['arrival_place']);
      $ps->bindValue(':start_datetime', $post['start_datetime']);
      $ps->bindValue(':end_datetime', $post['end_datetime']);
      $ps->bindValue(':transport_id', $post['transport_id']);
      try {
        $ps->execute();
      } catch (Exception $e) {
        $e->getMessage();
      }
    }
  }
?>