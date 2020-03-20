<?php

// ยอดทั้งหมด world
$world_total_stat = curl_init();
curl_setopt_array($world_total_stat, array(
    CURLOPT_URL => "https://coronavirus-monitor.p.rapidapi.com/coronavirus/worldstat.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: coronavirus-monitor.p.rapidapi.com",
        "x-rapidapi-key: 454d9f41f2mshc3cb86558e06ca9p1c96e3jsnd17db90ea7ec"
    ),
));
$show3 = curl_exec($world_total_stat);
$err = curl_error($world_total_stat);
curl_close($world_total_stat);

echo json_encode($show3);

?>