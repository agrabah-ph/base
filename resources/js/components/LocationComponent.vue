<template>
    <div>
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
        <div id="map"></div>
    </div>
</template>

<script>
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
        var map;
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
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
}
</script>

<style scoped>
#map {
    height:300px;
    width: 100%;
    border: 1px solid;
}
</style>
