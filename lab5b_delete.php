<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $conn->real_escape_string($_GET['matric']);

    // SQL query to delete user
    $sql = "DELETE FROM users WHERE matric = '$matric'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
        header("Location: lab5b_display.php"); // Redirect to display page
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
