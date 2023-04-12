import MySQLdb
import requests

html = requests.get(
    "https://apis.youbike.com.tw/api/front/station/all?lang=tw&type=2")
html.encoding = "utf-8"
data = eval(html.text)

x = 0
y = 0
area = []
conn = MySQLdb.connect(host="localhost", user="root",
                       passwd="", db="youbikedb", charset="utf8")
cursor = conn.cursor()

SQL = "CREATE TABLE IF NOT EXISTS chiayi(`index` bigint(100) NOT NULL AUTO_INCREMENT,`station_no` int(15) NOT NULL,`area_code` varchar(15) NOT NULL,`name_tw` varchar(50) NOT NULL, `district_tw` varchar(50)  NOT NULL,`address_tw` varchar(100) NOT NULL,`available_spaces` int(5) NOT NULL,`empty_spaces` int(5) NOT NULL,`lat` double NOT NULL,`lng` double NOT NULL,`updated_at` varchar(30) NOT NULL,PRIMARY KEY (`index`),KEY station_no (`station_no`))ENGINE=InnoDB DEFAULT CHARSET=utf8;"
cursor.execute(SQL)
conn.commit()

for value in data["retVal"]:
    area_code = value["area_code"]
    # type = value["type"]
    status = value["status"]
    station_no = value["station_no"]
    name_tw = value["name_tw"]
    district_tw = value["district_tw"]
    address_tw = value["address_tw"]
    # name_en = value["name_en"]
    # district_en = value["district_en"]
    # address_en = value["address_en"]
    # name_cn = value["name_cn"]
    # district_cn = value["district_cn"]
    # address_cn = value["address_cn"]
    # parking_spaces = value["parking_spaces"]
    available_spaces = value["available_spaces"]
    empty_spaces = value["empty_spaces"]
    # forbidden_spaces = value["forbidden_spaces"]
    lat = value["lat"]
    lng = value["lng"]
    # img = value["img"]
    updated_at = value["updated_at"]
    # time = value["time"]
    if area_code == "08":
        SQL = "INSERT INTO chiayi(station_no,area_code,name_tw,district_tw,address_tw,available_spaces,empty_spaces,lat,lng,updated_at) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        cursor.execute(SQL, (station_no, area_code, name_tw, district_tw, address_tw,
                       available_spaces, empty_spaces, lat, lng, updated_at))  # 資料寫入 table
conn.commit()
conn.close()
