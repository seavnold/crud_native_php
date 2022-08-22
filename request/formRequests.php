<?php
require_once("../database/database.php");
require_once("../models/client.php");

$db = new Database();
$client = new Client($db->connection());

$redirectUrl = "http://localhost/freelance/native-php/clients/clients.php";

// create client
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        try {
            $client->addClient($_POST);
        } catch (\Throwable $th) {
            die("Error: ". $th->getMessage());
        }
        header('location:'. $redirectUrl);
    }
}

// update client
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        try {
            $client->editClient($_POST);
        } catch (\Throwable $th) {
            die("Error: ". $th->getMessage());
        }
        header('location:'. $redirectUrl);
    }
}

// delete client
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        try {
            $client->removeClient($_GET);
        } catch (\Throwable $th) {
            die("Error: ". $th->getMessage());
        }
        header('location:'. $redirectUrl);
    }
}
?>