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
    $scripts = [
        "nmap.sh",
        "zapScript.sh",
        "Nuclei.sh",
        "nikto.sh",
        "wapiti.sh"
    ];
    
    
    $processes = [];
    
    foreach ($scripts as $script) {
        $descriptorspec = [
            0 => ["pipe", "r"],  // stdin
            1 => ["pipe", "w"],  // stdout
            2 => ["pipe", "w"]   // stderr
        ];
    
        $command = "bash " . $script . " " . escapeshellarg($url);
        $process = proc_open($command, $descriptorspec, $pipes);
    
        if (is_resource($process)) {
            $processes[] = [
                'process' => $process,
                'pipes' => $pipes
            ];
        }
    }
    
    foreach ($processes as $process) {
        $output = stream_get_contents($process['pipes'][1]);
        fclose($process['pipes'][1]);
        fclose($process['pipes'][2]);
        proc_close($process['process']);
    
        echo $output . PHP_EOL;
    }

   

    $output2 = shell_exec("bash extract_cve.sh ");
    // $output3 = shell_exec("bash ai.sh ");

    /************************************************************************standard response from chatgpt4o ******************************************************/
//     $output3 = "Response from ChatGPT:
// Based on the provided report, I will extract the CWEs and vulnerabilities, along with their descriptions, solutions, and severity levels. Unfortunately, no CVEs are mentioned in the report.
// ### CVEs

// 1. **CVE-2020-3231**
//    - **Link**: [CVE-2020-3231](https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2020-3231)
//    - **Description**: This CVE typically involves a vulnerability in Cisco products that could allow an attacker to execute arbitrary code or cause a denial of service.
//    - **Solution**: Update to the latest version of the affected software as per Cisco's advisory.
//    - **Severity**: High

// 2. **CVE-2023-2023**
//    - **Link**: [CVE-2023-2023](https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2023-2023)
//    - **Description**: Details for this CVE would need to be looked up as it may involve a specific vulnerability disclosed in 2023.
//    - **Solution**: Follow the vendor's security advisory for patches or mitigations.
//    - **Severity**: Critical (assumed based on typical CVE numbering)
// ### CWEs

// 1. **CWE-1004: Sensitive Cookie Without 'HttpOnly' Flag**
//    - **Link**: [CWE-1004](https://cwe.mitre.org/data/definitions/1004.html)
//    - **Description**: This weakness occurs when a web application does not set the 'HttpOnly' flag on cookies containing sensitive information, making them accessible to client-side scripts.
//    - **Solution**: Ensure that the 'HttpOnly' flag is set for all cookies containing sensitive information.
//    - **Severity**: Medium

// 2. **CWE-1021: Improper Restriction of Rendered UI Layers or Frames**
//    - **Link**: [CWE-1021](https://cwe.mitre.org/data/definitions/1021.html)
//    - **Description**: This issue arises when a web application does not properly restrict the rendering of its UI layers or frames, potentially allowing clickjacking attacks.
//    - **Solution**: Implement the X-Frame-Options header to prevent framing by unauthorized sites.
//    - **Severity**: Medium

// 3. **CWE-1275: Sensitive Cookie in HTTPS Session Without 'Secure' Attribute**
//    - **Link**: [CWE-1275](https://cwe.mitre.org/data/definitions/1275.html)
//    - **Description**: Occurs when cookies are transmitted over HTTPS without the 'Secure' attribute, risking exposure if sent over an unencrypted connection.
//    - **Solution**: Set the 'Secure' attribute for cookies to ensure they are only sent over secure connections.
//    - **Severity**: Medium

// 4. **CWE-200: Exposure of Sensitive Information to an Unauthorized Actor**
//    - **Link**: [CWE-200](https://cwe.mitre.org/data/definitions/200.html)
//    - **Description**: This weakness involves the exposure of sensitive information to unauthorized users.
//    - **Solution**: Implement proper access controls and data protection measures.
//    - **Severity**: High

// 5. **CWE-319: Cleartext Transmission of Sensitive Information**
//    - **Link**: [CWE-319](https://cwe.mitre.org/data/definitions/319.html)
//    - **Description**: Sensitive information is transmitted in cleartext, which can be intercepted by attackers.
//    - **Solution**: Use encryption protocols like TLS to protect data in transit.
//    - **Severity**: High

// 6. **CWE-436: Interpretation Conflict**
//    - **Link**: [CWE-436](https://cwe.mitre.org/data/definitions/436.html)
//    - **Description**: Different interpretations of input data can lead to security vulnerabilities.
//    - **Solution**: Standardize input data processing and validation.
//    - **Severity**: Medium

// 7. **CWE-525: Use of Web Browser Cross-Domain Capabilities**
//    - **Link**: [CWE-525](https://cwe.mitre.org/data/definitions/525.html)
//    - **Description**: Exploiting cross-domain capabilities of web browsers can lead to unauthorized data access.
//    - **Solution**: Implement strict cross-origin resource sharing (CORS) policies.
//    - **Severity**: Medium

// 8. **CWE-565: Reliance on Cookies without Validation and Integrity Checking**
//    - **Link**: [CWE-565](https://cwe.mitre.org/data/definitions/565.html)
//    - **Description**: Relying on cookies without proper validation can lead to security issues.
//    - **Solution**: Validate and check the integrity of cookies before use.
//    - **Severity**: Medium

// 9. **CWE-614: Sensitive Cookie in HTTPS Session Without 'Secure' Attribute**
//    - **Link**: [CWE-614](https://cwe.mitre.org/data/definitions/614.html)
//    - **Description**: Similar to CWE-1275, this involves cookies in HTTPS sessions lacking the 'Secure' attribute.
//    - **Solution**: Ensure the 'Secure' attribute is set for cookies.
//    - **Severity**: Medium

// 10. **CWE-693: Protection Mechanism Failure**
//     - **Link**: [CWE-693](https://cwe.mitre.org/data/definitions/693.html)
//     - **Description**: A failure in protection mechanisms can lead to vulnerabilities.
//     - **Solution**: Regularly review and update security mechanisms.
//     - **Severity**: High

// ### Vulnerabilities

// 1. **Missing X-Frame-Options Header**
//    - **Link**: [X-Frame-Options](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options)
//    - **Description**: The absence of the X-Frame-Options header allows the site to be framed by other sites, potentially leading to clickjacking attacks.
//    - **Solution**: Implement the X-Frame-Options header to prevent framing.
//    - **Severity**: Medium

// 2. **Missing Strict-Transport-Security Header**
//    - **Link**: [Strict-Transport-Security](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security)
//    - **Description**: Without this header, the site may be vulnerable to man-in-the-middle attacks.
//    - **Solution**: Implement the Strict-Transport-Security header to enforce secure connections.
//    - **Severity**: High

// 3. **Missing X-Content-Type-Options Header**
//    - **Link**: [X-Content-Type-Options](https://www.netsparker.com/web-vulnerability-scanner/vulnerabilities/missing-content-type-header/)
//    - **Description**: The absence of this header could allow content sniffing attacks.
//    - **Solution**: Set the X-Content-Type-Options header to 'nosniff'.
//    - **Severity**: Medium

// 4. **Vulnerability to BREACH Attack**
//    - **Link**: [BREACH Attack](http://breachattack.com/)
//    - **Description**: The server's use of \"deflate\" encoding may make it vulnerable to the BREACH attack.
//    - **Solution**: Disable HTTP compression or use other mitigation techniques.
//    - **Severity**: High

// These extracted details provide a comprehensive overview of the vulnerabilities and weaknesses identified in the report, along with their potential impact and recommended solutions.
// PHP Warning:  Undefined variable \$cveList in /var/www/html/SecOps/simple_chat_ai/response.php on line 126
// PHP Warning:  foreach() argument must be of type array|object, null given in /var/www/html/SecOps/simple_chat_ai/response.php on line 126
// Patch download completed.
// ";
    
}

// Extract Links
function extractLinks($text) {
    preg_match_all('/- \*\*Link\*\*: \[(.*?)\]\((.*?)\)/', $text, $matches);
    return $matches[2]; // Returns only the URLs
}

// Extract Descriptions
function extractDescriptions($text) {
    preg_match_all('/\*\*Description\*\*: (.*?)\n/', $text, $matches);
    return $matches[1];
}

// Extract Severities
function extractSeverities($text) {
    preg_match_all('/\*\*Severity\*\*: (.*?)\n/', $text, $matches);
    return $matches[1];
}

function extractExploitability($text) {
    preg_match_all('/\*\*Exploitability\*\*: (.*?)\n/', $text, $matches);
    return $matches[1];
}
function extractAttackVectors($text) {
    preg_match_all('/\*\*Attack Vector\*\*: (.*?)\n/', $text, $matches);
    return $matches[1];
}

// Extract Solutions
function extractSolutions($text) {
    preg_match_all('/\*\*Solution\*\*: (.*?)\n/', $text, $matches);
    return $matches[1];
}

function extractVulnerabilities($text) {
    $results = [];

    

    // Extract CVEs
    preg_match_all('/CVE-\d{4}-\d{4,7}/i', $text, $matches);
    $results = array_merge($results, array_values(array_unique($matches[0])));

    // Extract CWEs
    preg_match_all('/CWE-\d{1,5}/i', $text, $matches);
    $results = array_merge($results, array_values(array_unique($matches[0])));
    // Extract Named Vulnerabilities (excluding CVE/CWE)
    preg_match_all('/\d{1,2}. \*\*(.*?)\*\*/', $text, $matches);
    for ($i = 0; $i < count($matches[1]); $i++) {
        $name = $matches[1][$i];
        if (!preg_match('/CVE|CWE/i', $name)) {
            $results[] = $name;
        }
    }

    return $results;
}


// Extract CVEs, severities, descriptions, and solutions from $output3
$Vulnerabilities = extractVulnerabilities($output3);
$links = extractLinks($output3);
$severities = extractSeverities($output3);
$exploitability = extractExploitability($output3);
$attackVectors = extractAttackVectors($output3);
$descriptions = extractDescriptions($output3);
$solutions = extractSolutions($output3);




    // // Debugging: Print variables
    // echo "<h2>Debugging Output</h2>";
    // echo "<h3>\$output3:</h3>";
    // echo "<pre>";
    // print_r($output3);
    // echo "</pre>";

    // echo "<h3>\$Vulnerabilities:</h3>";
    // echo "<pre>";
    // print_r($Vulnerabilities);
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



    /**************************************************************************store the ruselts */
// Connect to database
// if ($conn) {
//     // Insert CVEs, links, severities, descriptions, and solutions into database
//     foreach ($Vulnerabilities as $key => $cve) {
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
        
    /* -------- GLOBAL -------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: #f8f9fa;
      color: #212529;
      line-height: 1.6;
    }

    a {
      color: #0d6efd;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 1200px;
      margin: 50px auto;
      background: #ffffff;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 2.2em;
      color: #2c3e50;
    }

    p {
      text-align: center;
      margin-bottom: 20px;
      font-size: 16px;
    }

    /* -------- TABLE -------- */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      font-size: 15px;
    }

    thead {
      background-color: #e9ecef;
    }

    th, td {
      padding: 14px 12px;
      border: 1px solid #dee2e6;
      vertical-align: top;
    }

    th {
      text-align: left;
      color: #495057;
      font-weight: 600;
    }

    tr:hover {
      background-color: #f1f3f5;
    }

    /* -------- BADGES -------- */
    .badge {
      display: inline-block;
      padding: 5px 10px;
      font-size: 13px;
      font-weight: 500;
      border-radius: 20px;
      text-transform: capitalize;
    }

    .badge-high {
      background: #f8d7da;
      color: #c82333;
    }

    .badge-medium {
      background: #fff3cd;
      color: #856404;
    }

    .badge-low {
      background: #d4edda;
      color: #155724;
    }

    .badge-unknown {
      background: #e2e3e5;
      color: #6c757d;
    }

    /* -------- RESPONSIVE -------- */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      th {
        background: #f1f3f5;
        font-size: 14px;
        padding-top: 20px;
      }

      td {
        padding: 10px 15px;
        border: none;
        border-bottom: 1px solid #dee2e6;
        position: relative;
      }

      td:before {
        content: attr(data-label);
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: #6c757d;
      }
    }
  
    </style>
</head>
<body>
    <div class="container">
        <h1>Final Report</h1>
        <p>
      <a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
        <?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>
      </a>
    </p>

        <?php if (!empty($Vulnerabilities)): ?>
            <table>
    <thead>
        <tr>
            <th>Vulnerability</th>
            <th>Severity</th>
            <th>Description</th>
            <th>Solution</th>
            <th>Attack Vector</th>
            <th>Exploitability</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Vulnerabilities as $key => $value): ?>
            <tr>
                <td>
                    <a href="<?php echo isset($links[$key]) ? htmlspecialchars($links[$key]) : 'https://www.google.com'; ?>" target="_blank">
                        <?php echo htmlspecialchars($value); ?>
                    </a>
                </td>
                <td><?php echo isset($severities[$key]) ? htmlspecialchars($severities[$key]) : 'Unknown'; ?></td>
                <td><?php echo isset($descriptions[$key]) ? htmlspecialchars($descriptions[$key]) : 'No description available'; ?></td>
                <td><?php echo isset($solutions[$key]) ? htmlspecialchars($solutions[$key]) : 'No solution available'; ?></td>
                <td><?php echo isset($attackVectors[$key]) ? htmlspecialchars($attackVectors[$key]) : 'N/A'; ?></td>
                <td><?php echo isset($exploitability[$key]) ? htmlspecialchars($exploitability[$key]) : 'Unknown'; ?></td>
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


