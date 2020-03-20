<?php 
$cases_by_country = curl_init();
curl_setopt_array($cases_by_country, array(
    CURLOPT_URL => "https://coronavirus-monitor.p.rapidapi.com/coronavirus/cases_by_country.php",
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
$show2 = curl_exec($cases_by_country);
$err = curl_error($cases_by_country);
curl_close($cases_by_country);

echo json_encode($show2);
?>