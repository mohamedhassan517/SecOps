#!/bin/bash

url="$1"
echo "$url"
nuclei -u $url -o allreports.txt
