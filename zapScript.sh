
{
  timeout  "$2" /usr/share/zaproxy/zap.sh -cmd -quickurl "$1"
} > zapReport.txt
