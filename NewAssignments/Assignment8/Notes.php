<?php
require_once "Db_conn.php";

class Notes {
    private $conn;
    private $message = '';
    private $notes = [];

    public function __construct() {
        try {
            $db = new Db_conn();
            $this->conn = $db->dbOpen();
        } catch (PDOException $e) {
            $this->message = "Database error: " . $e->getMessage();
        }
    }

    public function addNote($dateTime, $noteContent) {
        try {
            $timestamp = date('Y-m-d H:i:s', strtotime($dateTime));
            
            $stmt = $this->conn->prepare("INSERT INTO note (date_time, note) VALUES (:date_time, :note)");
            $stmt->bindParam(':date_time', $timestamp, PDO::PARAM_STR);
            $stmt->bindParam(':note', $noteContent, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $this->message = "Note added successfully!";
            } else {
                $this->message = "Error adding note.";
            }
        } catch (PDOException $e) {
            $this->message = "Database error: " . $e->getMessage();
        }
    }

    public function getNotes($begDate = null, $endDate = null) {
        try {
            if ($begDate && $endDate) {
                $stmt = $this->conn->prepare("SELECT date_time, note FROM note WHERE date_time BETWEEN :begDate AND :endDate ORDER BY date_time DESC");
                $stmt->bindParam(':begDate', $begDate, PDO::PARAM_STR);
                $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare("SELECT date_time, note FROM note ORDER BY date_time DESC");
            }
            
            $stmt->execute();
            $this->notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->message = "Database error: " . $e->getMessage();
        }
    }

    public function getMessage() {
        return $this->message;
    }

    public function getNotesList() {
        return $this->notes;
    }
}
?> 