<?php
// Set the cookie duration (1 day)
$cookie_duration = time() + (86400 * 1);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store the user's name in a cookie
    setcookie("user_name", $_POST["user_name"], $cookie_duration);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Cookie User Name Example</title>
</head>
<body>
    <?php
    // Check if the user's name is set in a cookie
    if (isset($_COOKIE["user_name"])) {
        // Display the user's name
        echo "<h2>Welcome, " . htmlspecialchars($_COOKIE["user_name"]) . "!</h2>";
    } else {
    ?>
        <form method="post">
            <label for="user_name">Enter your name:</label>
            <input type="text" name="user_name" id="user_name" required>
            <button type="submit">Submit</button>
        </form>
    <?php
    }
    ?>
</body>
</html>