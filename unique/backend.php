<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "position";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appName = $_POST["appName"];
    $appLink = $_POST["appLink"];

    // Check if file was uploaded successfully
    if (isset($_FILES["appImg"]) && $_FILES["appImg"]["error"] == 0) {
        $appImg = file_get_contents($_FILES["appImg"]["tmp_name"]);
    } else {
        die("Error uploading image.");
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO app_info (appImg, appName, appLink) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $appImg, $appName, $appLink);

    if ($stmt->execute()) {
        echo "<script>alert('Form submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vedio Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>ADD BEST VEDIO</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="appImg">App Image:</label>
        <input type="file" id="appImg" name="appImg" accept="image/*" required>

        <label for="appName">App Name:</label>
        <input type="text" id="appName" name="appName" required>        

        <label for="appLink">App Link:</label>
        <input type="url" id="appLink" name="appLink" required>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
