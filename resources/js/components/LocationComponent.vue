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
                    <option value="trial">trial</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="barangay" class="col-md-4 col-form-label text-md-right">Barangay</label>
            <div class="col-md-6">
                <select v-model="barangay" id="barangay" class="form-control" @change="selectBarangay">
                    <option value="brgytrial"> trial</option>
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
                    new google.maps.LatLng(13.5250, 123.3486)" />
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
                    name: "Manila",
                    lat: 14.5995,
                    lng: 120.9842
                }
            ],
            municipalities: [],
            barangays: [],
            setLat: 13.5250,
            setLong: 123.3486,
        }
    },
    methods: {
        selectProvince(e) {

            var selectedProvince = e.target.value;

            for(let p of this.provinces) {

                if(p.name == selectedProvince) {

                    this.setLat = p.lat;
                    this.setLong = p.lng;

                }

            }

            this.pan(this.setLat, this.setLong);

            console.log(selectedProvince);

        },
        selectMunicipality() {

            console.log(this.municipality);

        },
        selectBarangay() {

            console.log(this.barangay);

        },

        pan(latCoo, longCoo) {

            //Dynamically pan after selecting a province
            this.$refs.mapRef.$mapPromise.then((map) => {

                map.panTo({lat: latCoo, lng: longCoo})

            });

        }
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
