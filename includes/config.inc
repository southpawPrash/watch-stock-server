<?php
#DB Connection
$host 		= '127.0.0.1';
$db 		= 'watchstock';
$db_user 	= 'root';
$db_pass 	= '1ih1w2itb';
$mysql 		= new mysqli($host, $db_user, $db_pass, $db) or die("Could not connect to database.");

#Error Reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(0);

#URL used to scrap data
define("SCRAP_URL", "http://www.moneycontrol.com/stocks/marketinfo/totassets/bse/computers-software.html");

#Minimum upmove(in percent) a stock must make to be reported in the daily report.
define("DAILY_REPORT_UPMOVE_PERCENT", '5');

define("SLEEP", 5);