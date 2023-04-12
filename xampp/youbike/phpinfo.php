<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "youbikedb";
$c=0;
$conn = new mysqli($servername, $username, $password, $dbname); //連接
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
/*if ($c==1){
    $sql = "SELECT name_tw,area_code,district_tw,address_tw,available_spaces,empty_spaces,lat,lng FROM user1 ";
}
else{*/
$sql = "SELECT name_tw,area_code,district_tw,address_tw,available_spaces,empty_spaces,lat,lng FROM user3 ";
//}
$result = $conn->query($sql);
//該函數fetch_assoc()會將所有結果放入一個關聯數組
while ($row=$result->fetch_assoc()) {
	$longitude[]=$row["lng"];
	$latitude[]=$row["lat"];
	$area[]=$row["area_code"];
    $district[]=$row["district_tw"];
    $adress[]=$row["address_tw"];
    $StationName[]=$row["name_tw"];
    $available[]=$row["available_spaces"];
    $empty[]=$row["empty_spaces"];
  } 
$totaldata=count($longitude);//計算資料數目
?>
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
        <h1 class="mb-0 h3 font-weight-bold">YouBike2.0實時地圖</h1>
         <input type="button" value="回首頁" name="按鈕名稱" onclick="self.location.href='https://pkztl8qunruhavnjqpmohq-on.drv.tw/mainpage/'"/>
        <div id="close-board-btn" class="d-block d-sm-none"><i class="fas fa-caret-right"></i></div>
      </div>
      <div id="date" class="px-3 mb-2"></div>
      <div class="form-row px-3">
        <div class="form-group col-6">
          <select id="college-list" class="custom-select custom-select-sm"onchange="changeCollege(this.selectedIndex)">
            <option value="" selected disabled>台北市</option>
          </select>
        </div>
        <div class="form-group col-6">
          <select id="sector-list" class="custom-select custom-select-sm"onchange="changeArea(this.selectedIndex)">
            <option value="" selected disabled>請選擇站點區域</option>
          </select>
        </div>
      </div>
    <form method="GET" action="phpinfo.php">
      <div class="form-row px-3">
        <div class="col">
          <div class="input-group input-group-sm">
            <input type="text" name='username' id="search-value" class="form-control" placeholder="透過地址或名稱搜尋" aria-label="透過地址或名稱搜尋" aria-describedby="search-btn">
            <div class="input-group-append">
            <input class="btn btn-primary" type='submit' value="搜尋"/>
            </div>
          </div>
        </div>
      </div>
    </form>
        <div id="store-total" class="px-3 mt-2"></div>
    </div>
    <div id="store-list"></div>
    <div id="open-board-btn" class="d-block d-sm-none"><i class="fas fa-bars"></i></div>
  </aside>
    <ul id="legend">
    <li>
      <img src="https://chiayi.youbike.com.tw/photos/map/2.0_icon_nomo.png" alt="" class="img-fluid" width="28"> 車輛數 > 10
    </li>
    <li>
      <img src="https://chiayi.youbike.com.tw/photos/map/2.0_icon_nobike.png" alt="" class="img-fluid" width="28"> 車輛數 <= 10
    </li>
    <li>
      <img src="https://chiayi.youbike.com.tw/photos/map/2.0_icon_full.png" alt="" class="img-fluid" width="28"> 車輛數 <= 3
    </li>
  </ul>
<div id="map"></div>
<script>

var total = <?php echo $totaldata  ?>;  //總站數數量
var lngarr = <?php echo json_encode($longitude) ?>;//經度array
var latarr = <?php echo json_encode($latitude) ?>;//緯度array
var areaarr = <?php echo json_encode($area) ?>;//所在縣市
var districtarr = <?php echo json_encode($district) ?>;//所在鄉鎮區
var stationarr = <?php echo json_encode($StationName) ?>;//站點名稱
var adressarr = <?php echo json_encode($adress) ?>;//地址
var availablearr = <?php echo json_encode($available) ?>;//可借車數
var emptyarr = <?php echo json_encode($empty) ?>;//可還空位數

var map = L.map('map', {
    center: [23.4790323,120.414277],
    zoom: 13,
  zoomControl: false
});
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  minZoom: 13,
  maxZoom: 20
}).addTo(map);
L.control
  .zoom({
    position: "topright"
  })
  .addTo(map);    
var nospace = new L.Icon({
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
    marker.addLayer(L.marker([latarr[i],lngarr[i]], {icon:check}).bindPopup("<h2>"+stationarr[i]+"</h2>"+"<h3>"+adressarr[i]+"</h3>"+"<h3>可還空位數:"+emptyarr[i]+"</h3>"+"<h3>可借車輛數:"+availablearr[i]+"</h3>"));
}
map.addLayer(marker);

var x=0;
var key="";
var city=0;
var colleges=['嘉義市'];
var collegeSelect=document.getElementById("college-list");
let inner = `<option value="" selected disabled>請選擇縣市</option>`;  
for(var i=0;i<colleges.length;i++){
    inner=inner+'<option value=i>'+colleges[i]+'</option>';
}
collegeSelect.innerHTML=inner;			
var sectors=new Array();
sectors[1]=['市區'];	
    
getToday();
getUserPosition();
changeCollege(document.getElementById("college-list").selectedIndex);
changeArea(document.getElementById("sector-list").selectedIndex);
//findStore(document.getElementById("college-list").selectedIndex);
    
// 取得今日日期
function getToday() {
  let today = new Date();
  const days = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
  let todayStr = `今天是 <span class="font-weight-bold">${today.getFullYear()} 年 ${today.getMonth() + 1} 月 ${today.getDate()} 日 ${days.find((day, index) => index === today.getDay())} </span>`;
  document.getElementById('date').innerHTML = todayStr;
}
    
function changeCollege(index){
let Sinner = `<option value="" selected disabled>請選擇站點區域</option>`;   
for(var i=0;i<sectors[index].length;i++){
	Sinner=Sinner+'<option value=i>'+sectors[index][i]+'</option>';
}
var sectorSelect=document.getElementById("sector-list");
sectorSelect.innerHTML=Sinner;
city = 1;
x=0;
let str = ``;
let storeCount = 0;
    for(var j=0;j<total;j++){
        //if(areaarr[j] == key){
            x=j;
            [str, storeCount]=createHTML(str, storeCount); 
        //}
   document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
   document.getElementById('store-list').innerHTML = str;     
   }      
}
    
function changeArea(index){
var area=sectors[city][index-1];
x=0;
let str = ``;
let storeCount = 0;
    for(var j=0;j<total;j++){
        if(districtarr[j]==area){
            x=j;
            [str, storeCount]=createHTML(str, storeCount);
        }      
   document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
   document.getElementById('store-list').innerHTML = str;     
   }    
}
    
// 產生站點 HTML 樣板。
function createHTML(html,count) {
  let [bgAdultColor, bgChildColor] = ['#bfffbf', '#bfffbf']; // 綠
  if(availablearr[x] <= 10) bgAdultColor = '#ffa470'; // 橙
  if(availablearr[x] <= 3) bgAdultColor = '#ff9696'; // 紅
  if(emptyarr[x] <= 10) bgChildColor = '#ffa470'; // 橙
  if(emptyarr[x] <= 3) bgChildColor = '#ff9696'; // 紅
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
    
// 取得使用者的地理位置。
function getUserPosition() {
  if(navigator.geolocation) {
    function showPosition(position) {
      L.marker([position.coords.latitude, position.coords.longitude], {iconUrl: 'https://maps.gstatic.com/tactile/minimap/pegman-offscreen-1x.png'}).addTo(map);
      map.setView([position.coords.latitude, position.coords.longitude], 16);
    }
    function showError() {
      console.log('抱歉，現在無法取的您的地理位置。')
    }

    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    console.log('抱歉，您的裝置不支援定位功能。');
  }
}
    
function findStore() {
    
   //document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
   //document.getElementById('store-list').innerHTML = str;     
    /*key = "松山" ;
    x = 0 ;
    let str = ``;
    let storeCount = 0;
    for(var k = 0 ; k < total ; k++){
        if( stationarr[k] == key || adressarr[k] == key){
            x = k ;
            [str, storeCount]=createHTML(str, storeCount); 
        }
   document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
   document.getElementById('store-list').innerHTML = str;     
   } */
    
  /*if (isset($_GET['username']))
{
  $name = $_GET['username'];

  //echo "<table border='2' bordercolor='#66ccff'>";
  /*while ($row = mysqli_fetch_assoc($result)) {
    //if ($row['name_tw'] == $name )
    //if (strpos($row['name_tw'], $name, 0) !== false) {
    //echo $row['name_tw'];  
    //echo $row['name_tw'][1];
    //echo "<tr>";
    //echo "<td>地址:" . $row["address_tw"] . "</td><td>可借車數:" . $row["available_spaces"] . "</td><td>可還空位數:" . $row["empty_spaces"] . "</td>";
    //echo "</tr>";   
    }   
  }
//echo "</table>";
}  */
}
// 搜尋所選擇的藥局資訊。
/*function findStore() {
  let str = ``;
  let storeCount = 0;
  let matchedStore = [];

  if(!areaSelected) {
    matchedStore = stores.filter(store => store.properties.address.includes(citySelected));
  } else if(areaSelected === 'all') {
    findStore(stores, citySelected, false); return;
  } else {
    matchedStore = stores.filter(store => store.properties.address.includes(citySelected + areaSelected));
  }

  matchedStore = matchedStore.sort((a, b) => b.properties.mask_adult - a.properties.mask_adult);
  matchedStore.forEach(store => {
    [str, storeCount] = createHTML(store, str, storeCount);
  })
  document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 家藥局。${stores[0].properties.updated ? `（${stores[0].properties.updated.split(' ')[1]} 更新）` : ``} `;
  document.getElementById('store-list').innerHTML = str;*/
  // 地圖自動定位至該縣市／鄉鎮市區。
  //if(areaSelected) map.setView([matchedStore[0].geometry.coordinates[1], matchedStore[0].geometry.coordinates[0]], 14);

  // 點選資訊卡片會將地圖自動定位至該位置。
  /*const storeInfoEl = document.querySelectorAll('.store-info');
  storeInfoEl.forEach(storeEl => {
    storeEl.addEventListener('click', function() {
});
    })
  })
}   */
</script>
</body>
</html>