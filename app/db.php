<?php
    // $dsn = 'mysql:host=localhost;dbname=travelmates;charset=utf8';
    // $username = 'root';
    // $password = 'root';

    $pdo;
    //$dsn = "mysql:host='$hostname';dbname='$dbname';charset=utf8";
    $username = '66f69a53f275cad1832406947a7f1128';
    $password = '2024Travelmates';
    $dbname = '66f69a53f275cad1832406947a7f1128';
    $hostname = 'mysql-3.mc.lolipop.lan';

    try {
        $dsn = "mysql:dbname={$this->dbname};host={$this->hostname};";
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e){
        echo "Error : " . $e->getMessage();
        die();
    }
?>