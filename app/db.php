<?php
	$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        PDO::ATTR_EMULATE_PREPARES => false);

    $dsn = 'mysql:host=localhost;dbname=travelmates;charset=utf8';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $username, $password, $opt);
    } catch (PDOException $e){
        echo "Error : " . $e->getMessage();
    }
?>