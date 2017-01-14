<?php
require_once('includes/config.inc');
require_once('includes/cors.inc');
require_once('library/simple_html_dom.php');

// create HTML DOM
$html           = file_get_html(SCRAP_URL);
$sectorCounter  = 0;

foreach ($html->find(".lftmenu a") as $sector) {
    $sectorCounter++;
    if ($sectorCounter == 1) {
        continue;
    }
    
    $url        = "http://www.moneycontrol.com/". $sector->href;
    $sectorName = html_entity_decode($sector->plaintext);
    
    scrapeSector($url, $sectorName);
    
    $sectorCounter++;
}

function scrapeSector($url, $sectorName) {
    global $mysql;

    $sectorHtml = file_get_html($url);
    $rowCount 	= 0;
    
    foreach ($sectorHtml->find('table.tbldata14 tr') as $row) {

        $rowCount++;

        //Avoid Table Headers
        if ($rowCount == 1) { 
                continue;
        }

        $companyName 	= trim(str_replace(array("Add to Watchlist", "Add to Portfolio","\r\n", "\r", "\n", "\t"), "", $row->find('td', 0)->plaintext));
        $price          = str_replace(",", "", trim($row->find('td', 1)->plaintext));

        if (!empty($companyName) && !empty($price)) {
                $insertQuery = "INSERT INTO stockquotes (company_name, sector_name, price) VALUES ('{$companyName}', '{$sectorName}', '{$price}')";
                $mysql->query($insertQuery) or die($mysql->error);
        }
    }    
    
    // clean up memory
    $sectorHtml->clear();
    unset($sectorHtml);
}

// clean up memory
$html->clear();
unset($html);

echo "Done";