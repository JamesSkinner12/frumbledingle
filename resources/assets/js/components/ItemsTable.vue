<template>
    <div>
        <form @submit.prevent="createItem">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="name">Name</label>
                </div>
                <input v-model="newItem.name" type="text" id="name" class="form-control"
                       placeholder="Item Name" required/>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="price">Price</label>
                </div>
                <input v-model="newItem.price" min="0" step=".01" type="number" id="price" class="form-control"
                       placeholder="0.00" required/>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category">Category</label>
                </div>
                <select class="custom-select" v-model="newItem.category" id="category" required>
                    <option v-for="category in categories" v-bind:value="category.id">{{ category.name }}</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="location">Location</label>
                </div>
                <select class="custom-select" v-model="newItem.location" id="location">
                    <option v-for="location in locations" v-bind:value="location.id">{{ location.name }}</option>
                </select>
            </div>

            <button class="btn btn-primary mb-3 float-right">Create</button>

        </form>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Location</th>
                <th>Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.category.name }}</td>
                <td>{{ item.location.name }}</td>
                <td>${{ item.price }}</td>
                <td align="center">
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteItem(item.id)"><i
                            class="fa fa-times"></i> Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import Swal from 'sweetalert2';
    import Categories from '../lib/Categories';
    import Locations from '../lib/Locations';
    import Items from '../lib/Items';

    export default {
        name: "items-table",
        data: function () {
            return {
                items: [],
                categories: [],
                locations: [],
                newItem: {
                    name: null,
                    price: 0.00,
                    category: null,
                    location: null
                }
            }
        },
        mounted() {
            this.getItems();
            Categories.all().then(result => {
                this.categories = result;
            });
            Locations.all().then(result => {
                this.locations = result;
            })
        },
        methods: {
            getItems: function () {
                Items.all().then(result => {
                    this.items = result;
                });
            },
            resetNewItem: function () {
                this.newItem = {
                    name: null,
                    price: 0.00,
                    category: null,
                    location: null
                }
            },
            createItem: function () {
                Items.create(this.newItem)
                    .then(result => {
                        Swal.fire("Item Created", "Item was created successfully!", "success");
                    })
                    .then(this.getItems)
                    .then(this.resetNewItem)
                    .catch(console.error);
            },
            deleteItem: function (itemId) {
                Items.delete(itemId).then(result => {
                    Swal.fire(result);
                }).then(this.getItems);
            }

        }
    }
</script>

<style scoped>

</style>