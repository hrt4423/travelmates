<?php
  require_once('dao/travel.php');
  $travel = new Travel();

  $travel->addSampleData();
  $travel_title = $travel->getTravelTitle(1);

  var_dump($travel_title);

?>