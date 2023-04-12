<html>
<head>
    <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css">

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
    <meta charset="utf-8" />
<link rel="stylesheet" href="./style.css">
    <title></title>
</head>
<body>
    <aside class="board d-flex flex-column">
    <div class="board-head pb-3">
      <div class="px-3 pt-3 mb-2 d-flex justify-content-between">
        <h1 class="mb-0 h3 font-weight-bold">YouBike數量預測地圖</h1>
		<input type="button" value="YouBike2.0實時地圖" name="按鈕名稱" onclick="self.location.href='http://localhost/youbike/youbike/youbike.php'"/>
        <div id="close-board-btn" class="d-block d-sm-none"><i class="fas fa-caret-right"></i></div>
      </div>
    <form method="post" action="phpinfo.php">
    <div id="date" class="px-3 mb-2"></div>
      <div class="form-row px-3">
        <div class="form-group col-6">
          <select name="city"  class="custom-select custom-select-sm">
            <option value= "0" selected disabled>請選擇縣市</option>
            <option value= "1"> 台北市</option>
            <option value= "2"> 台中市</option>
            <option value= "3"> 嘉義市</option>
            <option value= "4"> 高雄市</option>      
         </select>
       </div>
        <div class="form-group col-6">
          <select name="date" id="datelist" class="custom-select custom-select-sm">
            <option value="" selected disabled>請選擇日期</option>
            <option value= "1"> 5/1 </option>
            <option value= "2"> 5/2 </option>
            <option value= "3"> 5/3 </option>
            <option value= "4"> 5/4 </option>  
            <option value= "5"> 5/5 </option> 
            <option value= "6"> 5/6 </option> 
            <option value= "7"> 5/7 </option>
            <option value= "8"> 5/8 </option>
            <option value= "9"> 5/9 </option>
            <option value= "10"> 5/10 </option>
            <option value= "11"> 5/11 </option>  
            <option value= "12"> 5/12 </option> 
            <option value= "13"> 5/13 </option> 
            <option value= "14"> 5/14 </option> 
            <option value= "15"> 5/15 </option>
            <option value= "16"> 5/16 </option>
            <option value= "17"> 5/17 </option>
          </select>
        </div>
      </div>
      <div class="form-row px-3">
          <div class="col">
            <div class="input-group input-group-sm">
                <select name="time" id="timelist" class="custom-select custom-select-sm">
            <option value="" selected disabled>請選擇時間</option>
            <option value= "t0000"> 00:00~00:10 </option>
            <option value= "t0010"> 00:10~00:20 </option>
            <option value= "t0020"> 00:20~00:30 </option>
            <option value= "t0030"> 00:30~00:40 </option>  
            <option value= "t0040"> 00:40~00:50 </option> 
            <option value= "t0050"> 00:50~01:00 </option> 
            <option value= "t0100"> 01:00~01:10 </option>
            <option value= "t0110"> 01:10~01:20 </option>
            <option value= "t0120"> 01:20~01:30 </option>
            <option value= "t0130"> 01:30~01:40 </option>
            <option value= "t0140"> 01:40~01:50 </option>  
            <option value= "t0150"> 01:50~02:00 </option> 
            <option value= "t0200"> 02:00~02:10 </option> 
            <option value= "t0210"> 02:10~02:20 </option> 
            <option value= "t0220"> 02:20~02:30 </option>
            <option value= "t0230"> 02:30~02:40 </option>
            <option value= "t0240"> 02:40~02:50 </option>
            <option value= "t0250"> 02:50~03:00 </option>  
            <option value= "t0300"> 03:00~03:10 </option> 
            <option value= "t0310"> 03:10~03:20 </option> 
            <option value= "t0320"> 03:20~03:30 </option> 
            <option value= "t0330"> 03:30~03:40 </option>
            <option value= "t0340"> 03:40~03:50 </option>
            <option value= "t0350"> 03:50~04:00 </option>
            <option value= "t0400"> 04:00~04:10 </option>  
            <option value= "t0410"> 04:10~04:20 </option> 
            <option value= "t0420"> 04:20~04:30 </option> 
            <option value= "t0430"> 04:30~04:40 </option>
            <option value= "t0440"> 04:40~04:50 </option>
            <option value= "t0450"> 04:50~05:00 </option>
            <option value= "t0500"> 05:00~05:10 </option>
            <option value= "t0510"> 05:10~05:20 </option>
            <option value= "t0520"> 05:20~05:30 </option>
            <option value= "t0530"> 05:30~05:40 </option>  
            <option value= "t0540"> 05:40~05:50 </option> 
            <option value= "t0550"> 05:50~06:00 </option> 
            <option value= "t0600"> 06:00~06:10 </option> 
            <option value= "t0610"> 06:10~06:20 </option>
            <option value= "t0620"> 06:20~06:30 </option>
            <option value= "t0630"> 06:30~06:40 </option>
            <option value= "t0640"> 06:40~06:50 </option>  
            <option value= "t0650"> 06:50~07:00 </option> 
            <option value= "t0700"> 07:00~07:10 </option> 
            <option value= "t0710"> 07:10~07:20 </option> 
            <option value= "t0720"> 07:20~07:30 </option>
            <option value= "t0730"> 07:30~07:40 </option>
            <option value= "t0740"> 07:40~07:50 </option>
            <option value= "t0750"> 07:50~08:00 </option>  
            <option value= "t0800"> 08:00~08:10 </option> 
            <option value= "t0810"> 08:10~08:20 </option> 
            <option value= "t0820"> 08:20~08:30 </option> 
            <option value= "t0830"> 08:30~08:40 </option>
            <option value= "t0840"> 08:40~08:50 </option>
            <option value= "t0850"> 08:50~09:00 </option>  
            <option value= "t0900"> 09:00~09:10 </option> 
            <option value= "t0910"> 09:10~09:20 </option> 
            <option value= "t0920"> 09:20~09:30 </option> 
            <option value= "t0930"> 09:30~09:40 </option>
            <option value= "t0940"> 09:40~09:50 </option>
            <option value= "t0950"> 09:50~10:00 </option>
            <option value= "t1000"> 10:00~10:10 </option>  
            <option value= "t1010"> 10:10~10:20 </option> 
            <option value= "t1020"> 10:20~10:30 </option> 
            <option value= "t1030"> 10:30~10:40 </option> 
            <option value= "t1040"> 10:40~10:50 </option> 
            <option value= "t1050"> 10:50~11:00 </option> 
            <option value= "t1100"> 11:00~11:10 </option>
            <option value= "t1110"> 11:10~11:20 </option>
            <option value= "t1120"> 11:20~11:30 </option>
            <option value= "t1130"> 11:30~11:40 </option>
            <option value= "t1140"> 11:40~11:50 </option>  
            <option value= "t1150"> 11:50~12:00 </option> 
            <option value= "t1200"> 12:00~12:10 </option> 
            <option value= "t1210"> 12:10~12:20 </option> 
            <option value= "t1220"> 12:20~12:30 </option>
            <option value= "t1230"> 12:30~12:40 </option>
            <option value= "t1240"> 12:40~12:50 </option>
            <option value= "t1250"> 12:50~13:00 </option>  
            <option value= "t1300"> 13:00~13:10 </option> 
            <option value= "t1310"> 13:10~13:20 </option> 
            <option value= "t1320"> 13:20~13:30 </option> 
            <option value= "t1330"> 13:30~13:40 </option>
            <option value= "t1340"> 13:40~13:50 </option>
            <option value= "t1350"> 13:50~14:00 </option>
            <option value= "t1400"> 14:00~14:10 </option>  
            <option value= "t1410"> 14:10~14:20 </option> 
            <option value= "t1420"> 14:20~14:30 </option> 
            <option value= "t1430"> 14:30~14:40 </option>
            <option value= "t1440"> 14:40~14:50 </option>
            <option value= "t1450"> 14:50~15:00 </option>
            <option value= "t1500"> 15:00~15:10 </option>
            <option value= "t1510"> 15:10~15:20 </option>
            <option value= "t1520"> 15:20~15:30 </option>
            <option value= "t1530"> 15:30~15:40 </option>  
            <option value= "t1540"> 15:40~15:50 </option> 
            <option value= "t1550"> 15:50~16:00 </option> 
            <option value= "t1600"> 16:00~16:10 </option> 
            <option value= "t1610"> 16:10~16:20 </option>
            <option value= "t1620"> 16:20~16:30 </option>
            <option value= "t1630"> 16:30~16:40 </option>
            <option value= "t1640"> 16:40~16:50 </option>  
            <option value= "t1650"> 16:50~17:00 </option> 
            <option value= "t1700"> 17:00~17:10 </option> 
            <option value= "t1710"> 17:10~17:20 </option> 
            <option value= "t1720"> 17:20~17:30 </option>
            <option value= "t1730"> 17:30~17:40 </option>
            <option value= "t1740"> 17:40~17:50 </option>
            <option value= "t1750"> 17:50~18:00 </option>  
            <option value= "t1800"> 18:00~18:10 </option> 
            <option value= "t1810"> 18:10~18:20 </option>
            <option value= "t1820"> 18:20~18:30 </option>  
            <option value= "t1830"> 18:30~18:40 </option> 
            <option value= "t1840"> 18:40~18:50 </option> 
            <option value= "t1850"> 18:50~19:00 </option> 
            <option value= "t1900"> 19:00~19:10 </option>
            <option value= "t1910"> 19:10~19:20 </option>
            <option value= "t1920"> 19:20~19:30 </option>
            <option value= "t1930"> 19:30~19:40 </option>  
            <option value= "t1940"> 19:40~19:50 </option> 
            <option value= "t1950"> 19:50~20:00 </option>
            <option value= "t2000"> 20:00~20:10 </option>  
            <option value= "t2010"> 20:10~20:20 </option> 
            <option value= "t2020"> 20:20~20:30 </option> 
            <option value= "t2030"> 20:30~20:40 </option> 
            <option value= "t2040"> 20:40~20:50 </option>
            <option value= "t2050"> 20:50~21:00 </option>
            <option value= "t2100"> 21:00~21:10 </option>
            <option value= "t2110"> 21:10~21:20 </option>  
            <option value= "t2120"> 21:20~21:30 </option> 
            <option value= "t2130"> 21:30~21:40 </option>
            <option value= "t2140"> 21:40~21:50 </option>  
            <option value= "t2150"> 21:50~22:00 </option> 
            <option value= "t2200"> 22:00~22:10 </option> 
            <option value= "t2210"> 22:10~22:20 </option> 
            <option value= "t2220"> 22:20~22:30 </option>
            <option value= "t2230"> 22:30~22:40 </option>
            <option value= "t2240"> 22:40~22:50 </option>
            <option value= "t2250"> 22:50~23:00 </option>  
            <option value= "t2300"> 23:00~23:10 </option> 
            <option value= "t2310"> 23:10~23:20 </option>
            <option value= "t2320"> 23:20~23:30 </option>  
            <option value= "t2330"> 23:30~23:40 </option> 
            <option value= "t2340"> 23:40~23:50 </option> 
            <option value= "t2350"> 23:50~00:00 </option> 
          </select>
          <div class="input-group-append">
          <input class="btn btn-primary" type="submit" value="搜尋" aria-describedby="search-btn" >
            </div>
          </div>
      </div>
          </div>           
        </form>
        <div id="store-total" class="px-3 mt-2">載入中...</div>
    </div>    
    <div id="store-list"></div>
    <div id="open-board-btn" class="d-block d-sm-none"><i class="fas fa-bars"></i></div>
  </aside>
<div id="map"></div>
<script>
//地圖
var map = L.map('map', {
    center: [24.16903,120.70502],
    zoom: 8,
  zoomControl: false
});
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  minZoom: 8,
  maxZoom: 20
}).addTo(map);
L.control
  .zoom({
    position: "topright"
  })
  .addTo(map);    
/*var nospace = new L.Icon({
  iconUrl: 'https://chiayi.youbike.com.tw/photos/map/2.0_icon_full.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [30, 46],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
var nobike = new L.Icon({
  iconUrl: 'https://chiayi.youbike.com.tw/photos/map/2.0_icon_nobike.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [30, 46],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
var work = new L.Icon({
  iconUrl: 'https://chiayi.youbike.com.tw/photos/map/2.0_icon_nomo.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [30, 46],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
    
var marker = new L.MarkerClusterGroup().addTo(map);

for(var i=0;i<total;i++)
{
    var check
    if(emptyarr[i]==0)//若可停空位數=0，則顯示紅色
        {
            check=nospace;
        }
    else if(availablearr[i]==0)//若可借車輛數=0，則顯示黃色
        {
            check=nobike;
        }
    else //其他則顯示綠色
        {
            check=work;
        }
    marker.addLayer(L.marker([latarr[i],lngarr[i]], {icon:check}).bindPopup("<h2>"+stationarr[i]+"</h2>"+"<h3>可還空位數:"+emptyarr[i]+"</h3>"+"<h3>可借車輛數:"+availablearr[i]+"</h3>"));
}
map.addLayer(marker);*/   
getToday();
// 取得今日日期
function getToday() {
  let today = new Date();
  const days = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
  let todayStr = `今天是 <span class="font-weight-bold">${today.getFullYear()} 年 ${today.getMonth() + 1} 月 ${today.getDate()} 日 ${days.find((day, index) => index === today.getDay())} </span>`;
  document.getElementById('date').innerHTML = todayStr;
}

/*function changeCollege(index){
let Sinner = `<option value="" selected disabled>請選擇站點區域</option>`;   
for(var i=0;i<sectors[index].length;i++){
	Sinner=Sinner+'<option value=i>'+sectors[index][i]+'</option>';
}
var sectorSelect=document.getElementById("sector-list");
sectorSelect.innerHTML=Sinner;
if(index == 1){
x=0;
let str = ``;
let storeCount = 0;
        for(var j=0;j<total;j++)
            {
                if(areaarr[j]=='00'){
                    x=j;
                    [str, storeCount]=createHTML(str, storeCount);
                }
                
  document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
  document.getElementById('store-list').innerHTML = str;     
    }  
        

for(var j=0;j<total;j++)
            {
                if(areaarr[j]=='00'&& districtarr[j]==sectors[index][index1]){
                    x=j;
                    [str, storeCount]=createHTML(str, storeCount);
                }
                
  //document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
  document.getElementById('store-list').innerHTML = str;     
    }

}
else  if(index == 2){
x=0;
let str = ``;
let storeCount = 0;
        for(var j=0;j<total;j++)
            {
                if(areaarr[j]=='01'){
                    x=j;
                    [str, storeCount]=createHTML(str, storeCount);
                }
  document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
  document.getElementById('store-list').innerHTML = str;     
    }
}
else  if(index == 3){
x=0;
let str = ``;
let storeCount = 0;
        for(var j=0;j<total;j++)
            {
                if(areaarr[j]=='08'){
                    x=j;
                    [str, storeCount]=createHTML(str, storeCount);
                }
  document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
  document.getElementById('store-list').innerHTML = str;     
    }
}
else  if(index == 4){
x=0;
let str = ``;
let storeCount = 0;
        for(var j=0;j<total;j++)
            {
                if(areaarr[j]=='12'){
                    x=j;
                    [str, storeCount]=createHTML(str, storeCount);
                }
  document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
  document.getElementById('store-list').innerHTML = str;     
    }
} 
} */

<?php
$city = '0';
$date = '0';
$time = '0';

$longitude[]='0';
$latitude[]='0';
$area[]='0';
$district[]='0';
$adress[]='0';
$StationName[]='0';
$available[]='0';
$empty[]='0';

if(isset($_POST["time"]))
{
    $time = $_POST["time"];
}  
if(isset($_POST["city"]))
{
    $city = $_POST["city"];
}
if(isset($_POST["date"]))
{
    $date = $_POST["date"];
}  
$conn = new mysqli("localhost","root","","chiayiavg"); //連接
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT station_no,name_tw,district_tw,address_tw,available_avg,empty_avg,lat,lng FROM $time ";
$result = $conn->query($sql);
while ($row=$result->fetch_assoc()) {
	$longitude[]=$row["lng"];
	$latitude[]=$row["lat"];
	$area[]=$row["station_no"];
    $district[]=$row["district_tw"];
    $adress[]=$row["address_tw"];
    $StationName[]=$row["name_tw"];
    $available[]=$row["available_avg"];
    $empty[]=$row["empty_avg"];
}
$totaldata=count($longitude);//計算資料數目
$conn->close();//關閉MySQL連線
?>

var x = 0;
var city = <?php echo $city?>;
var total = <?php echo $totaldata  ?>; 
var lngarr = <?php echo json_encode($longitude) ?>;//經度array
var latarr = <?php echo json_encode($latitude) ?>;//緯度array
var areaarr = <?php echo json_encode($area) ?>;//所在縣市
var districtarr = <?php echo json_encode($district) ?>;//所在鄉鎮區
var stationarr = <?php echo json_encode($StationName) ?>;//站點名稱
var adressarr = <?php echo json_encode($adress) ?>;//地址
var availablearr = <?php echo json_encode($available) ?>;//可借車數
var emptyarr = <?php echo json_encode($empty) ?>;

if(city == 3){    
let str = ``;
let storeCount = 0;                
    for(var j=1;j<total;j++){
        //if(areaarr[j]=='00'){
            x=j;
            [str, storeCount]=createHTML(str, storeCount);
        //}
        document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
        document.getElementById('store-list').innerHTML = str;     
    }
}
    
// 產生站點 HTML 樣板。
function createHTML(html,count) {
  let [bgAdultColor, bgChildColor] = ['#bfffbf', '#bfffbf']; // 綠
  if(availablearr[x] <= 10) bgAdultColor = '#ffa470'; // 橙
  if(availablearr[x] <= 3) bgAdultColor = '#ff9696'; // 紅
  if(emptyarr[x] <= 10) bgChildColor = '#ffa470';
  if(emptyarr[x] <= 3) bgChildColor = '#ff9696';
  html += `
    <div class="store-info p-3" data-lat="${latarr[x]}" data-lng="${lngarr[x]}">
      <div class="d-flex justify-content-between">
        <h5 class="font-weight-bold mb-2">${stationarr[x]}</h5>
      </div>
      <p class="mb-1"><i class="fas fa-map-marker-alt"></i>  <a href="https://www.google.com.tw/maps/place/${adressarr[x]}" target="_blank">${adressarr[x]}</a></p>
      <div class="masks-info">
        <div class="mask-item" style="background-color: ${bgAdultColor}">可借車輛數量 <span>${availablearr[x]}</span> 個</div>
        <div class="mask-item" style="background-color: ${bgChildColor}">可還空位數量 <span>${emptyarr[x]}</span> 個</div>
      </div>
    </div>
    <hr class="m-0">  
  `;
  count += 1;
  return [html, count];
}    
      
</script>
</body>
</html>
