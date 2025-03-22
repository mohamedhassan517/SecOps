<?php
// include 'db_connect.php';
// include 'login.php';
// session_start();

// // Check if user is logged in
// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
//     header('Location: index.php#log'); 
//     exit();
// }

$user_id = $_SESSION['2'];

// Check if form submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST["Url"];
    $url = stripcslashes($_POST['Url']);
    
    // Execute Bash scripts with URL as argument
    // Example commands (replace with actual commands as needed)
    $output1 = shell_exec("bash nmap.sh " . escapeshellarg($url));
    $output5 = shell_exec("bash zapScript.sh " . escapeshellarg($url));
    $output2 = shell_exec("bash extract_cve.sh ");
    $output3 = shell_exec("bash ai.sh ");
}

function extractCvesAndLinks($output) {
    $lines = explode("\n", $output);
    $cves = [];

    foreach ($lines as $line) {
        // Match CWE IDs (e.g., CWE-1004)
        if (preg_match('/### (CWE-\d+):/', $line, $matches)) {
            $cwe_id = $matches[1];
            $cwe_number = substr($cwe_id, 4); // Remove "CWE-" prefix
            $link = "https://cwe.mitre.org/data/definitions/$cwe_number.html";
            $cves[] = [
                'cve' => $cwe_id,
                'link' => $link,
            ];
        }
    }

    return $cves;
}

// Function to extract severity levels
function extractSeverity($output) {
    $lines = explode("\n", $output);
    $severities = [];

    foreach ($lines as $line) {
        if (preg_match('/- \*\*Severity\*\*:\s*(\b(?:Low|Medium|High|Critical)\b)/i', $line, $matches)) {
            $severity = $matches[1];
            $severities[] = $severity;
        }
    }

    return $severities;
}

// Function to extract descriptions
function extractDescriptions($output) {
    $lines = explode("\n", $output);
    $descriptions = [];

    foreach ($lines as $line) {
        if (preg_match('/- \*\*Description\*\*:\s*(.+)/i', $line, $matches)) {
            $description = $matches[1];
            $descriptions[] = $description;
        }
    }

    return $descriptions;
}

// Function to extract solutions
function extractSolutions($output) {
    $lines = explode("\n", $output);
    $solutions = [];

    foreach ($lines as $line) {
        if (preg_match('/- \*\*Solution\*\*:\s*(.+)/i', $line, $matches)) {
            $solution = $matches[1];
            $solutions[] = $solution;
        }
    }

    return $solutions;
}

// Extract CVEs, severities, descriptions, and solutions from $output3
$cves = extractCvesAndLinks($output3);
$severities = extractSeverity($output3);
$descriptions = extractDescriptions($output3);
$solutions = extractSolutions($output3);



    // // Debugging: Print variables
    // echo "<h2>Debugging Output</h2>";
    // echo "<h3>\$output3:</h3>";
    // echo "<pre>";
    // print_r($output3);
    // echo "</pre>";

    // echo "<h3>\$cves:</h3>";
    // echo "<pre>";
    // print_r($cves);
    // echo "</pre>";

    // echo "<h3>\$severities:</h3>";
    // echo "<pre>";
    // print_r($severities);
    // echo "</pre>";

    // echo "<h3>\$descriptions:</h3>";
    // echo "<pre>";
    // print_r($descriptions);
    // echo "</pre>";

    // echo "<h3>\$solutions:</h3>";
    // echo "<pre>";
    // print_r($solutions);
    // echo "</pre>";
// // Connect to database
// if ($conn) {
//     // Insert CVEs, links, severities, descriptions, and solutions into database
//     foreach ($cves as $key => $cve) {
//         $cve_id = $conn->real_escape_string($cve['cve']);
//         $link = $conn->real_escape_string($cve['link']);
//         $severity = isset($severities[$key]) ? $conn->real_escape_string($severities[$key]) : 'Unknown';
//         $description = isset($descriptions[$key]) ? $conn->real_escape_string($descriptions[$key]) : 'No description available';
//         $solution = isset($solutions[$key]) ? $conn->real_escape_string($solutions[$key]) : 'No solution available';

//         $sql = "INSERT INTO scans (cve_number, link, severity, description, solution, user_id,url) VALUES ('$cve_id', '$link', '$severity', '$description', '$solution', $user_id,'$url')";

//         if ($conn->query($sql) !== TRUE) {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
// }

// Display the output in an HTML table
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script Output</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td {
            padding: 5px; /* Reduced padding for more compact rows */
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
        <h1>Final Report</h1>
        <p><a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
            <?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>
        </a></p>

        <?php if (!empty($cves)): ?>
            <table>
                <thead>
                    <tr>
                        <th>CVE</th>
                        <th>Reference Link</th>
                        <th>Severity</th>
                        <th>Description</th>
                        <th>Solution</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cves as $key => $cve): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cve['cve']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($cve['link']); ?>" target="_blank">Reference Link</a></td>
                            <td><?php echo isset($severities[$key]) ? htmlspecialchars($severities[$key]) : 'Unknown'; ?></td>
                            <td><?php echo isset($descriptions[$key]) ? htmlspecialchars($descriptions[$key]) : 'No description available'; ?></td>
                            <td><?php echo isset($solutions[$key]) ? htmlspecialchars($solutions[$key]) : 'No solution available'; ?></td>
                             <?php 
                            //$output4 = shell_exec("bash clear.sh ");
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No CVEs found in the report.</p>
               <?php 
                            //$output4 = shell_exec("bash clear.sh ");
                            ?>
        <?php endif; ?>
    </div>
</body>
</html>

