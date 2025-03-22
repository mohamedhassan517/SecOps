#!/bin/bash

# Define input and output files
input_fileCVE="allreportCVE.txt"
output_fileCVE="simple_chat_ai/cve_numbers.txt"

# Extract CVE numbers and save to output file
grep -oP 'CVE-\d{4}-\d{4,}' "$input_fileCVE" | sort -u > "$output_fileCVE"
cd simple_chat_ai
head -n 10 cve_numbers.txt > cve_numbers1.txt
echo "CVE numbers have been extracted to $output_fileCVE"

cd ..
# Define input and output files
input_fileCWE="allreportCWE.txt"
output_fileCWE="simple_chat_ai/cwe_numbers.txt"

# Extract CWE numbers and save to output file
grep -oP '<cweid>\d{1,}' "$input_fileCWE" | sort -u > "$output_fileCWE"
cd simple_chat_ai
head -n 10 cwe_numbers.txt > cwe_numbers1.txt
echo "CWE numbers have been extracted to $output_fileCWE"

cd ..

#$output_fileCVWE = "simple_chat_ai/cvwe_numbers.txt"

cat "$output_fileCVE" "$output_fileCWE" > "$output_fileCVE"


# <cweid>548</cweid>
# // Initialize Guzzle client for OpenAI API
# $client = new Client([
#     'base_uri' => 'https://api.openai.com',
#     'headers' => [
#         'Authorization' => 'Bearer ' . $apiKey,
#         'Content-Type' => 'application/json',
#     ],
#     'verify' => __DIR__ . '/cacert.pem', // Update this path to where you saved cacert.pem
# ]);

# try {
#     $response = $client->post('/v1/chat/completions', [
#         'json' => [
#             'model' => 'gpt-3.5-turbo',
#             'messages' => [
#                 ['role' => 'system', 'content' => 'You are a helpful assistant.'],
#                 ['role' => 'user', 'content' => 'Extract all security vulnerabilities mentioned in the file and provide their corresponding CWE numbers. List each vulnerability along with its CWE ID and a brief description.'],
#                 ['role' => 'user', 'content' => $input_fileCWE]
#             ],
#             'temperature' => 0.0,
#             'max_tokens' => 4000,
#             'frequency_penalty' => 0,
#             'presence_penalty' => 0.6,
#         ],
#     ]);
