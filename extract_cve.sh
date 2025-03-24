#!/bin/bash
compailed="simple_chat_ai/compailedReport.txt"
# Define input and output files
input_nmap="nmapReport.txt"
output_nmap="simple_chat_ai/nmapReport.txt"

# Extract CVE numbers and save to output file
grep -oP 'CVE-\d{4}-\d{4,}' "$input_nmap" | sort -u > "$output_nmap"
echo "CVE numbers have been extracted to $output_nmap"


# Define input and output files
input_zap="zapReport.txt"
output_zap="simple_chat_ai/zapReport.txt"

# Extract CWE numbers and save to output file
grep -oP '<cweid>\d{1,}' "$input_zap" | sort -u > "$output_zap"
echo "CWE numbers have been extracted to $output_zap"


#$output_fileCVWE = "simple_chat_ai/cvwe_numbers.txt"

output_nuclei="nucleiReport.txt"
output_nikto="niktoReport.txt"


input_wapiti="wapitiReport.txt"
output_wapiti="simple_chat_ai/wapitiReport.txt"
tail -n +41  "$input_wapiti" | head -n -10 > "$output_wapiti"

cat "$output_nmap" "$output_zap" "$output_nuclei" "$output_nikto" "$output_wapiti"> "$compailed"


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
