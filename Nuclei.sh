#!/bin/bash

url="$1"
echo "$url"
timeout  "$2" nuclei -u $url -o nucleiReport.txt
