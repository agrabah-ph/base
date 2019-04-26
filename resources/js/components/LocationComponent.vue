<template>
    <div>
        <div class="form-group row">
            <label for="province" class="col-md-4 col-form-label text-md-right" >Province</label>

            <div class="col-md-6">
                <select v-model="province"
                        name="province"
                        id="province"
                        class="custom-select form-control"
                        :class="province_error.length ? ' is-invalid': '' "
                        @change="fetchMunicipalities(province)"
                        required>

                    <option v-for="province in provinces"
                            :key="province.index"
                            :value="province.provCode">
                            {{ province.provDesc }}
                    </option>

                </select>

                <span class="invalid-feedback" role="alert" v-if="province_error.length">
                    <strong>{{ province_error }}</strong>
                </span>
            </div>

        </div>
        <div class="form-group row">
            <label for="municipality" class="col-md-4 col-form-label text-md-right">City / Municipality</label>

            <div class="col-md-6">
                <select v-model="municipality"
                        name="municipality"
                        id="municipality"
                        class="custom-select form-control"
                        :class="municipality_error.length ? ' is-invalid' : ''"
                        @change="fetchBarangays(municipality)"
                        required>

                    <option v-for="municipality in selectedProvince"
                            :key="municipality.index"
                            :value="municipality.citymunCode">
                            {{ municipality.citymunDesc }}
                    </option>

                </select>

                <span class="invalid-feedback" role="alert" v-if="municipality_error.length">
                    <strong>{{ municipality_error }}</strong>
                </span>
            </div>

        </div>
        <div class="form-group row">
            <label for="barangay" class="col-md-4 col-form-label text-md-right">Barangay</label>

            <div class="col-md-6">
                <select v-model="barangay"
                        name="barangay"
                        id="barangay"
                        class="custom-select form-control"
                        :class="barangay_error.length ? ' is-invalid' : '' "
                        @change="getCoords"
                        required>

                    <option v-for="barangay in selectedMunicipality"
                            :key="barangay.index"
                            :value="barangay.brgyCode">
                            {{ barangay.brgyDesc }}
                    </option>

                </select>

                 <span class="invalid-feedback" role="alert" v-if="barangay_error.length">
                    <strong>{{ barangay_error }}</strong>
                </span>
            </div>

        </div>
        <div class="form-group row">

            <label for="addln1" class="col-md-4 col-form-label text-md-right">Address Line</label>

            <div class="col-md-6">
                <input type="text" name="address_line" v-model="addressLine" id="addln1" class="form-control" :class="addln_error.length ? ' is-invalid' : ''" required>

                <span class="invalid-feedback" role="alert" v-if="addln_error.length">
                    <strong>{{ addln_error }}</strong>
                </span>
            </div>

        </div>
        <div class="map">
            <GmapMap
                id="map"
                ref="mapRef"
                map-type-id="terrain"
                :center="{lat:13.6218, lng:123.1948}"
                :zoom="10"
                :options="{
                    zoomControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    fullscreenControl: false,
                }"
            >
            <GmapMarker ref="myMarker"
                :position="google && new google.maps.LatLng(lat, lng)"
                :clickable="true"
                :draggable="true"
                @dragend="getLocation"
            />
            </GmapMap>
        </div>
        <input type="hidden" :value="lat" name="lat">
        <input type="hidden" :value="lng" name="lng">
    </div>
</template>

<script>

import {gmapApi} from 'vue2-google-maps';

export default {
    name: "locations",
    props: [
        'province_error',
        'municipality_error',
        'barangay_error',
        'addln_error'
        ],
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

            for(let p of this.provinces)
            {
                if(code == p.provCode)
                {
                    for(let m of p.cities_municipalities)
                    {
                        this.municipalities.push(m);
                    }
                }
            }

            this.barangay = "";
        },

        fetchBarangays(code) {

            for(let m of this.municipalities)
            {
                if(code == m.citymunCode)
                {
                    for(let b of m.barangays)
                    {
                        this.barangays.push(b);
                    }
                }
            }

        },

        getCoords() {

            var provname = "";
            var cityname = "";
            var brgyname = "";

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

            for(let b of this.barangays)
            {
                if(b.brgyCode == this.barangay)
                {
                    brgyname = b.brgyDesc
                }
            }

            Vue.$geocoder.setDefaultMode('address');
            var addressObj = {
                address_line_1: brgyname,
                address_line_2: '',
                city:           cityname,
                state:          provname,
                zip_code:       '',
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

                for(let res of response.results)
                {
                    for(let resAddressComponents of res.address_components)
                    {
                        var resLongName = resAddressComponents.long_name.toLowerCase();

                        for(let revprov of this.provinces)
                        {
                            if(revprov.provDesc.toLowerCase() == resLongName)
                            {
                                this.fetchMunicipalities(revprov.provCode);
                                this.province = revprov.provCode;
                            }
                        }
                    }
                }

                for(let newres of response.results)
                {
                    //AC = Address Components
                    for(let newresAC of newres.address_components)
                    {
                        //LN = Long Name
                        var newresLN = newresAC.long_name.toLowerCase();

                        for(let revmun of this.municipalities)
                        {
                            if(revmun.citymunDesc.toLowerCase() == newresLN)
                            {
                                this.fetchBarangays(revmun.citymunCode);
                                this.municipality = revmun.citymunCode;
                            }
                        }
                    }
                }

                for(let ares of response.results)
                {
                    for(let aresAC of ares.address_components)
                    {
                        var aresLN = aresAC.long_name.toLowerCase();

                        for(let revbrgy of this.barangays)
                        {
                            if(revbrgy.brgyDesc.toLowerCase() == aresLN)
                            {
                                this.barangay = revbrgy.brgyCode;
                            }
                        }
                    }
                }

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
#map {
    height: 300px;
    width: 80%;
    margin: auto;
    box-shadow: 0 0 12px #555555;
    border-radius: 3px;
    overflow: hidden;
}
</style>
