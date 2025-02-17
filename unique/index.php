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

// Fetch data from database
$sql = "SELECT id, appImg, appName, appLink FROM app_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Position content</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            width: 90%;
            max-width: 1200px;
            height: 90vh;
        }

        .sidebar {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #222;
            padding: 10px;
            margin-bottom: 10px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .post-box {
            display: flex;
            align-items: center;
            background: #1e1e1e;
            border-radius: 8px;
            border: 1px solid #4d4d4d;
            box-shadow: 0 2px 6px rgba(255, 255, 255, 0.1);
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            transition: 0.3s;
        }

        .post-box:hover {
            border-color: #ffffff;
        }

        .post-box img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 15px;
        }

        .post-title {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
        }

        @media (min-width: 768px) {
            .wrapper {
                flex-direction: row;
            }

            .sidebar {
                width: 30%;
                margin-bottom: 0;
            }

            .content {
                flex-grow: 1;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <img src="./img/logo.jpg" alt="Profile Icon">
            <h2>Unique Position</h2>
            <p>All Video Here!</p>
        </div>

        <div class="content">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='post-box'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['appImg']) . "' alt='App Image'>";
                    echo "<a href='" . htmlspecialchars($row['appLink']) . "' target='_blank' class='post-title'>" . htmlspecialchars($row['appName']) . "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p style='color:white;'>No posts found</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
