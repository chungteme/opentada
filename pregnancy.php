<?php
ini_set("session.cookie_httponly", 1);
session_set_cookie_params('86400'); // 1 hour
session_start();
include_once("../config.php");
$sql_pregnant = $pdo->prepare("SELECT * FROM `pregnant`");//查詢 臺北市好孕胸章索取地點及電話一覽表
$sql_pregnant->execute();
$list_pregnant = $sql_pregnant->fetchAll();

?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
<meta charset="utf-8">
<title>臺北市好孕胸章索取地點及電話一覽表</title>
</head>

<body>
<div class="mediabox">
<h3>好孕胸章索取地點</h3>
<?php
if($list_pregnant){
	foreach ($list_pregnant as $pregnantRS){
	?>
<p class="p_5_title"><?php echo htmlspecialchars($pregnantRS["name"]);?></p>
<p class="p_5_address">地址:<a href="https://www.google.com.tw/maps/place/<?php echo htmlspecialchars($pregnantRS["address"]);?>" target="new"><?php echo htmlspecialchars($pregnantRS["address"]);?></a></p>
<p class="p_5_phone">電話:<?php echo htmlspecialchars($pregnantRS["telephone"]);?></p>
<?php }}?>
</div>
</body>
</html>