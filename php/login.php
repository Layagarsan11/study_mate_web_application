<?php
session_start();
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check connection
    if (!$conn) {
        die("Database connection failed");
    }

    // SQL query
    $sql = "SELECT * FROM userdb WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check user
    if ($row = mysqli_fetch_assoc($result)) {

        // Verify password
        if (password_verify($password, $row['password'])) {

            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $row["username"];

            
            header("Location: ../html/index.html");
            exit();

        } else {
            echo "Invalid password!";
        }

    } else {
        echo "User not found!";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    echo "Invalid request!";
}
?>