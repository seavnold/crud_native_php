<?php
    class Database
    {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "nativephp";
        public $conn;

        // create connection
        public function connection() {
            try {
                $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            } catch (\Throwable $th) {
                die("Connection failed!: " . $th->getMessage());
            }
            return $this->conn;
        }
    }
?>