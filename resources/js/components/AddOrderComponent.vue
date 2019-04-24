<template>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-10 m-auto">

                <form @submit.prevent="addOrder">

                    <div v-if="messages.length" class="alert alert-success alert-dismissible fade show" role="alert">
                        <p v-for="message in messages" :key="message.index">{{ message }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="">Add Item: </label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" v-model="item">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Quantity:</label>
                        <div class="col-md-7 d-flex">
                            <button type="button" class="btn btn-secondary btn-number qty-btn" @click="qtyDec">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" class="form-control input-number qty-txt" v-model="quantity">
                            <button type="button" class="btn btn-secondary btn-number qty-btn" @click="qtyInc">
                                <i class="fas fa-plus"></i>
                            </button>
                            <p style="font-size: 12pt;" class="mt-auto mb-auto ml-1">Kg</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Category: </label>
                        <div class="col-md-7">
                            <select v-model="category" id="" class="custom-select form-control">
                                <option value="live">Live</option>
                                <option value="fresh">Fresh</option>
                                <option value="frozen">Frozen</option>
                                <option value="dried">Dried</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Classification: </label>
                        <div class="col-md-7">
                            <select v-model="classification" id="" class="custom-select form-control">
                                <option value="fish">Fish</option>
                                <option value="roe">Roe</option>
                                <option value="crustaceans">Crustaceans</option>
                                <option value="molluscs">Molluscs</option>
                                <option value="echinoderms">Echinoderms</option>
                                <option value="medusozoa">Medusozoa</option>
                            </select>
                        </div>
                    </div>

                   <div class="row mt-3 justify-content-center">
                        <div class="col-md-10">
                            <button @click="addItem" type="button" class="btn btn-secondary float-right">Add Item</button>
                        </div>
                   </div>

                   <div class="row mt-3 justify-content-center">
                       <div class="col-md-8">
                           <div v-if="errors.length" class="alert alert-danger mt-3">
                                <strong v-for="error in errors" :key="error.index">{{ error }}</strong>
                            </div>
                       </div>
                   </div>

                    <div class="mt-3" v-if="items.length">
                        <div class="row">
                            <table class="mt-3 mb-3 table table-striped table-responsive-md">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Classification</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in items" :key="item.index">
                                        <td>{{ item.item }}</td>
                                        <td>{{ item.quantity }}Kg</td>
                                        <td>{{ item.category }}</td>
                                        <td>{{ item.classification }}</td>
                                        <td>
                                            <a href="#" class="text-danger" @click.prevent="removeItem(items,'item',item.item)"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label for="" class="col-md-4 col-form-label text-md-right">Additional Info / descriptions: </label>
                            <div class="col-md-7">
                                <textarea v-model="description" id="" col="5" row="10" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label for="" class="col-md-4 col-form-label text-md-right">Bid end date: </label>
                            <div class="col-md-7">
                                <input type="datetime-local" class="form-control" id="datetimepicker" v-model="bidEndDate">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <input type="submit" class="btn btn-primary mt-3" value="Place Order">
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
            item: "",
            quantity: 0,
            category: "",
            classification: "",
            description: "",
            bidEndDate: "",
            items: [],
            messages: [],
            errors: [],
        }
    },
    methods: {
        qtyInc() { this.quantity++; },
        qtyDec() { this.quantity--; },

        addItem() {

            this.errors = [];

            if(!this.item) {

                this.errors.push("Item is required.");

            } else if (!this.quantity) {

                this.errors.push("Quantity is required.");

            } else if(!this.category) {

                this.errors.push("Category is required.");

            } else if(!this.classification) {

                this.errors.push("Classification is required.");

            } else if (this.items.length >= 3) {

                this.errors.push("Cannot add more than 3 items.");

            } else {

                this.items.push({
                    item: this.item,
                    quantity: this.quantity,
                    category: this.category,
                    classification: this.classification
                });

                 this.clearForm();
            }
        },
        addOrder() {

            this.messages = [];

            axios({
            method: 'post',
                url: '/api/order',
                data: {
                    items: this.items,
                    description: this.description,
                    bidEndDate: this.bidEndDate
                }
            })
            .then(response => {

                this.messages.push(response.data);
                this.items = [];
                this.description = "";
                this.bidEndDate = "";

            })
            .catch(err => {

                console.log(err);

            })

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

            this.item = "";
            this.quantity = "";
            this.category = "";
            this.classification = "";
            this.bidEndDate = "";

        }
    }
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
    width: 55px;
}
</style>
