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

    // Fetch existing user data
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $conn->real_escape_string($_POST['matric']);
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);

    // Update query
    $sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
        header("Location: lab5b_display.php"); // Redirect to display page
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="post" action="lab5b_update.php">
        <label>Matric:</label>
        <input type="text" name="matric" value="<?php echo htmlspecialchars($row['matric']); ?>" readonly><br><br>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"><br><br>
        <label>Role:</label>
        <input type="text" name="role" value="<?php echo htmlspecialchars($row['role']); ?>"><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
