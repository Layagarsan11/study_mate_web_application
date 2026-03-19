<?php
session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check DB connection
    if (!$conn) {
        die("Database connection failed");
    }

    // Check if user already exists
    $sql = "SELECT * FROM userdb WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "User already exists! Please login.";
    } else {

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $insert_sql = "INSERT INTO userdb (username, password) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);

        mysqli_stmt_bind_param($insert_stmt, "ss", $username, $hashed_password);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo "Registration successful!";
        } else {
            echo "Error: Could not register user.";
        }

        mysqli_stmt_close($insert_stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>