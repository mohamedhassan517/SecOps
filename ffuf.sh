#!/bin/bash

url="$1"
echo "$url"
ffuf -w /usr/share/wordlists/dirb/small.txt -u $url/FUZZ -o ffuf.txt


