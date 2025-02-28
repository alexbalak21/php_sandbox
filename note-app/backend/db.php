<?php
class DB {
    private $db;

    public function __construct() {
        $this->db = require_once "conn_db.php";
    }

    public function init_note (string $title) : int {
        $stmt = $this->db->prepare("INSERT INTO notes (title) VALUES (?)");
        $stmt->bind_param('s', $title);
        $stmt->execute();
        return $stmt->insert_id;
    }
}
?>