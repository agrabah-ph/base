<template>
    <div class="container mt-3 mb-3">
        <div class="form-group row">
            <label for="province" class="col-md-4 col-form-label text-md-right">Province</label>
            <select v-model="province" name="province" id="province" class="col-md-6 custom-select form-control" @change="fetchMunicipalities(province)">
                <option v-for="province in provinces"
                        :key="province.id"
                        :value="province.provCode">
                        {{ province.provDesc }}
                </option>
            </select>
        </div>
        <div class="form-group row">
            <label for="municipality" class="col-md-4 col-form-label text-md-right">City / Municipality</label>
            <select v-model="municipality" name="municipality" id="municipality" class="col-md-6 custom-select form-control" @change="fetchBarangays(municipality)">
                <option v-for="municipality in selectedProvince"
                        :key="municipality.id"
                        :value="municipality.citymunCode">
                        {{ municipality.citymunDesc }}
                </option>
            </select>
        </div>
        <div class="form-group row">
            <label for="barangay" class="col-md-4 col-form-label text-md-right">Barangay</label>
            <select v-model="barangay" name="barangay" id="barangay" class="col-md-6 custom-select form-control" @change="getCoords">
                <option v-for="barangay in selectedMunicipality"
                        :key="barangay.id"
                        :value="barangay.brgyDesc">
                        {{ barangay.brgyDesc }}
                </option>
            </select>
        </div>
        <div class="form-group row">
            <label for="addln1" class="col-md-4 col-form-label text-md-right">Address Line 1</label>
            <input type="text" name="address_line_one" v-model="addressLine" id="addln1" class="col-md-6 form-control">
        </div>
        <div class="form-group row">
            <label for="addln2" class="col-md-4 col-form-label text-md-right">Address Line 2</label>
            <input type="text" name="address_line_two" v-model="addressLine2" class="col-md-6 form-control">
        </div>
        <div class="map">
            <GmapMap
                ref="mapRef"
                :center="{lat:13.6218, lng:123.1948}"
                :zoom="15"
                :options="{
                    zoomControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    fullscreenControl: false,
                    }"
                map-type-id="terrain"
                style="width: 80%; height: 300px; margin: auto;"
            >
            <GmapMarker ref="myMarker"
                :position="google && new google.maps.LatLng(lat, lng)"
                :clickable="true"
                :draggable="true"
                @dragend="getLocation"
            />
            </GmapMap>
        </div>
    </div>
</template>

<script>

import {gmapApi} from 'vue2-google-maps';
export default {
    name: "locations",
    data() {
        return {
            province: null,
            municipality: null,
            barangay: null,
            provinces: [],
            municipalities: [],
            barangays: [],
            lat: 13.6218,
            lng: 123.1948,
            addressLine: "",
            addressLine2: "",
        }
    },
    created() {

        this.fetchProvince();

    },
    methods: {

        fetchProvince() {

            axios.get('/api/province')
            .then( response => {

                this.provinces = response.data;

            })
            .catch(

                err => console.log(err)

            )
        },

        fetchMunicipalities(code) {

            axios.get('/api/municipality/' + code)
            .then( response => {

                this.municipalities = response.data

            })
            .catch(

                err => console.log(err)

            )
        },

        fetchBarangays(code) {

            axios.get('/api/barangay/' + code)
            .then( response => {

                this.barangays = response.data

            })
            .catch(

                err => console.log(err)

            )
        },

        getCoords() {

            var provname = "";
            var cityname = "";

            for(let p of this.provinces)
            {
                if(p.provCode == this.province)
                {
                    provname = p.provDesc
                }
            }

            for(let m of this.municipalities)
            {
                if(m.citymunCode == this.municipality)
                {
                    cityname = m.citymunDesc
                }
            }

            Vue.$geocoder.setDefaultMode('address');      // this is default
            var addressObj = {
                address_line_1: this.barangay,
                address_line_2: '',
                city:           cityname,
                state:          provname,               // province also valid
                zip_code:       '',            // postal_code also valid
                country:        'PH'
            }

            Vue.$geocoder.send(addressObj, response => {

                this.lat = response.results[0].geometry.location.lat;
                this.lng = response.results[0].geometry.location.lng;

                this.zoomIn(this.lat, this.lng);

            });

        },

        getLocation(place) {

            this.lat = place.latLng.lat();
            this.lng = place.latLng.lng();

            Vue.$geocoder.setDefaultMode('lat-lng');
            var LatLngObj = {

                lat: this.lat,
                lng: this.lng

            }
            Vue.$geocoder.send(LatLngObj, response => {

                this.addressLine = response.results[0].address_components[0].long_name;
                this.addressLine2 =  response.results[0].address_components[1].long_name;

                /*
                 *  Unfinished
                 */
            })

        },

        zoomIn(lat, lng) {

            this.$refs.mapRef.$mapPromise.then((map) => {

                map.panTo({lat: lat, lng: lng})

            });

        }
    },
    computed: {

        google: gmapApi,

        selectedProvince() {

            return this.municipalities.filter(code => code.provCode == this.province)

        },

        selectedMunicipality() {

            return this.barangays.filter(code => code.citymunCode == this.municipality)

        }
    }
}
</script>

<style scoped>

</style>
