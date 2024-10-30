<?php
  require_once('./dao/event.php');
  require_once('./dao/transport.php');
  $transport = new Transport();
  $event = new Event();

  $_POST['transport_id'] = 1;
  //var_dump($_POST);
  $event->registerItineraray($_POST);

  header('Location: ./travel_plan.php?travel_id=' . $_POST['travel_id']);


?>