
timeout  "$2" commix -u "$1" --crawl=2 --batch > commixReport.txt 

grep -v "links visited" commixReport.txt > commixReportModified.txt
