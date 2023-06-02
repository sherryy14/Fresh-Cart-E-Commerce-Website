<?php
session_start();

// Assuming you have established a valid database connection
$conn = mysqli_connect("localhost", "root", "", "enc");

// Signup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Encrypt the password using Blowfish algorithm
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO `users` (username, password) VALUES ('$username', '$encryptedPassword')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Signup successful!";
    } else {
        echo "Signup failed!";
    }
}

// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        if (password_verify($password, $storedPassword)) {
            // Password is correct
            $_SESSION['username'] = $username;
            echo "Login successful!";
        } else {
            // Password is incorrect
            echo "Incorrect username or password!";
        }
    } else {
        // User not found
        echo "Incorrect username or password!";
    }
}

// Remember to close the database connection when you're done
mysqli_close($conn);
?>

<!-- HTML form for signup and login -->
<!DOCTYPE html>
<html>
<head>
    <title>Signup and Login</title>
</head>
<body>
    <!-- Signup form -->
    <h2>Signup</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="signup" value="Signup">
    </form>

    <!-- Login form -->
    <h2>Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
