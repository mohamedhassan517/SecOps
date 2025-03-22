<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Path to the question file
$Report_FilePath = 'test2.txt';

// Check if the file exists
if (!file_exists($Report_FilePath)) {
    die("The file $Report_FilePath does not exist.");
}

// Read the question from the text file
$prompt = file_get_contents($Report_FilePath);

// Check if the file content is empty
if (empty($prompt)) {
    die("The file $Report_FilePath is empty.");
}

// Append the new prompt regarding CVE links to the existing prompt
$additionalPrompt = "\n\nI want to get link patch for all CVEs from NVD link, MITRE link, and CVE.org link.";
$prompt .= $additionalPrompt;


$client = new Client([
    'base_uri' => 'https://api.openai.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ],
    'verify' => __DIR__ . '/cacert.pem',  // Path to the CA bundle
]);

try {
    $response = $client->post('/v1/chat/completions', [
        'json' => [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.9,
            'max_tokens' => 1500,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ],
    ]);

    $responseBody = $response->getBody()->getContents();

    // Log the raw response for debugging
    //echo "Raw response from OpenAI:\n";
    //var_dump($responseBody);

    // Check if the response is null or empty
    if (empty($responseBody)) {
        die("No response from OpenAI.");
    }

    // Decode the JSON response
    $php_obj = json_decode($responseBody);

    // Check if the JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Error decoding JSON response: " . json_last_error_msg());
    }

    // Ensure we have a valid response
    if (!isset($php_obj->choices) || !isset($php_obj->choices[0]) || !isset($php_obj->choices[0]->message) || !isset($php_obj->choices[0]->message->content)) {
        die("Invalid response structure from OpenAI.");
    }

    // Extract and print the response
    $responseText = $php_obj->choices[0]->message->content;
    echo "Response:\n";
    echo $responseText;

} catch (RequestException $e) {
    // Log detailed error information
    if ($e->hasResponse()) {
        $errorResponse = $e->getResponse();
        $statusCode = $errorResponse->getStatusCode();
        $errorBody = $errorResponse->getBody()->getContents();
        die("HTTP Status Code: $statusCode\nError Response: $errorBody");
    } else {
        die("Request failed: " . $e->getMessage());
    }
}
