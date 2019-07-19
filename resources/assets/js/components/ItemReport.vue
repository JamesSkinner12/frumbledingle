<template>
    <div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Reporter</h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <form @submit.prevent="updatePrice">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="priceInput">Price</label>
                                            <input v-model="priceInput" min="0" type="number" class="form-control"
                                                   id="priceInput" placeholder="$0">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
            </div>


            <div class="col-md-8 col-sm-12">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <td>Location</td>
                    <td>Parent Category</td>
                    <td>Category</td>
                    <td>Count</td>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td>{{ item.locationName }}</td>
                        <td>{{ item.categoryParent }}</td>
                        <td>{{ item.categoryName }}</td>
                        <td>{{ item.itemCount }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "item-report",
        data: function () {
            return {
                priceInput: 0.00,
                items: [],
            }
        },
        mounted() {

        },
        methods: {
            updatePrice: function () {
                axios.post('/api/reports/items', {price: this.priceInput})
                    .then(result => {
                        this.items = result.data;
                    })
                    .catch(console.err);
            }
        }
    }
</script>

<style scoped>

</style>