<?php
    class Client {
        private $db;
        private $table = "clients";

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function allClients() {
            
            $sql = "SELECT * FROM " . $this->table . "";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
        }

        public function addClient($request) {

            // sanitize params
            $inputs = $this->sanitizeInputs($request);

            // prepared statement
            $sql = "INSERT INTO " . $this->table . " (name, email, phone, address) VALUES (?,?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssss", $inputs["name"], $inputs["email"], $inputs["phone"], $inputs["address"]);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function editClient($request) {

            // sanitize params and id
            $inputs = $this->sanitizeInputs($request);
            $id = $this->checkId($request["id"]);

            // prepared statement
            $sql = "UPDATE " . $this->table . " SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssi", $inputs["name"], $inputs["email"], $inputs["phone"], $inputs["address"], $id);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
            $stmt->close();
            $this->db->connection()->close();
        }

        public function details($id):array {
            try {
                
                $details = [];
                // sanitize id
                $clientId = $this->checkId($id);

                // prepared statement
                $sql = "SELECT * FROM ". $this->table ." WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("i", $clientId);
                if($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $details = $result->fetch_assoc();
                    }
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            
            return $details;
        }

        public function removeClient($request) {

            // sanitize param id
            $id = $this->checkId($request["id"]);

            $sql = "DELETE FROM ". $this->table ." WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        private function sanitizeInputs($request):array {
            $inputs = [];
            $inputs["name"] = htmlspecialchars($request["name"]);
            $inputs["email"] = htmlspecialchars($request["email"]);
            $inputs["phone"] = htmlspecialchars($request["phone"]);
            $inputs["address"] = htmlspecialchars($request["address"]);
            return $inputs;
        }

        private function checkId($id):int {
            return (int)htmlspecialchars($id);
        }
    }
?>