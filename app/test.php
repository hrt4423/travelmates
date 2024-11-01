<?php
  require_once('dao/transport.php');
  $transport = new Transport();
  var_dump($transport->fetchAllTransport());


?>