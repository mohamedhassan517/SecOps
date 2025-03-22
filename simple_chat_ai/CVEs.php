
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Function to scrape CVE details from a website
function scrapeCveDetails($cveId)
{
    $client = new Client([
        'verify' => __DIR__ . '/cacert.pem',  // Path to the CA bundle
    ]);
    $url = "https://services.nvd.nist.gov/rest/json/cve/1.0/$cveId";  // Replace with the actual URL

    try {
        $response = $client->request('GET', $url);
        $html = $response->getBody()->getContents();

        // Parse the HTML to extract CVE details
        $dom = new DOMDocument();
        @$dom->loadHTML($html);  // Suppress warnings from invalid HTML

        // Use XPath to find specific elements
        $xpath = new DOMXPath($dom);
        $details = $xpath->query("//div[@class='cve-details']");  // Update the XPath query based on actual HTML structure

        $cveDetails = [];
        foreach ($details as $detail) {
            $cveDetails[] = trim($detail->nodeValue);
        }

        return $cveDetails;

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
}

// Example usage: Scrape details for a specific CVE
$cveId = 'CVE-2021-34527';  // Replace with the CVE ID you are interested in
$cveDetails = scrapeCveDetails($cveId);

echo "CVE Details:\n";
print_r($cveDetails);

?>
