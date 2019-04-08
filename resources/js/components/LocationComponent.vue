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
            provinces: [],
            municipalities: [],
            barangays: []
        }
    },
    methods: {
        fetchProvinces() {

        }
    }
}
</script>

<style scoped>
</style>
