<?php
class DAO{
    //データベースに接続する
    public function dbConnect(){
        $pdo = new PDO('mysql:host=localhost; dbname=travelmates; charset=utf8',
                        'root', 'root');
        return $pdo;
    }
}
?>