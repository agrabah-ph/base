<template>
    <div class="mt-4">
        <div class="form-group row">
            <label for="province" class="col-md-4 col-form-label text-md-right">Province</label>
            <div class="col-md-6">
                <select id="province" v-model="province" class="form-control" @change="selectProvince">
                    <option value="provincetrial">trial</option>
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
                :center="{lat:14.156581, lng:121.499842}"
                :zoom="7"
                map-type-id="terrain"
                style="width: 100%; height: 300px"
                >
                <GmapMarker ref="myMarker"
                    :position="google &&
                    new google.maps.LatLng(1.38, 103.8)" />
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
            provinces: [],
            municipalities: [],
            barangays: []
        }
    },
    mounted() {
        // this.$refs.mapRef.$mapPromise.then((map) => {
        //     map.panTo({lat: 1.38, lng: 103.80})
        // })
    },
    methods: {
        selectProvince() {
            console.log(this.province);
        },
        selectMunicipality() {
            console.log(this.municipality);
        },
        selectBarangay() {
            console.log(this.barangay);
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
