<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-php-Ajax</title>

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <!-- End Bulma -->

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- End J -->

    <!-- Jquery Chart -->
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <!-- End J -->


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
                            <p class="title" id="total_cases"></p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">รักษาหายแล้ว</p>
                            <p class="title" id="total_recovered"></p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">จำนวนผู้เสียชีวิต</p>
                            <p class="title" id="total_deaths"></p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>


    <!-- รอพัฒนาในอนาคต -->
    <div class="columns">
        <div class="column">

        </div>
        <div class="column">
        </div>
    </div>


    <!-- Your table content -->
    <?php

    ?>

    <div class="container">
        <div class="table-container ">
            <table class="table is-striped" id="Table1">
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
                </tbody>
            </table>
        </div>
    </div>
    <!-- credit kraivit mongkhonsakunrit -->
    <!-- ใช้เพื่อการแบ่งปัน ให้กับผู้ที่ต้องการศึกษา -->
</body>

</html>


<script type="text/javascript">
    $(function() {

        // ดึงข้อมูลจาก Showtotale

        function getShow() {
            // เรียกใช้งาน ajax มาทำงาน
            $.ajax({
                    url: "Showtotal.php",
                    type: "post",
                    data: ''
                })
                .success(function(Show1) {
                    const obj1 = jQuery.parseJSON(Show1);
                    // console.log(obj);
                    const array = JSON.parse(obj1);
                    console.log(array["total_recovered"]);
                    console.log(array["total_cases"]);
                    console.log(array["total_deaths"]);
                    // ใช้ jquery แสดงข้อความแล้วใช้ setInterval ทำกระบวนการ Realtime 
                    jQuery("#total_cases").text(array["total_cases"]);
                    jQuery("#total_recovered").text(array["total_recovered"]);
                    jQuery("#total_deaths").text(array["total_deaths"]);

                });
        }

        function getShowtable() {
            // เรียกใช้งาน ajax มาทำงาน
            $.ajax({
                    url: "Showtable.php",
                    type: "post",
                    data: ''
                })
                .success(function(Show2) {
                    //ทำการแปลงด้วย jQuery ถ้าเรียกง่าย ๆ ก็จัดรูป json 
                    const obj2 = jQuery.parseJSON(Show2);
                    const array2 = JSON.parse(obj2);
                    var rows = '';
                    const counts = array2.countries_stat.length;
                    var i = 0;
                    var j = counts;

                    // ใช้ loop while ที่สร้างตัวแปรเยอะเพราะอยากให้ พีๆ น้องๆ มือใหม่มองว่าตอนนี้ผมทำการเรียกใช้ document.getElementById ของตาราง Table1
                    // ไม่สามารถใช้ setInterval เนื่องจากว่า innertHTML แทรก HTML Tag ลงในตำแหน่งที่ต้องการนั้นก็คือ col ของแต่ละ row 
                    while (i < counts) {
                        // ใช้ j ทำการเรียงลำดับ สลับมากไปน้อย สำหรับมือใหม่ ลองนำไปปรับกับงานแล้ว จับเวลาในการแก้โค้ดของผมนะครับ 1-4 ซม. 
                        j--;
                        var table = document.getElementById("Table1");
                        var row = table.insertRow(1);
                        var col1 = row.insertCell(0);
                        var col2 = row.insertCell(1);
                        var col3 = row.insertCell(2);
                        var col4 = row.insertCell(3);
                        var col5 = row.insertCell(4);
                        var col6 = row.insertCell(5);
                        var col7 = row.insertCell(6);
                        col1.innerHTML = array2.countries_stat[j].country_name;
                        col2.innerHTML = array2.countries_stat[j].cases;
                        col3.innerHTML = array2.countries_stat[j].deaths;
                        col4.innerHTML = array2.countries_stat[j].total_recovered;
                        col5.innerHTML = array2.countries_stat[j].new_deaths;
                        col6.innerHTML = array2.countries_stat[j].new_cases;
                        col7.innerHTML = array2.countries_stat[j].serious_critical;
                        i++;
                    }
                    // console json แบบข้อความ
                    console.log(Show2);
                    // console json แบบ array
                    console.log(obj2);
                    // console json แบบ object
                    console.log(array2);
                });
        }
        setTimeout(getShow, 1);
        setInterval(getShow, 10000);
        // setTimeout(getShow,1000);
        // setInterval(getShowtable, 10);
        setTimeout(getShowtable, 1);

        // setTimeout จะทำงานหลังจากเวลาที่กำหนดเพียง 1 ครั้ง
        // setInterval จะทำงานหลังจากเวลาที่กำหนดเรื่อย ๆ ทุก ๆ ครั้ง

    });
</script>