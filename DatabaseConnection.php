<?php

abstract class DatabaseConnection {
    
    protected string $servername;
    protected string $username;
    protected string $password;
    protected $connection;

    function __construct($servername, $username, $password) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
    }

    function __destruct() {
        $this->connection = null;
    }
    
    public function getConnection() {
        return $this->connection;
    }

}