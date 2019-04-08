<template>
    <div class="container mt-3 mb-3">
        <div class="form-group">
            <select v-model="province" id="" class="form-control" @change="fetchMunicipalities(province)">
                <option v-for="province in provinces" :key="province.id" :value="province.provCode">{{ province.provDesc }}</option>
            </select>
        </div>
        <div class="form-group">
            <select v-model="municipality" class="form-control" @change="fetchBarangays(municipality)">
                <option v-for="municipality in selectedProvince" :key="municipality.id" :value="municipality.citymunCode">{{ municipality.citymunDesc }}</option>
            </select>
        </div>
        <div class="form-group">
            <select v-model="barangay" class="form-control" @change="getCoords">
                <option v-for="barangay in selectedMunicipality" :key="barangay.id" :value="barangay.brgyDesc"> {{ barangay.brgyDesc }} </option>
            </select>
        </div>
        <div class="map">
            <GmapMap
                ref="myMarker"
                :center="{lat:14, lng:123}"
                :zoom="7"
                map-type-id="terrain"
                style="width: 500px; height: 300px"
            >
            <GmapMarker ref="myMarker"
                :position="google && new google.maps.LatLng(14, 123)"
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
        }
    },
    created() {
        this.fetchProvince();
    },
    methods: {
        fetchProvince() {

            fetch('/api/province')
            .then( res => res.json())
            .then( data => {

                console.log(data);
                this.provinces = data.provinces

            })
            .catch(err => console.log(err))
        },

        fetchMunicipalities(code) {

            fetch(`api/municipality/${code}`)
            .then( res => res.json() )
            .then( data => {

                this.municipalities = data.municipalities;

            })
        },

        fetchBarangays(code) {

            fetch(`api/barangay/${code}`)
            .then( res => res.json() )
            .then( data => {
                this.barangays = data.barangays;

            });

        },
        getCoords() {

            // Vue.$geocoder.setDefaultMode('address');      // this is default
            // var addressObj = {
            //     address_line_1: this.barangay,
            //     address_line_2: '',
            //     city:           '',
            //     state:          '',               // province also valid
            //     zip_code:       '',            // postal_code also valid
            //     country:        'PH'
            // }
            // Vue.$geocoder.send(addressObj, response => { console.log(response) });
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
