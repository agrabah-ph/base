<template>
    <div>
        <div class="responsiveTable" v-if="listData.length">
            <table class="col-md-12 table-striped table-condensed clearfix">
                <thead class="clearfix">
                    <tr>
                        <th>User Agent</th>
                        <th>Ip Address</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in paginatedData">
                        <td data-title="User Agent">{{ p.user_agent }}</td>
                        <td data-title="Ip Address" class="pr-2">{{ p.ip_address }}</td>
                        <td data-title="Date" nowrap>{{ p.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button :disabled="pageNumber === 0" @click="prevPage">Previous</button>
        <button :disabled="pageNumber >= pageCount-1" @click="nextPage">Next</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pageNumber: 0
        }
    },
    props: {
        listData: {
            type: Array,
            required: true
        },
        size: {
            type: Number,
            required: false,
            default: 3
        }
    },
    methods: {
        nextPage() {
            this.pageNumber++;
        },
        prevPage() {
            this.pageNumber--;
        }
    },
    computed: {
        pageCount() {
            let l = this.listData.length,
                s = this.size;
            return Math.ceil(l/s);
        },
        paginatedData() {
            const start = this.pageNumber * this.size,
                    end = start + this.size;
            return this.listData.slice(start, end);
        }
    }
}
</script>

<style scoped>
    table {
        margin-bottom: 0.5rem;
    }

    @media only screen and (max-width: 800px) {

        /* Force table to not be like tables anymore */
        .responsiveTable table,
        .responsiveTable thead,
        .responsiveTable tbody,
        .responsiveTable th,
        .responsiveTable td,
        .responsiveTable tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .responsiveTable thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        .responsiveTable tr { border: 1px solid #ccc; }

        .responsiveTable td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
            white-space: normal;
            text-align:left;
        }

        .responsiveTable td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align:left;
            font-weight: bold;
        }

        /*
        Label the data
        */
        .responsiveTable td:before { content: attr(data-title); }
        .responsiveTable table {
            padding: 0;
        }
    }
</style>

