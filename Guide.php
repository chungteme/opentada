<?php
ini_set("session.cookie_httponly", 1);
session_set_cookie_params('86400'); // 1 hour
session_start();
include_once("../config.php");
$value_a = htmlspecialchars($login_RS["city"]);//會員所在城市
$value_b = htmlspecialchars($login_RS["area"]);//會員所在鄉鎮市區
$value_c = htmlspecialchars($login_RS["lining"]);//會員所在村里

$sql_historic_buildings_list = $pdo->prepare("SELECT * FROM `historic_buildings` WHERE (`city`='$value_a' AND `address` LIKE '%$value_b%')");//查詢所在鄉鎮市區古蹟資訊
$sql_historic_buildings_list->execute();
$historic_buildings_list = $sql_historic_buildings_list->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>社區導覽</title>
</head>

<body>
<section class="section" id="map_c">
<div class="historic">
<?php if($historic_buildings_list){
	foreach ($historic_buildings_list as $historic_buildings_RS){	
	?>    
    <div class="historic_div">
    <h5><span class="buildings_type"><?php echo htmlspecialchars($historic_buildings_RS["buildings_type"])?></span> <?php echo htmlspecialchars($historic_buildings_RS["name"])?></h5>
    <p><?php echo "地址:".htmlspecialchars($historic_buildings_RS["address"])?></p>
    <p><?php echo "開放時間:".htmlspecialchars($historic_buildings_RS["open_time"])?></p>
    <p><?php echo "建立於:".htmlspecialchars($historic_buildings_RS["create_year"])?></p>
    </div>
    <?php }}?>
    </div>
>
</section>
</body>
</html>