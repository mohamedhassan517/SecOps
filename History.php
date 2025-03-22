<?php
include 'db_connect.php';
include 'login.php';
$user_id = $_SESSION['user_id'];

// Query to select data from scans table, including the new 'url' column
$sql = "SELECT url, cve_number, link, Description, severity, solution FROM scans WHERE user_id=$user_id ORDER BY CASE severity
    WHEN 'Critical' THEN 1
    WHEN 'High' THEN 2
    WHEN 'Medium' THEN 3
    WHEN 'Low' THEN 4
    ELSE 5  -- Handle any other severities if needed
END;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History Output</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    h1 {
        text-align: center;
        color: #333;
    }
    .url-display {
        text-align: center;
        margin-top: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    a {
        color: #3498db;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Final Output</h1>
        <div class="url-display">
            <?php
            if ($result->num_rows > 0) {
                // Fetch the first row to get the URL
                $row = $result->fetch_assoc();
                echo "<p><a href='" . htmlspecialchars($row["url"]) . "' target='_blank'>" . htmlspecialchars($row["url"]) . "</a></p>";
            } else {
                echo "<p>No URL found</p>";
            }
            ?>
        </div>
        <table>
            <thead>
                <tr>
                    <th>CVE</th>
                    <th>Reference Link</th>
                    <th>Description</th>
                    <th>Severity</th>
                    <th>Solution</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output the first row that was already fetched
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["cve_number"]) . "</td>";
                    echo "<td><a href='" . htmlspecialchars($row["link"]) . "' target='_blank'>Reference Link</a></td>";
                    echo "<td>" . htmlspecialchars($row["Description"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["severity"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["solution"]) . "</td>";
                    echo "</tr>";

                    // Output the rest of the rows
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["cve_number"]) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row["link"]) . "' target='_blank'>Reference Link</a></td>";
                        echo "<td>" . htmlspecialchars($row["Description"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["severity"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["solution"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
