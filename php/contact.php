<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Check connection
    if (!$conn) {
        die("Database connection failed");
    }

    // Insert query
    $sql = "INSERT INTO contactdb (name, email, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("SQL Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

    if (mysqli_stmt_execute($stmt)) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message!";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>