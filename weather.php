<?php
$tomorrow_day = date("Y-m-d",mktime(0,0,0,$mm,$dd+1,$yyyy));

if(htmlspecialchars($login_RS["city"])=="宜蘭縣"){
$localsite = "F-D0047-001";//- 宜蘭縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="桃園市"){
$localsite = "F-D0047-005";//- 桃園市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="新竹縣"){
$localsite = "F-D0047-009";//- 新竹縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="苗栗縣"){
$localsite = "F-D0047-013";//- 苗栗縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="彰化縣"){
$localsite = "F-D0047-017";//- 彰化縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="南投縣"){
$localsite = "F-D0047-021";//- 南投縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="雲林縣"){
$localsite = "F-D0047-025";//- 雲林縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="嘉義縣"){
$localsite = "F-D0047-029";//- 嘉義縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="屏東縣"){
$localsite = "F-D0047-033";//- 屏東縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="臺東縣"){
$localsite = "F-D0047-037";//- 臺東縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="花蓮縣"){
$localsite = "F-D0047-041";//- 花蓮縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="澎湖縣"){
$localsite = "F-D0047-045";//- 澎湖縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="基隆市"){
$localsite = "F-D0047-049";//- 基隆市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="新竹市"){
$localsite = "F-D0047-053";//- 新竹市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="嘉義市"){
$localsite = "F-D0047-057";//- 嘉義市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="臺北市"){
$localsite = "F-D0047-061";//- 臺北市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="高雄市"){
$localsite = "F-D0047-065";//- 高雄市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="新北市"){
$localsite = "F-D0047-069";//- 新北市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="臺中市"){
$localsite = "F-D0047-073";//- 臺中市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="臺南市"){
$localsite = "F-D0047-077";//- 臺南市未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="連江縣"){
$localsite = "F-D0047-081";//- 連江縣未來2天天氣預報
}else if(htmlspecialchars($login_RS["city"])=="金門縣"){
$localsite = "F-D0047-085";//- 金門縣未來2天天氣預報
}else{
	$localsite = "F-D0047-061";//預設台北市
	}
if(htmlspecialchars($login_RS["area"])!=""){
$locationName = htmlspecialchars($login_RS["area"]);
}else{
$locationName = "南港區";	
	}
$url="https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-093?locationId=".$localsite."&locationName=".$locationName."&elementName=T&elementName=Wx&dataTime=".$tomorrow_day."T00:00:00&format=json&Authorization=申請的氣象局權狀";//&Authorization=申請的氣象局權狀
$ch=curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$dat=curl_exec($ch);
curl_close($ch);
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
<meta charset="utf-8">
<title>村里未來2天天氣預報</title>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
// 未來2天氣象 opendata
$(document).ready(function(){
		var jsonData=JSON.parse('<?php echo $dat;?>'); //把抓到的資料給js的變數
		console.log(jsonData); //可以看到該變數有資料了
		var weater_show = jsonData.records.locations[0].location[0].weatherElement[0].time[0].elementValue[0].value;
		var locationName = jsonData.records.locations[0].location[0].locationName;
		var measures = jsonData.records.locations[0].location[0].weatherElement[1].time[0].elementValue[0].measures;
		var measures_value = jsonData.records.locations[0].location[0].weatherElement[1].time[0].elementValue[0].value;
		
		document.getElementById("wentherlist").innerHTML = locationName + "未來2天 "+ weater_show +" 氣溫" + measures_value + ' °C';

	});	
</script>
</head>

<body>
<p id="list"></p>
</body>
</html>