<?php
// https://rapidapi.com/astsiatsko/api/coronavirus-monitor
// เข้าไปสมัครแล้วนำ API-Host มาแปะไว้ในส่วนของ "x-rapidapi-host: ใส่ตรงนี้  ",
// เข้าไปสมัครแล้วนำ API-Host มาแปะไว้ในส่วนของ "x-rapidapi-key: ใส่ตรงนี้  ",



// Refresh ทุก 30 วินาที
header("Refresh:30");

// ผู้ติดเชื้อแต่ละประเทศ
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

// print($show2);

// ทำการแปลง json to array 
$respArray2 = json_decode($show2, true);
// print_r($respArray2);

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

// print_r($show3);

// ทำการแปลง json to array 
$respArray3 = json_decode($show3, true);
// print_r($respArray3);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-php</title>

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <!-- End Bulma -->

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
</head>

<body>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title has-text-centered">
                    The World Covid Credit: kraivit-mongkhonsakunrit
                </h1>
                <nav class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">ผู้ติดเชื้อ</p>
                            <p class="title"><?php
                                                echo $respArray3["total_cases"];
                                                ?></p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">รักษาหายแล้ว</p>
                            <p class="title"><?php
                                                echo $respArray3["total_recovered"];
                                                ?></p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">จำนวนผู้เสียชีวิต</p>
                            <p class="title"><?php
                                                echo $respArray3["total_deaths"];
                                                ?></p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>


    <!-- Your table content -->
    <?php
    // นับจำนวน array มีเท่าไรตอนนี้
    $count = count($respArray2['countries_stat']);
    // เอาไว้แสดงผล จะใช้ count or sizeof ก็ได้เช่นกันครับ
    // echo sizeof($respArray2['countries_stat']);

    // กรณี้เอาไว้ทดสอบว่าใช้ได้หรือเปล่า
    // print_r($respArray2['countries_stat']['0']);
    ?>

    <div class="container">
        <div class="table-container ">
            <table class="table is-striped">
                <thead>
                    <tr>
                        <th>ชื่อประเทศ</th>
                        <th>จำนวนผู้ติดเชื้อ</th>
                        <th>จำนวนผู้เสียชีวิต</th>
                        <th>จำนวนผู้รักษาหาย</th>
                        <th>จำนวนผู้เสียชีวิต ล่าสุด</th>
                        <th>จำนวนผู้ติดเชื้อ ล่าสุด</th>
                        <th>จำนวนผู้ติดเชื้อ มีอาการร้ายแรง</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //ให้ทำการแสดงผลตามข้อมูลจาก array
                    $i = 0;
                    while ($i < $count) {
                        echo '
                                <tr>
                                <td>' . ($respArray2['countries_stat'][$i]['country_name']) . '</td>
                                <td>' . ($respArray2['countries_stat'][$i]['cases']) . '</td>
                                <td>' . ($respArray2['countries_stat'][$i]['deaths']) . '</td>
                                <td>' . ($respArray2['countries_stat'][$i]['total_recovered']) . '</td>
                                <td>' . ($respArray2['countries_stat'][$i]['new_deaths']) . '</td>
                                <td>' . ($respArray2['countries_stat'][$i]['new_cases']) . '</td>
                                <td>' . ($respArray2['countries_stat'][$i]['serious_critical']) . '</td>
                                </tr>
                                ';
                        $i++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

<!-- credit kraivit mongkhonsakunrit -->
<!-- ใช้เพื่อการแบ่งปัน ให้กับผู้ที่ต้องการศึกษา -->
</body>

</html>


<script>
    // เอาไว้ตรวจสอบค่า object ขึ้น console
    $(function() {
        console.log(<?php echo $show2 ?>)
        console.log(<?php echo $show3 ?>)
    });
</script>