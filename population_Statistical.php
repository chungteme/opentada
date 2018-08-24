<?php
ini_set("session.cookie_httponly", 1);
session_set_cookie_params('86400'); // 1 hour
session_start();
include_once("../config.php");
include_once("../lock.php");

$value_a = htmlspecialchars($login_RS["city"]);//會員所在城市
$value_b = htmlspecialchars($login_RS["area"]);//會員所在鄉鎮市區
$value_c = htmlspecialchars($login_RS["lining"]);//會員所在村里

$sql_people = $pdo->prepare("SELECT * FROM `people` WHERE `COUNTY`='$value_people_town' AND TOWN='$value_people_area' AND VILLAGE='$value_people_lining' LIMIT 1");//查詢資料庫村里人口數量資料
$sql_people->execute();
$people_list = $sql_people->fetchAll();
foreach ($people_list as $people_RS){}

?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
<meta charset="utf-8">
<title>人口數量</title>
</head>

<body>
<!-- 人口結構-->
   <div class="overlay"></div>

    <div id="modal1" class="modal">
      <?php if($people_list){
		  $stat_people_=htmlspecialchars($people_RS["P_CNT"]);
		  $stat_H_CNT=htmlspecialchars($people_RS["H_CNT"]);
		  
		  $COUNTY_ID = htmlspecialchars($people_RS["COUNTY_ID"]);
		  $TOWN_ID = htmlspecialchars($people_RS["TOWN_ID"]);
		  $V_ID = htmlspecialchars($people_RS["V_ID"]);
		  
		  $sql_year_4 = $pdo->prepare("SELECT A0A4_CNT,A5A9_CNT,A10A14_CNT,A15A19_CNT,A20A24_CNT,A25A29_CNT,A30A34_CNT,A35A39_CNT,A40A44_CNT,A45A49_CNT,A50A54_CNT,A55A59_CNT,A60A64_CNT,A65A69_CNT,A70A74_CNT,A75A79_CNT,A80A84_CNT,A85A89_CNT,A90A94_CNT,A95A99_CNT,A100UP_5_CNT FROM `people_year` WHERE `COUNTY_ID`='$COUNTY_ID' and `TOWN_ID`='$TOWN_ID' and `V_ID`='$V_ID'");//查詢資料庫村里人口結構資料
$sql_year_4->execute();
$year_4list = $sql_year_4->fetchAll();
foreach ($year_4list as $yearRS){}
		$year_all =  htmlspecialchars($yearRS["A0A4_CNT"])+htmlspecialchars($yearRS["A5A9_CNT"])+htmlspecialchars($yearRS["A10A14_CNT"])+htmlspecialchars($yearRS["A15A19_CNT"])+htmlspecialchars($yearRS["A20A24_CNT"])+htmlspecialchars($yearRS["A25A29_CNT"])+htmlspecialchars($yearRS["A30A34_CNT"])+htmlspecialchars($yearRS["A35A39_CNT"])+htmlspecialchars($yearRS["A40A44_CNT"])+htmlspecialchars($yearRS["A45A49_CNT"])+htmlspecialchars($yearRS["A50A54_CNT"])+htmlspecialchars($yearRS["A55A59_CNT"])+htmlspecialchars($yearRS["A60A64_CNT"])+htmlspecialchars($yearRS["A65A69_CNT"])+htmlspecialchars($yearRS["A70A74_CNT"])+htmlspecialchars($yearRS["A75A79_CNT"])+htmlspecialchars($yearRS["A80A84_CNT"])+htmlspecialchars($yearRS["A85A89_CNT"])+htmlspecialchars($yearRS["A90A94_CNT"])+htmlspecialchars($yearRS["A95A99_CNT"])+htmlspecialchars($yearRS["A100UP_5_CNT"]);
		
		$year_60 =  htmlspecialchars($yearRS["A60A64_CNT"])+htmlspecialchars($yearRS["A65A69_CNT"])+htmlspecialchars($yearRS["A70A74_CNT"])+htmlspecialchars($yearRS["A75A79_CNT"])+htmlspecialchars($yearRS["A80A84_CNT"])+htmlspecialchars($yearRS["A85A89_CNT"])+htmlspecialchars($yearRS["A90A94_CNT"])+htmlspecialchars($yearRS["A95A99_CNT"])+htmlspecialchars($yearRS["A100UP_5_CNT"]);
		  ?>
      
        <p class="closeBtn"><i class="fa fa-times-circle fa-2x"></i></p>
          <h2 style="font-size:90%; padding-bottom:6px; border-bottom:1px solid #efefef;"><?php echo htmlspecialchars($people_RS["VILLAGE"]);?> 人口統計(<?php echo substr(htmlspecialchars($people_RS["INFO_TIME"]), 0, 3);?>年度)</h2>
        <h2><img src="images/peo.png" alt="" width="100%"/></h2>
        
        
        <div class="skillbar clearfix " data-percent="<?php echo round((htmlspecialchars($people_RS["H_CNT"])/$stat_H_CNT)*100)?>%">
	<div class="skillbar-title linechart_css1"><span>戶數</span></div>
	<div class="skillbar-bar" style="background: #5a68a5;"></div>
	<div class="skill-bar-percent"><?php echo htmlspecialchars($people_RS["H_CNT"]);?></div>
</div> <!-- End Skill Bar -->
        
        
        <div class="skillbar clearfix " data-percent="<?php echo round((htmlspecialchars($people_RS["P_CNT"])/$stat_people_)*100)?>%">
	<div class="skillbar-title linechart_css2"><span>總人口</span></div>
	<div class="skillbar-bar" style="background: #e67e22;"></div>
	<div class="skill-bar-percent"><?php echo htmlspecialchars($people_RS["P_CNT"]);?></div>
</div> <!-- End Skill Bar -->

<div class="skillbar clearfix " data-percent="<?php echo round((htmlspecialchars($people_RS["M_CNT"])/$stat_people_)*100)?>%">
	<div class="skillbar-title linechart_css3"><span>男</span></div>
	<div class="skillbar-bar" style="background: #3498db;"></div>
	<div class="skill-bar-percent"><?php echo htmlspecialchars($people_RS["M_CNT"]);?>(<?php echo round((htmlspecialchars($people_RS["M_CNT"])/$stat_people_)*100)."%"?>)</div>
</div> <!-- End Skill Bar -->

<div class="skillbar clearfix " data-percent="<?php echo round((htmlspecialchars($people_RS["F_CNT"])/$stat_people_)*100)?>%">
	<div class="skillbar-title linechart_css4"><span>女</span></div>
	<div class="skillbar-bar" style="background: #ff9ccb;"></div>
	<div class="skill-bar-percent"><?php echo htmlspecialchars($people_RS["F_CNT"]);?>(<?php echo round((htmlspecialchars($people_RS["F_CNT"])/$stat_people_)*100)."%"?>)</div>
</div> <!-- End Skill Bar -->

<div class="skillbar clearfix " data-percent="<?php echo round((htmlspecialchars($year_60)/$year_all)*100)?>%">
	<div class="skillbar-title linechart_css5"><span>60以上</span></div>
	<div class="skillbar-bar" style="background: #ae9871;"></div>
	<div class="skill-bar-percent"><?php echo $year_60?>(<?php echo round((htmlspecialchars($year_60)/$year_all)*100)."%"?>)</div>
</div> <!-- End Skill Bar -->

<div class="skillbar clearfix " data-percent="<?php echo round((htmlspecialchars($yearRS["A0A4_CNT"])/$year_all)*100)?>%">
	<div class="skillbar-title linechart_css6"><span>4歲以下</span></div>
	<div class="skillbar-bar" style="background: #4288d0;"></div>
	<div class="skill-bar-percent"><?php echo htmlspecialchars($yearRS["A0A4_CNT"])?>(<?php echo round((htmlspecialchars($yearRS["A0A4_CNT"])/$year_all)*100)."%"?>)</div>
</div>  <!--End Skill Bar -->
<?php }?>
    </div>
<!-- 人口結構-->
</body>
</html>