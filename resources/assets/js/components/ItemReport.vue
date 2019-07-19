<template>
    <div>


        <form @submit.prevent="updatePrice">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="priceInput">Price</label>
                </div>
                <input v-model="priceInput" min="0.01" step="0.01" type="number" id="priceInput" class="form-control"
                       placeholder="0.01" required/>
                <div class="input-group-append">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <th>Location</th>
            <th>Parent Category</th>
            <th>Category</th>
            <th>Count</th>
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