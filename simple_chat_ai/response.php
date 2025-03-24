<?php

require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Define the file path for the report and the list of CVEs
$reportFilePath = 'compailedReport.txt';
$downloadDir = 'patches';

// Check if the report file exists
if (!file_exists($reportFilePath)) {
    die("The file $reportFilePath does not exist.");
}

// Read the report content
$reportContent = file_get_contents($reportFilePath);
if (empty($reportContent)) {
    die("The file $reportFilePath is empty.");
}

// Initialize Guzzle client for OpenAI API
$client = new Client([
    'base_uri' => 'https://api.openai.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ],
    'verify' => __DIR__ . '/cacert.pem', // Update this path to where you saved cacert.pem
]);

try {
    $response = $client->post('/v1/chat/completions', [
        'json' => [
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => 'This is a report that contains CVEs, CWEs and vulnerability info for websites. Extract each CVE, CWE and vulnerability with its number, get links for each CVE and CWE, description and solution for each CVE and CWE and vulnerability, and the degree of severity of the vulnerability (Critical, High, Medium, or Low) for each CVE and CWE and vulnerability.'],
                ['role' => 'user', 'content' => $reportContent]
            ],
            'temperature' => 0.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ],
    ]);
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
    $responseBody = $response->getBody()->getContents();
    $responseObj = json_decode($responseBody);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Error decoding JSON response: " . json_last_error_msg());
    }

    $responseText = $responseObj->choices[0]->message->content;
    echo "Response from ChatGPT:\n$responseText\n";

    // Function to search for CVE details on various websites
    function search_site($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    // Function to extract patch URLs from the website content
    function extract_patch_urls($html_content) {
        $patch_urls = [];
        $dom = new DOMDocument();
        @$dom->loadHTML($html_content); // Use @ to suppress warnings from malformed HTML
        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//a[@href]');
        
        foreach ($nodes as $node) {
            $url = $node->getAttribute('href');
            if (is_patch_link($url)) {
                $patch_urls[] = $url;
            }
        }
        return $patch_urls;
    }

    // Function to check if a URL likely points to a patch file
    function is_patch_link($url) {
        $patch_extensions = ['.patch', '.zip', '.tar.gz', '.tgz', '.tar.bz2', '.exe', '.msi', '.sh', '.bin'];
        foreach ($patch_extensions as $ext) {
            if (stripos($url, $ext) !== false) {
                return true;
            }
        }
        return false;
    }

    // Function to download the patch from the URL
    function download_patch($url, $download_dir = 'patches') {
        if (!is_dir($download_dir)) {
            mkdir($download_dir, 0777, true);
        }
        $file_name = basename(parse_url($url, PHP_URL_PATH));
        $local_file = "$download_dir/$file_name";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);

        if ($data) {
            file_put_contents($local_file, $data);
            echo "Downloaded patch: $local_file\n";
        } else {
            echo "Failed to download patch from: $url\n";
        }
    }

    // List of websites to search for patches
    $websites = [
        'https://nvd.nist.gov/vuln/detail/',
        'https://www.oracle.com/security-alerts/',
    ];

    // Search for patches for each CVE and download them
    foreach ($cveList as $cve_id) {
        echo "Searching for patches for $cve_id...\n";

        foreach ($websites as $base_url) {
            $search_url = $base_url . $cve_id;
            $html_content = search_site($search_url);
            if ($html_content) {
                $patch_urls = extract_patch_urls($html_content);
                foreach ($patch_urls as $patch_url) {
                    download_patch($patch_url, $downloadDir);
                }
            } else {
                echo "No information found for $cve_id on $base_url.\n";
            }
        }
    }

    echo "Patch download completed.\n";

} catch (RequestException $e) {
    if ($e->hasResponse()) {
        $errorResponse = $e->getResponse();
        $statusCode = $errorResponse->getStatusCode();
        $errorBody = $errorResponse->getBody()->getContents();
        die("HTTP Status Code: $statusCode\nError Response: $errorBody");
    } else {
        die("Request failed: " . $e->getMessage());
    }
}
