<?php
  $username = "admin";
  
  print_r(getenv());
  var_dump($_ENV);
  print(getenv('USER_NAME'));
  print(getenv('PASSWORD'));
  print(getenv('DB_NAME'));
  print(getenv('HOST_NAME'));
?>