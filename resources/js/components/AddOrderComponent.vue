<template>
    <div class="card-body">
        <div class="row m-auto">
            <div class="col-md-8 m-auto p-3">
                <form @submit.prevent="addOrder">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="">Add Item: </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" v-model="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Quantity:</label>
                        <div class="col-md-4 d-flex">

                            <button type="button" class="btn btn-secondary btn-number qty-btn" @click="qtyDec">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" class="form-control input-number qty-txt" v-model="quantity">
                            <button type="button" class="btn btn-secondary btn-number qty-btn" @click="qtyInc">
                                <i class="fas fa-plus"></i>
                            </button>
                            <p style="font-size: 12pt;" class="mt-auto mb-auto ml-1">KG</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Notes: </label>
                            <div class="col-md-6">
                            <textarea v-model="notes" id="" col="5" row="5" class="form-control"></textarea>
                        </div>
                    </div>

                   <div class="row mt-3">
                        <div class="col-md-10">
                            <button @click="addItem" type="button" class="btn btn-secondary float-right">Add Item</button>
                        </div>
                   </div>
                    <div class="row mt-3" v-if="items.length">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items" :key="item.index">
                                    <td>{{ item.name }}</td>
                                    <td>KG {{ item.quantity }}</td>
                                    <td>{{ item.notes }}</td>
                                    <td><button class="btn btn-danger" @click="removeItem(items,'name',item.name)">X</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md">
                            <input type="submit" class="btn btn-primary float-right" value="Place Order">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"Orders",
    data() {
        return {
            name: "",
            quantity: 0,
            notes: "",
            items: [],
            errors: []
        }
    },
    methods: {
        addItem() {

            this.errors = [];

            if(!this.name) {

                this.errors.push("blank");

            }
            else if (!this.quantity) {

                this.errors.push("Blank");

            }
            else {

                this.items.push({

                    name: this.name,
                    quantity: this.quantity,
                    notes: this.notes

                });

                this.clearForm();

            }

        },
        addOrder() {

            console.log(this.items);

        },
        qtyInc() {

            this.quantity++;

        },
        qtyDec() {

            this.quantity--;

        },
        removeItem(arr, attr, value) {

            var i = arr.length;
            while(i--){
                if( arr[i] && arr[i].hasOwnProperty(attr) && (arguments.length > 2 && arr[i][attr] === value )){

                        arr.splice(i,1);

                }
            }

            return arr;
        },

        clearForm() {
            this.name = "";
            this.quantity = "";
            this.notes = "";
        }
    },
}
</script>

<style scoped>
textarea {
    resize: none;
}
.qty-btn {
    border-radius: 0;

}
.qty-txt {
    border-radius: 0;
    width: 45px;
}
</style>
