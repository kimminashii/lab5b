<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST" action="lab5b_login.php">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        <p><a href="lab5b_register.php">Register here if you have not.</a></p>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lab5b";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize and validate input
        $matric = $conn->real_escape_string($_POST["matric"]);
        $password = $conn->real_escape_string($_POST["password"]);

        // Check for user in the database
        $sql = "SELECT * FROM users WHERE matric='$matric' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<p class='success'>Login successful! Welcome.</p>";
            // Redirect to a new page or dashboard if needed
            // header("Location: dashboard.php");
        } else {
            echo "<p class='error'>Invalid username or password, try <a href='lab5b_login.php'>login</a> again.</p>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
