
<?php
// Start session
// session_start();
include "connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details


    // Get user inputs from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the query returned a row (user exists)
    if ($result->num_rows > 0) {
        // Fetch user data
        $userData = $result->fetch_assoc();

        // Store user data in session
        $_SESSION['user'] = $userData;

        // Successful login
        echo "Login successful! Welcome, " . $userData['email'];

        // You can redirect the user to another page if needed
        // header("Location: dashboard.php");
        // exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password.";
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
