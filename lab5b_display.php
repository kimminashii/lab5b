<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users Table with Update and Delete</title>
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Users Table</h2>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab5b";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL Query to fetch all users
    $sql = "SELECT matric, name, role FROM users";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Matric</th><th>Name</th><th>Role</th><th>Actions</th></tr>";

        // Display table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["matric"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["role"]) . "</td>";
            echo "<td>
                    <a href='lab5b_update.php?matric=" . urlencode($row["matric"]) . "'>Update</a> |
                    <a href='lab5b_delete.php?matric=" . urlencode($row["matric"]) . "'>Delete</a>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>No data found</p>";
    }

    $conn->close();
    ?>
</body>
</html>
