<?php

include_once 'DatabaseConnection.php';

class DatabasePDO extends DatabaseConnection {

    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    function connect(): void {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function insert($modalitat, $nivell, $intents): int {
        try {
            $stmt = $this->connection->prepare("INSERT INTO estadistiques (modalitat, nivell, intents) VALUES (:modalitat, :nivell, :intents)");
            $stmt->bindParam(':modalitat', $modalitat);
            $stmt->bindParam(':nivell', $nivell);
            $stmt->bindParam(':intents', $intents);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function selectAll() {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }

    function selectByModalitat($modalitat) {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = :modalitat");
        $stmt->bindParam(':modalitat', $modalitat);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }

    function delete($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM estadistiques WHERE id = $id");
            $stmt->execute();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function deleteAll() {
        try {
            $stmt = $this->connection->prepare("DELETE FROM estadistiques");
            $stmt->execute();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function update($id, $modalitat, $nivell, $data, $intents) {
        try {
            $stmt = $this->connection->prepare("UPDATE estadistiques SET modalitat = '$modalitat', nivell = '$nivell', data_partida = '$data', intents = $intents WHERE id = $id");
            $stmt->execute();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function findById($id) {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE id = $id");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }
    
}