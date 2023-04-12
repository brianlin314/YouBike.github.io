/*$.LoadingOverlay("show",{
  background  : "rgba(0, 0, 0, 0.5)"
});*/
let storeCluster;
var x = 1;
var dis = 0;
var myLocation;
const getCityDatas = getXML(
  "https://raw.githubusercontent.com/Feitoengineer19/mask-map/master/CityCountyData.json"
);
const getTaipeiDatas = getXML(  "https://tcgbusfs.blob.core.windows.net/dotapp/youbike/v2/youbike_immediate.json"
);
const getNewTaipeiDatas = getXML(  "https://cors-anywhere.herokuapp.com/https://data.ntpc.gov.tw/api/datasets/71CD1490-A2DF-4198-BEF1-318479775E8A/json/preview"
);
const gethsinpeiDatas = getXML(  "https://cors-anywhere.herokuapp.com/https://odws.hccg.gov.tw/001/Upload/25/opendataback/9059/59/f8bec8be-eb77-4c37-93e6-9245cd9961bc.json"
);
// 建立 Leaflet 地圖，並設定中心經緯度座標（台北市），縮放程度為 10。
var map = L.map("map", {
  center: [25.040065, 121.523235],
  zoom: 10,
  zoomControl: false
});
// 設定地圖資料來源（OpenStreetMap）。
const osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
L.tileLayer(osmUrl, {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  minZoom: 8,
  maxZoom: 20
}).addTo(map);
// 自訂縮放按鈕位置。
L.control
  .zoom({
    position: "topright"
  })
  .addTo(map);
// 自訂座標 Icon。
var greenIcon = new L.Icon({
  iconUrl:
    "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png",
  shadowUrl:    "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
var redIcon = new L.Icon({
  iconUrl:
    "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
  shadowUrl:  "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

var myLocation;
map.locate({setView: true, watch: true});
// 成功定位到使用者的位置時觸發
map.on('locationfound', onLocationFound);
// 失敗時觸發
map.on('locationerror', onLocationError);
function onLocationFound(d) {
}
function onLocationError(d) {
}
function onLocationFound(d) {
  myLocation = d.latlng // 使用者位置
L.marker(myLocation).addTo(map)
    .openPopup();
}

var marks = new L.MarkerClusterGroup().addTo(map);
var taipeimarkers = new L.MarkerClusterGroup().addTo(map);
var newtaipeimarkers = new L.MarkerClusterGroup().addTo(map);
var kaomarkers = new L.MarkerClusterGroup().addTo(map);
var taomarkers = new L.MarkerClusterGroup().addTo(map);
var taichungmarkers = new L.MarkerClusterGroup().addTo(map);
var tainanmarkers = new L.MarkerClusterGroup().addTo(map);

//台北市ubike位置標記
var xhr = new XMLHttpRequest();
xhr.open("get","https://tcgbusfs.blob.core.windows.net/dotapp/youbike/v2/youbike_immediate.json");
xhr.send();
xhr.onload = function(){
 var data = JSON.parse(xhr.responseText)
 for(let i =0;data.length>i;i++){
  var danger;
  if(data[i].sbi < 3){
   danger = redIcon;
  }else{
   danger = greenIcon;
  } 
  taipeimarkers.addLayer(L.marker([data[i].lat,data[i].lng], {icon: danger}).bindPopup("<strong>"+data[i].sna+"<strong/>"+"<h2>可還空位數:"+data[i].bemp+"<h2/>"+"<h2>可借車輛數:"+data[i].sbi+"<h2/>"));
 }
 map.addLayer(taipeimarkers);
}
//新北市ubike位置標記
var newtaipeixhr = new XMLHttpRequest();
newtaipeixhr.open("get","https://raw.githubusercontent.com/brianlin314/ubikejson/main/newtaipei.json");
newtaipeixhr.send();
newtaipeixhr.onload = function(){
 var data = JSON.parse(newtaipeixhr.responseText)
 for(let i =0;data.length>i;i++){
  var danger;
  if(data[i].sbi < 3){
   danger = redIcon;
  }else{
   danger = greenIcon;
  } 
  newtaipeimarkers.addLayer(L.marker([data[i].lat,data[i].lng], {icon: danger}).bindPopup("<strong>"+data[i].sna+"<strong/>"+"<h2>可還空位數:"+data[i].bemp+"<h2/>"+"<h2>可借車輛數:"+data[i].sbi+"<h2/>"));
 }
 map.addLayer(newtaipeimarkers);
}
//高雄市ubike位置標記
var kaoxhr = new XMLHttpRequest();
kaoxhr.open("get","https://raw.githubusercontent.com/brianlin314/ubikejson/main/kao.json");
kaoxhr.send();
kaoxhr.onload = function(){
 var data = JSON.parse(kaoxhr.responseText).data.retVal
 for(let i =0;data.length>i;i++){
  var danger;
  if(data[i].sbi < 3){
   danger = redIcon;
  }else{
   danger = greenIcon;
  } 
  kaomarkers.addLayer(L.marker([data[i].lat,data[i].lng], {icon: danger}).bindPopup("<strong>"+data[i].sna+"<strong/>"+"<h2>可還空位數:"+data[i].bemp+"<h2/>"+"<h2>可借車輛數:"+data[i].sbi+"<h2/>"));
 }
 map.addLayer(kaomarkers);
}
//桃園市ubike位置標記
var taoxhr = new XMLHttpRequest();
taoxhr.open("get","https://raw.githubusercontent.com/brianlin314/ubikejson/main/tao.json");
taoxhr.send();
taoxhr.onload = function(){
 var data = JSON.parse(taoxhr.responseText).records
 for(let i =0;data.length>i;i++){
  var danger;
  if(data[i].sbi < 3){
   danger = redIcon;
  }else{
   danger = greenIcon;
  } 
  taomarkers.addLayer(L.marker([data[i].lat,data[i].lng], {icon: danger}).bindPopup("<strong>"+data[i].sna+"<strong/>"+"<h2>可還空位數:"+data[i].bemp+"<h2/>"+"<h2>可借車輛數:"+data[i].sbi+"<h2/>"));
 }
 map.addLayer(taomarkers);
}
//台中市ubike位置標記
var taichungxhr = new XMLHttpRequest();
taichungxhr.open("get","https://raw.githubusercontent.com/brianlin314/ubikejson/main/taichung.json");
taichungxhr.send();
taichungxhr.onload = function(){
 var data = JSON.parse(taichungxhr.responseText).retVal
 for(let i =0;data.length>i;i++){
  var danger;
  if(data[i].sbi < 3){
   danger = redIcon;
  }else{
   danger = greenIcon;
  } 
  taichungmarkers.addLayer(L.marker([data[i].lat,data[i].lng], {icon:greenIcon }).bindPopup("<strong>"+data[i].sna+"<strong/>"+"<h2>可還空位數:"+data[i].bemp+"<h2/>"+"<h2>可借車輛數:"+data[i].sbi+"<h2/>"));
 }
 map.addLayer(taichungmarkers);
}
//台南市Tbike位置標記
var tainanxhr = new XMLHttpRequest();
tainanxhr.open("get","https://raw.githubusercontent.com/brianlin314/ubikejson/main/tainan.json");
tainanxhr.send();
tainanxhr.onload = function(){
 var data = JSON.parse(tainanxhr.responseText)
 for(let i =0;data.length>i;i++){
  var danger;
  if(data[i].sbi < 3){
   danger = redIcon;
  }else{
   danger = greenIcon;
  }  tainanmarkers.addLayer(L.marker([data[i].Latitude,data[i].Longitude], {icon: danger}).bindPopup("<strong>"+data[i].StationName+"<strong/>"+"<h2>可還空位數:"+data[i].AvaliableSpaceCount+"<h2/>"+"<h2>可借車輛數:"+data[i].AvaliableBikeCount+"<h2/>"));
 }
 map.addLayer(tainanmarkers);
}

// 串接 API，（非同步）獲取遠端 API 或本地 JSON 資料（封裝成一個 function）。
function getXML(path) {
  // 利用 Promise 確保獲取資料完成。
  return new Promise((resolve, reject) => {
    const xhrReq = new XMLHttpRequest();
    xhrReq.onload = function () {
      if (xhrReq.status == 200) {
        const data = JSON.parse(xhrReq.response);
        resolve(data);
      } else {
        console.log("抱歉，現在無法取的即時資訊！");
      }
    };
    xhrReq.open("GET", path);
    xhrReq.send();
  });
}

// 當所有資料獲取完畢後，渲染資料。
Promise.all([getCityDatas, getTaipeiDatas]).then(resultDatas => {
  const cityDatas = resultDatas[0];
  const storeDatas = resultDatas[1];
  //const storeDatas1 = resultDatas[2];

  getToday();
  //createAreaOption(cityDatas, '台北市');
  findStore(storeDatas, '台北市', false);

  document.getElementById('city').addEventListener('change', function() {
    const citySelected = document.getElementById('city').value;
    document.getElementById('search-value').value = '';
    createAreaOption(cityDatas, citySelected);
    findStore(storeDatas, citySelected, false);
  })

  document.getElementById('area').addEventListener('change', function() {
    const citySelected = document.getElementById('city').value;
    const areaSelected = document.getElementById('area').value;
    document.getElementById('search-value').value = '';
    findStore(storeDatas, citySelected, areaSelected);
  })

  document.getElementById('search-btn').addEventListener('click', function() {
    const searchValue = document.getElementById('search-value').value;
    let str = ``;
    let storeCount = 0;
    storeDatas.filter(store => {
      if(store.ar.includes(searchValue) || store.sna.includes(searchValue)) {
        [str, storeCount] = createHTML(store, str, storeCount);
      }
    })
    document.getElementById('store-total').innerHTML = `總共找到</u> ${storeCount} 家相符的藥局。`;
    document.getElementById('store-list').innerHTML = str;
  })

  document.getElementById('close-board-btn').addEventListener('click', function() {
    document.querySelector('.board').classList.add('hide');
  })

  document.getElementById('open-board-btn').addEventListener('click', function() {
    document.querySelector('.board').classList.remove('hide');
  })
})

// 取得今日日期
function getToday() {
  let today = new Date();
  const days = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
  let todayStr = `今天是 <span class="font-weight-bold">${today.getFullYear()} 年 ${today.getMonth() + 1} 月 ${today.getDate()} 日 ${days.find((day, index) => index === today.getDay())} </span>`;
  document.getElementById('date').innerHTML = todayStr;
}

// 產生鄉鎮市區搜尋欄位裡的選項。
function createAreaOption(cityData, citySelected) {
  const areaSelect = document.getElementById('area');
  const citySelectedObj = cityData.find(item => item.CityName.replace(/臺/g, '台') === citySelected);
  const areaArray = citySelectedObj.AreaList;

  let areaOptionHTML = `<option value="" selected disabled>請選擇鄉鎮市區</option>`;
  areaArray.forEach(item => {
    areaOptionHTML += `<option value="${item.AreaName}">${item.AreaName}</option>`;
  })
  areaSelect.innerHTML = areaOptionHTML;
}

// 產生藥局資訊的 HTML 樣板。
function createHTML(store, html, count, loved = false) {
  let [bgAdultColor, bgChildColor] = ['#bfffbf', '#bfffbf']; // 綠
  if(store.sbi <= 10) bgAdultColor = '#ffa470'; // 橙
  if(store.sbi <= 3) bgAdultColor = '#ff9696'; // 紅
  if(store.bemp <= 10) bgChildColor = '#ffa470';
  if(store.bemp <= 3) bgChildColor = '#ff9696';
  html += `
    <div class="store-info p-3" data-lat="${store.lat}" data-lng="${store.lng}">
      <div class="d-flex justify-content-between">
        <h5 class="font-weight-bold mb-2">${store.sna}</h5>
      </div>
      <p class="mb-1"><i class="fas fa-map-marker-alt"></i>  <a href="https://www.google.com.tw/maps/place/${store.ar}" target="_blank">${store.ar}</a></p>
      <div class="masks-info">
        <div class="mask-item" style="background-color: ${bgAdultColor}">可借車輛數量 <span>${store.sbi}</span> 個</div>
        <div class="mask-item" style="background-color: ${bgChildColor}">可還空位數量 <span>${store.bemp}</span> 個</div>
      </div>
    </div>
    <hr class="m-0">  
  `;
  count += 1;
  return [html, count];
}

// 搜尋所選擇的站點站點資訊。
function findStore(stores, citySelected, areaSelected) {
  let str = ``;
  let storeCount = 0;
  let matchedStore = [];

if(areaSelected === "") {
    matchedStore = stores.filter(store => store.sarea.includes(citySelected));
  } else {
    matchedStore = stores.filter(store => store.sarea.includes( areaSelected));
  }

  matchedStore = matchedStore.sort((a, b) => b.sbi - a.sbi);
  matchedStore.forEach(store => {
    [str, storeCount] = createHTML(store, str, storeCount);
  })
  document.getElementById('store-total').innerHTML = `總共搜尋到 ${storeCount} 個站點。`;
  document.getElementById('store-list').innerHTML = str;
  // 地圖自動定位至該縣市／鄉鎮市區。
  if(areaSelected) {
    map.setView([matchedStore[0].lat, matchedStore[0].lng], 14);
  }
  const storeInfoEl = document.querySelectorAll('.store-info');
  storeInfoEl.forEach(storeEl => {
    storeEl.addEventListener('click', function() {
      map.setView([storeEl.dataset.lat, storeEl.dataset.lng], 19);
   })    
  })
}

// 刪除陣列中的特定數值或字串。
function removeByValue(array, value) {
  return array.forEach((item, index) => {
    if(item === value) {
      array.splice(index, 1);
    }
  })
}




function onMapClick(e) {
  // 標記點擊區域
  marks.clearLayers();   dis=Math.round(myLocation.distanceTo(e.latlng)/1000*1000)/1000;
  var mark = L.marker(e.latlng)
    .addTo(map)
    .bindPopup("你與該位置的距離為 " + dis +"KM")
    .openPopup();
  var latlngs = [myLocation, e.latlng];
  var polyline = L.polyline(latlngs, { color: "red" }).addTo(map);
  marks.addLayer(mark);
  marks.addLayer(polyline);
}
map.on("click", onMapClick);