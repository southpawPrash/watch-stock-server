<?php
require_once('includes/config.inc');
require_once('includes/cors.inc');

$currentDate 	= date('Y-m-d 00:00:00');

$query 			= "	SELECT * 
					FROM ws_data 
					WHERE 	(percent_change > '". DAILY_REPORT_UPMOVE_PERCENT. "') 
							AND created > '{$currentDate}'
					ORDER BY percent_change DESC";
$result 		= $mysql->query($query);

if (!empty($result)) {
	$count 	= 0;
	$data 	= array();
	
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}
	
	echo json_encode($data);
}