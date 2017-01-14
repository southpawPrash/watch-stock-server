<?php
#DB Connection
$host 		= 'localhost';
$db 		= 'watchstock';
$db_user 	= 'root';
$db_pass 	= '1ihiw2itb';
$mysql 		= new mysqli($host, $db_user, $db_pass, $db) or die("Could not connect to database.");

#Error Reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(0);

#URL used to scrap data
define("SCRAPE_URL", "http://www.moneycontrol.com/stocks/marketinfo/totassets/nse/index.html");

#Minimum upmove(in percent) a stock must make to be reported in the daily report.
define("DAILY_REPORT_UPMOVE_PERCENT", '5');

