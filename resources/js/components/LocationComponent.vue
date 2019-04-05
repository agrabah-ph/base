<template>
    <div class="mt-4">
        <div class="form-group row">
            <label for="province" class="col-md-4 col-form-label text-md-right">Province</label>
            <div class="col-md-6">
                <select id="province" v-model="province" class="form-control" @change="selectProvince">
                    <option v-for="p in provinces" :key="p.id" :value="p.id">{{ p.provDesc }}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="municipality" class="col-md-4 col-form-label text-md-right">Municipality</label>
            <div class="col-md-6">
                <select v-model="municipality" id="municipality" class="form-control" @change="selectMunicipality">
                        <option v-for="m in municipalities" :key="m.index" v-show="m.provinceOf == chosenProvince">
                            <span >{{ m.name }}</span>
                        </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="barangay" class="col-md-4 col-form-label text-md-right">Barangay</label>
            <div class="col-md-6">
                <select v-model="barangay" id="barangay" class="form-control" @change="selectBarangay">
                    <option v-for="b in barangays" :key="b.index" v-show="b.cityOf == chosenMunicipality">{{ b.name }}</option>
                </select>
            </div>
        </div>
        <div class="map">
            <GmapMap
                ref="mapRef"
                :center="{lat: 13.5250, lng: 123.3486 }"
                :zoom="7"
                map-type-id="terrain"
                style="width: 100%; height: 300px"
                >
                <GmapMarker ref="myMarker"
                    :position="google &&
                    new google.maps.LatLng(setLat, setLong)" />
            </GmapMap>
        </div>
    </div>
</template>

<script>
import * as VueGoogleMaps from 'vue2-google-maps';
import {gmapApi} from 'vue2-google-maps'

export default {
    name: "Locations",
    data() {
        return {
            province: "",
            municipality: "",
            barangay: "",
            provinces: [
                {
                "id":1,
                "psgcCode":"012800000",
                "provDesc":"ILOCOS NORTE",
                "regCode":"01",
                "provCode":"0128"
                },
                {
                "id":2,
                "psgcCode":"012900000",
                "provDesc":"ILOCOS SUR",
                "regCode":"01",
                "provCode":"0129"
                },
                {
                "id":3,
                "psgcCode":"013300000",
                "provDesc":"LA UNION",
                "regCode":"01",
                "provCode":"0133"
                },
                {
                "id":4,
                "psgcCode":"015500000",
                "provDesc":"PANGASINAN",
                "regCode":"01",
                "provCode":"0155"
                },
                {
                "id":5,
                "psgcCode":"020900000",
                "provDesc":"BATANES",
                "regCode":"02",
                "provCode":"0209"
                },
                {
                "id":6,
                "psgcCode":"021500000",
                "provDesc":"CAGAYAN",
                "regCode":"02",
                "provCode":"0215"
                },
                {
                "id":7,
                "psgcCode":"023100000",
                "provDesc":"ISABELA",
                "regCode":"02",
                "provCode":"0231"
                },
                {
                "id":8,
                "psgcCode":"025000000",
                "provDesc":"NUEVA VIZCAYA",
                "regCode":"02",
                "provCode":"0250"
                },
                {
                "id":9,
                "psgcCode":"025700000",
                "provDesc":"QUIRINO",
                "regCode":"02",
                "provCode":"0257"
                },
                {
                "id":10,
                "psgcCode":"030800000",
                "provDesc":"BATAAN",
                "regCode":"03",
                "provCode":"0308"
                },
                {
                "id":11,
                "psgcCode":"031400000",
                "provDesc":"BULACAN",
                "regCode":"03",
                "provCode":"0314"
                },
                {
                "id":12,
                "psgcCode":"034900000",
                "provDesc":"NUEVA ECIJA",
                "regCode":"03",
                "provCode":"0349"
                },
                {
                "id":13,
                "psgcCode":"035400000",
                "provDesc":"PAMPANGA",
                "regCode":"03",
                "provCode":"0354"
                },
                {
                "id":14,
                "psgcCode":"036900000",
                "provDesc":"TARLAC",
                "regCode":"03",
                "provCode":"0369"
                },
                {
                "id":15,
                "psgcCode":"037100000",
                "provDesc":"ZAMBALES",
                "regCode":"03",
                "provCode":"0371"
                },
                {
                "id":16,
                "psgcCode":"037700000",
                "provDesc":"AURORA",
                "regCode":"03",
                "provCode":"0377"
                },
                {
                "id":17,
                "psgcCode":"041000000",
                "provDesc":"BATANGAS",
                "regCode":"04",
                "provCode":"0410"
                },
                {
                "id":18,
                "psgcCode":"042100000",
                "provDesc":"CAVITE",
                "regCode":"04",
                "provCode":"0421"
                },
                {
                "id":19,
                "psgcCode":"043400000",
                "provDesc":"LAGUNA",
                "regCode":"04",
                "provCode":"0434"
                },
                {
                "id":20,
                "psgcCode":"045600000",
                "provDesc":"QUEZON",
                "regCode":"04",
                "provCode":"0456"
                },
                {
                "id":21,
                "psgcCode":"045800000",
                "provDesc":"RIZAL",
                "regCode":"04",
                "provCode":"0458"
                },
                {
                "id":22,
                "psgcCode":"174000000",
                "provDesc":"MARINDUQUE",
                "regCode":"17",
                "provCode":"1740"
                },
                {
                "id":23,
                "psgcCode":"175100000",
                "provDesc":"OCCIDENTAL MINDORO",
                "regCode":"17",
                "provCode":"1751"
                },
                {
                "id":24,
                "psgcCode":"175200000",
                "provDesc":"ORIENTAL MINDORO",
                "regCode":"17",
                "provCode":"1752"
                },
                {
                "id":25,
                "psgcCode":"175300000",
                "provDesc":"PALAWAN",
                "regCode":"17",
                "provCode":"1753"
                },
                {
                "id":26,
                "psgcCode":"175900000",
                "provDesc":"ROMBLON",
                "regCode":"17",
                "provCode":"1759"
                },
                {
                "id":27,
                "psgcCode":"050500000",
                "provDesc":"ALBAY",
                "regCode":"05",
                "provCode":"0505"
                },
                {
                "id":28,
                "psgcCode":"051600000",
                "provDesc":"CAMARINES NORTE",
                "regCode":"05",
                "provCode":"0516"
                },
                {
                "id":29,
                "psgcCode":"051700000",
                "provDesc":"CAMARINES SUR",
                "regCode":"05",
                "provCode":"0517"
                },
                {
                "id":30,
                "psgcCode":"052000000",
                "provDesc":"CATANDUANES",
                "regCode":"05",
                "provCode":"0520"
                },
                {
                "id":31,
                "psgcCode":"054100000",
                "provDesc":"MASBATE",
                "regCode":"05",
                "provCode":"0541"
                },
                {
                "id":32,
                "psgcCode":"056200000",
                "provDesc":"SORSOGON",
                "regCode":"05",
                "provCode":"0562"
                },
                {
                "id":33,
                "psgcCode":"060400000",
                "provDesc":"AKLAN",
                "regCode":"06",
                "provCode":"0604"
                },
                {
                "id":34,
                "psgcCode":"060600000",
                "provDesc":"ANTIQUE",
                "regCode":"06",
                "provCode":"0606"
                },
                {
                "id":35,
                "psgcCode":"061900000",
                "provDesc":"CAPIZ",
                "regCode":"06",
                "provCode":"0619"
                },
                {
                "id":36,
                "psgcCode":"063000000",
                "provDesc":"ILOILO",
                "regCode":"06",
                "provCode":"0630"
                },
                {
                "id":37,
                "psgcCode":"064500000",
                "provDesc":"NEGROS OCCIDENTAL",
                "regCode":"06",
                "provCode":"0645"
                },
                {
                "id":38,
                "psgcCode":"067900000",
                "provDesc":"GUIMARAS",
                "regCode":"06",
                "provCode":"0679"
                },
                {
                "id":39,
                "psgcCode":"071200000",
                "provDesc":"BOHOL",
                "regCode":"07",
                "provCode":"0712"
                },
                {
                "id":40,
                "psgcCode":"072200000",
                "provDesc":"CEBU",
                "regCode":"07",
                "provCode":"0722"
                },
                {
                "id":41,
                "psgcCode":"074600000",
                "provDesc":"NEGROS ORIENTAL",
                "regCode":"07",
                "provCode":"0746"
                },
                {
                "id":42,
                "psgcCode":"076100000",
                "provDesc":"SIQUIJOR",
                "regCode":"07",
                "provCode":"0761"
                },
                {
                "id":43,
                "psgcCode":"082600000",
                "provDesc":"EASTERN SAMAR",
                "regCode":"08",
                "provCode":"0826"
                },
                {
                "id":44,
                "psgcCode":"083700000",
                "provDesc":"LEYTE",
                "regCode":"08",
                "provCode":"0837"
                },
                {
                "id":45,
                "psgcCode":"084800000",
                "provDesc":"NORTHERN SAMAR",
                "regCode":"08",
                "provCode":"0848"
                },
                {
                "id":46,
                "psgcCode":"086000000",
                "provDesc":"SAMAR (WESTERN SAMAR)",
                "regCode":"08",
                "provCode":"0860"
                },
                {
                "id":47,
                "psgcCode":"086400000",
                "provDesc":"SOUTHERN LEYTE",
                "regCode":"08",
                "provCode":"0864"
                },
                {
                "id":48,
                "psgcCode":"087800000",
                "provDesc":"BILIRAN",
                "regCode":"08",
                "provCode":"0878"
                },
                {
                "id":49,
                "psgcCode":"097200000",
                "provDesc":"ZAMBOANGA DEL NORTE",
                "regCode":"09",
                "provCode":"0972"
                },
                {
                "id":50,
                "psgcCode":"097300000",
                "provDesc":"ZAMBOANGA DEL SUR",
                "regCode":"09",
                "provCode":"0973"
                },
                {
                "id":51,
                "psgcCode":"098300000",
                "provDesc":"ZAMBOANGA SIBUGAY",
                "regCode":"09",
                "provCode":"0983"
                },
                {
                "id":52,
                "psgcCode":"099700000",
                "provDesc":"CITY OF ISABELA",
                "regCode":"09",
                "provCode":"0997"
                },
                {
                "id":53,
                "psgcCode":"101300000",
                "provDesc":"BUKIDNON",
                "regCode":"10",
                "provCode":"1013"
                },
                {
                "id":54,
                "psgcCode":"101800000",
                "provDesc":"CAMIGUIN",
                "regCode":"10",
                "provCode":"1018"
                },
                {
                "id":55,
                "psgcCode":"103500000",
                "provDesc":"LANAO DEL NORTE",
                "regCode":"10",
                "provCode":"1035"
                },
                {
                "id":56,
                "psgcCode":"104200000",
                "provDesc":"MISAMIS OCCIDENTAL",
                "regCode":"10",
                "provCode":"1042"
                },
                {
                "id":57,
                "psgcCode":"104300000",
                "provDesc":"MISAMIS ORIENTAL",
                "regCode":"10",
                "provCode":"1043"
                },
                {
                "id":58,
                "psgcCode":"112300000",
                "provDesc":"DAVAO DEL NORTE",
                "regCode":"11",
                "provCode":"1123"
                },
                {
                "id":59,
                "psgcCode":"112400000",
                "provDesc":"DAVAO DEL SUR",
                "regCode":"11",
                "provCode":"1124"
                },
                {
                "id":60,
                "psgcCode":"112500000",
                "provDesc":"DAVAO ORIENTAL",
                "regCode":"11",
                "provCode":"1125"
                },
                {
                "id":61,
                "psgcCode":"118200000",
                "provDesc":"COMPOSTELA VALLEY",
                "regCode":"11",
                "provCode":"1182"
                },
                {
                "id":62,
                "psgcCode":"118600000",
                "provDesc":"DAVAO OCCIDENTAL",
                "regCode":"11",
                "provCode":"1186"
                },
                {
                "id":63,
                "psgcCode":"124700000",
                "provDesc":"COTABATO (NORTH COTABATO)",
                "regCode":"12",
                "provCode":"1247"
                },
                {
                "id":64,
                "psgcCode":"126300000",
                "provDesc":"SOUTH COTABATO",
                "regCode":"12",
                "provCode":"1263"
                },
                {
                "id":65,
                "psgcCode":"126500000",
                "provDesc":"SULTAN KUDARAT",
                "regCode":"12",
                "provCode":"1265"
                },
                {
                "id":66,
                "psgcCode":"128000000",
                "provDesc":"SARANGANI",
                "regCode":"12",
                "provCode":"1280"
                },
                {
                "id":67,
                "psgcCode":"129800000",
                "provDesc":"COTABATO CITY",
                "regCode":"12",
                "provCode":"1298"
                },
                {
                "id":68,
                "psgcCode":"133900000",
                "provDesc":"NCR, CITY OF MANILA, FIRST DISTRICT",
                "regCode":"13",
                "provCode":"1339"
                },
                {
                "id":69,
                "psgcCode":"133900000",
                "provDesc":"CITY OF MANILA",
                "regCode":"13",
                "provCode":"1340"
                },
                {
                "id":70,
                "psgcCode":"137400000",
                "provDesc":"NCR, SECOND DISTRICT",
                "regCode":"13",
                "provCode":"1374"
                },
                {
                "id":71,
                "psgcCode":"137500000",
                "provDesc":"NCR, THIRD DISTRICT",
                "regCode":"13",
                "provCode":"1375"
                },
                {
                "id":72,
                "psgcCode":"137600000",
                "provDesc":"NCR, FOURTH DISTRICT",
                "regCode":"13",
                "provCode":"1376"
                },
                {
                "id":73,
                "psgcCode":"140100000",
                "provDesc":"ABRA",
                "regCode":"14",
                "provCode":"1401"
                },
                {
                "id":74,
                "psgcCode":"141100000",
                "provDesc":"BENGUET",
                "regCode":"14",
                "provCode":"1411"
                },
                {
                "id":75,
                "psgcCode":"142700000",
                "provDesc":"IFUGAO",
                "regCode":"14",
                "provCode":"1427"
                },
                {
                "id":76,
                "psgcCode":"143200000",
                "provDesc":"KALINGA",
                "regCode":"14",
                "provCode":"1432"
                },
                {
                "id":77,
                "psgcCode":"144400000",
                "provDesc":"MOUNTAIN PROVINCE",
                "regCode":"14",
                "provCode":"1444"
                },
                {
                "id":78,
                "psgcCode":"148100000",
                "provDesc":"APAYAO",
                "regCode":"14",
                "provCode":"1481"
                },
                {
                "id":79,
                "psgcCode":"150700000",
                "provDesc":"BASILAN",
                "regCode":"15",
                "provCode":"1507"
                },
                {
                "id":80,
                "psgcCode":"153600000",
                "provDesc":"LANAO DEL SUR",
                "regCode":"15",
                "provCode":"1536"
                },
                {
                "id":81,
                "psgcCode":"153800000",
                "provDesc":"MAGUINDANAO",
                "regCode":"15",
                "provCode":"1538"
                },
                {
                "id":82,
                "psgcCode":"156600000",
                "provDesc":"SULU",
                "regCode":"15",
                "provCode":"1566"
                },
                {
                "id":83,
                "psgcCode":"157000000",
                "provDesc":"TAWI-TAWI",
                "regCode":"15",
                "provCode":"1570"
                },
                {
                "id":84,
                "psgcCode":"160200000",
                "provDesc":"AGUSAN DEL NORTE",
                "regCode":"16",
                "provCode":"1602"
                },
                {
                "id":85,
                "psgcCode":"160300000",
                "provDesc":"AGUSAN DEL SUR",
                "regCode":"16",
                "provCode":"1603"
                },
                {
                "id":86,
                "psgcCode":"166700000",
                "provDesc":"SURIGAO DEL NORTE",
                "regCode":"16",
                "provCode":"1667"
                },
                {
                "id":87,
                "psgcCode":"166800000",
                "provDesc":"SURIGAO DEL SUR",
                "regCode":"16",
                "provCode":"1668"
                },
                {
                "id":88,
                "psgcCode":"168500000",
                "provDesc":"DINAGAT ISLANDS",
                "regCode":"16",
                "provCode":"1685"
                }

            ],
            municipalities: [
                {
                    name: "Nabua",
                    provinceOf: "CAMARINES SUR",
                    lat: 13.5250,
                    lng: 123.3486
                },
                {
                    name: "Naga City",
                    provinceOf: "Camarines Sur",
                    lat: 13.5250,
                    lng: 123.3486
                },
                {
                    name: "Legazpi City",
                    provinceOf: "Albay",
                    lat: 13.1775,
                    lng: 123.5290
                },
                {
                    name: "Pasig City",
                    provinceOf: "NCR",
                    lat: 14.5764,
                    lng: 121.0851,
                }
            ],
            barangays: [
                {
                    name: "San Felipe",
                    cityOf: "Naga City",
                    lat: 13.5250,
                    lng: 123.3486
                },
                {
                    name: "Concepcion Grande",
                    cityOf: "Naga City",
                    lat: 13.5250,
                    lng: 123.3486
                },
                {
                    name: "Cabugao",
                    cityOf: "Legazpi City",
                    lat: 13.1775,
                    lng: 123.5290
                },
                {
                    name: "Rosario",
                    cityOf: "Pasig City",
                    lat: 14.5764,
                    lng: 121.0851,
                }
            ],
            setLat: 13.5250, //default
            setLong: 123.3486, //default
            chosenProvince: null,
            chosenMunicipality: null,
        }
    },
    methods: {
        selectProvince(e) {

            var selectedProvince = e.target.value;

            /**
             * Find the selected province
             * and pass on to the chosen province to filter
             * selected province and their municipalities/city
             */

            for(let p of this.provinces) {

                if(p.name == selectedProvince) {

                    this.chosenProvince = selectedProvince;

                }

            }

            this.geoCoder('PH', selectedProvince);
            console.log(selectedProvince);

        },
        selectMunicipality(e) {

            var selectedMunicipality = e.target.value;

            for(let m of this.municipalities) {

                if(m.name == selectedMunicipality) {

                    this.chosenMunicipality = selectedMunicipality;

                }

            }

            console.log(selectedMunicipality);

        },
        selectBarangay(e) {

            var selectedBrgy = e.target.value;

            for(let b of this.barangays) {

                if(b.name == selectedBrgy) {

                    this.setLat = b.lat;
                    this.setLong = b.lng;

                }

            }

            this.zoomIn(this.setLat, this.setLong);
            console.log(this.barangay);

        },

        zoomIn(latCoo, longCoo) {

            //Dynamically pan after selecting a province
            this.$refs.mapRef.$mapPromise.then((map) => {

                map.panTo({lat: latCoo, lng: longCoo})

            });

        },
        geoCoder(country, province) {

            Vue.$geocoder.setDefaultMode('address');

            var addressObj = {
                state:          province,
                country:        country
            }

            Vue.$geocoder.send(addressObj, response => {

                console.log(response)

                this.setLat = response.results[0].geometry.location.lat;
                this.setLong = response.results[0].geometry.location.lng;

                this.zoomIn(this.setLat, this.setLong);

                console.log(this.setLat + ", " + this.setLong);
             });
        }
    },
    created() {
        this.geoCoder('PH', '');
    },
    computed: {

        markerSize() {

            if (!this.googleMapsInitialized) return null
                return new window.google.maps.Size(10, 10)
        },

        markerIcon() {

            return {
                url: 'http://10.0.1.8:3000/img/icons/maps-marker.png',
                scaledSize: this.markerSize,
            }

        },

        google: gmapApi
    }
}
</script>

<style scoped>
.map {
    margin: 16px auto;
    border-radius: 3px;
    overflow: hidden;
    box-shadow: 0 0 8px #ccc;
    width: 500px;
}
</style>
