
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futura | Ecommerce Website Design</title>
</head>
<body>
    <h1>Hello, this is your PHP index file!</h1>

    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "futura_ecommerce";
    
    // Create a connection
    $conn = new mysqli($host, $username, $password, $database);
    
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo "PHP is working!";
    ?>
</body>
</html>






