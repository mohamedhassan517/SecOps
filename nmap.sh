remove_https() {
    local url=$1
    echo "${url#https://}"
}

url="$1"
output_url=$(remove_https "$url")
nmap -sV --script vulners -oN nmapReport.txt $output_url 
