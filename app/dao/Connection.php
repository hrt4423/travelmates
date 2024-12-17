<?php
  class Connection{
    private $pdo;
    private $dsn;
    private $username;
    private $password;
    private $dbname;
    private $hostname;

    public function __construct() {
      try{
        $this->username = getenv('USER_NAME');
        $this->password = getenv('PASSWORD');
        $this->dbname = getenv('DB_NAME');
        $this->hostname = getenv('HOST_NAME');
        $this->dsn = "mysql:dbname={$this->dbname};host={$this->hostname};";
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
      }catch (\PDOException $e){
        print('Error:'.$e->getMessage());
        die();
      }
    }

    public function getPdo(){
      return $this->pdo;
    }

    public function getDsn(){
      return $this->dsn;
    }

    public function getUsername(){
      return $this->username;
    }

    public function getPassword(){
      return $this->password;
    }

    public function getDbname(){
      return $this->dbname;
    }

    public function getHostname(){
      return $this->hostname;
    }
  }
?>