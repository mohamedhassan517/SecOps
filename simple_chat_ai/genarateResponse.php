<?php

require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

// Read the question from the text file
$questionFilePath = 'test.txt';

if (file_exists($questionFilePath)) {
    $prompt = file_get_contents($questionFilePath);
} else {
    die("The file $questionFilePath does not exist.");
}



$complete = $open_ai->completion([
    'model' => 'gpt-3.5-turbo',
    'prompt' => $prompt,
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

if ($complete != null) {
    $php_obj = json_decode($complete);
    $response = $php_obj->choices[0]->text;
    echo "Response:\n";
    echo $response;
} else {
    echo "No response from OpenAI.";
}

