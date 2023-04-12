let storeCluster;
var x = 1;
var dis = 0;
var myLocation;
const getCityDatas = getXML( "https://raw.githubusercontent.com/Feitoengineer19/mask-map/master/CityCountyData.json"
);
//新北
const getNewTaipeiDatas = getXML(  "https://raw.githubusercontent.com/brianlin314/ubikejson/main/newtaipei.json"
);




var marks = new L.MarkerClusterGroup().add





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
Promise.all([getCityDatas, getNewTaipeiDatas]).then(resultDatas => {
  const cityDatas = resultDatas[0];
  const storeDatas = resultDatas[1];
  //const storeDatas1 = resultDatas[2];

  getToday();
  createAreaOption(cityDatas, '台北市');
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
function createAreaOption(cityData, citySelected,index) {
  const areaSelect = document.getElementById('area');
  const citySelectedObj = cityData.find(item => item.CityName.replace(/臺/g, '台') === citySelected);
  const areaArray = citySelectedObj.AreaList;

  var sectors=new Array();
  sectors[0]=[' 大安區 ',' 中正區 ' ,' 台大專區 '];
  sectors[1]=[' 東區 ',' 西區 ',' 南區 ',' 北區 ',' 西屯區 ',' 南屯區 ',' 北屯區 ',' 太平區 ',' 烏日區 '];	
  sectors[2]=[' 市區 '];	
  sectors[3]=[' 鼓山區 ',' 楠梓區 ',' 三民區 ',' 苓雅區 ',' 仁武區 ',' 前鎮區 ',' 左營區 ',' 小港區 '];
    
  let areaOptionHTML = `<option value="" selected disabled>請選擇鄉鎮市區</option>`;
  for(var i=0;i<sectors[index].length;i++){
					areaOptionHTML=areaOptionHTML+'<option value=i>'+sectors[index][i]+'</option>';
				}
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
 /* if(areaSelected) {
    map.setView([matchedStore[0].lat, matchedStore[0].lng], 14);
  }*/
  /*const storeInfoEl = document.querySelectorAll('.store-info');
  storeInfoEl.forEach(storeEl => {
    storeEl.addEventListener('click', function() {
      map.setView([storeEl.dataset.lat, storeEl.dataset.lng], 19);
   })    
  })*/
}

// 刪除陣列中的特定數值或字串。
function removeByValue(array, value) {
  return array.forEach((item, index) => {
    if(item === value) {
      array.splice(index, 1);
    }
  })
}