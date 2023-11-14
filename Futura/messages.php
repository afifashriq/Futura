<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "futura_ecommerce";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to avoid undefined index warnings
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$confirmationMessage = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert the user's message into the database
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $confirmationMessage = "Message sent successfully!";
    } else {
        $confirmationMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <h2>Contact Us</h2>
    <form action="messages.php" method="post">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea><br>

        <button type="submit" class="btn">Send Message</button>
    </form>

    <!-- Display the confirmation message -->
    <?php echo $confirmationMessage; ?>

    <!-- Add your footer or additional HTML content here -->
</body>
</html>
