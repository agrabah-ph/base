<template>
    <div class="mt-4">
        <div class="form-group row">
            <label for="province" class="col-md-4 col-form-label text-md-right">Province</label>
            <div class="col-md-6">
                <select id="province" v-model="province" class="form-control" @change="selectProvince">
                    <option v-for="p in provinces" :key="p.index">{{ p.name }}</option>
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
                    name: "Camarines Sur",
                    lat: 13.5250,
                    lng: 123.3486
                },
                {
                    name: "Albay",
                    lat: 13.1775,
                    lng: 123.5280
                },
                {
                    name: "NCR",
                    lat: 14.5995,
                    lng: 120.9842
                }
            ],
            municipalities: [
                {
                    name: "Nabua",
                    provinceOf: "Camarines Sur",
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
