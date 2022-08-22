<?php
    require_once("../database/database.php");
    require_once("../models/client.php");

    $db = new Database();
    $client = new Client($db->connection());

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['id']) {        
        $clientDetail = $client->details($_GET['id']);
    }
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
                    <h1 class="text-5xl my-2">Create Client</h1>
                </div>
                <div class="my-5 flex justify-center">
                    <form action="../request/formRequests.php" method="post" class="create--client--form">
                    <input type="hidden" name="id" value="<?php echo $clientDetail["id"];?>" />
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $clientDetail["name"]; ?>">
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="name" name="email" placeholder="Email" value="<?php echo $clientDetail["email"]; ?>">
                        </div>
                        <div>
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" placeholder="Phone" value="<?php echo $clientDetail["phone"]; ?>">
                        </div>
                        <div>
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $clientDetail["address"]; ?>">
                        </div>
                        <div>
                            <button name="update">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>