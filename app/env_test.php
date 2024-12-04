<?php
  $username = "admin";
  putenv("username=$username");
  print_r(getenv());
  print_r(getenv('username'));
?>