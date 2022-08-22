<?php
include_once("../database/database.php");
include_once("../models/client.php");

$db = new Database();
$client = new Client($db->connection());

$results = $client->allClients();
$db->connection()->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">

  <title>Native | PHP</title>
</head>
<body>
    <div class="container mx-auto">
        <div class="flex items-center h-screen w-full">
            <div class="h-19/20 w-full">
                <div class="w-full">
                    <h1 class="text-5xl my-2">Clients</h1>
                    <!-- <button class="bg-green-600 hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-400 px-8 py-2 text-cyan-50 rounded-lg">Add</button> -->
                    <a class="add--btn" href="create.php">New Client</a>
                </div>
                <div class="my-5">
                    <table class="clients--table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($results->num_rows > 0) {
                                    while($row = $results->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td>
                                    <td><?php echo $row["phone"]; ?></td>
                                    <td><?php echo $row["address"]; ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row["id"]; ?>" class="action--btn btn--blue">Edit</a>
                                        <a href="../request/formRequests.php?id=<?php echo $row["id"]; ?>" class="action--btn btn--red">Delete</a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>