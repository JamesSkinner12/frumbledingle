<template>
    <div>
        <form @submit.prevent="createCategory">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="categoryName">Name</label>
                </div>
                <input v-model="newCategory.name" type="text" id="categoryName" class="form-control"
                       placeholder="Category Name" required/>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="categoryParent">Parent</label>
                </div>
                <select class="custom-select" v-model="newCategory.parent_id" id="categoryParent">
                    <option value="null" selected>Parent</option>
                    <option v-for="parent in categories" v-bind:value="parent.id">{{ parent.name }}</option>
                </select>
            </div>
            <button class="btn btn-primary mb-3 float-right">Create</button>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td><span v-if="category.parent !== null">{{ category.parent.name }}</span></td>
                <td align="center">
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(category)">
                        <i class="fa fa-times"></i> Delete
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

    export default {
        name: "categories-table",
        data: function () {
            return {
                categories: [],
                newCategory: {
                    name: null,
                    parent_id: null
                }
            }
        },
        mounted() {
            this.getCategories();
        },
        methods: {
            getCategories: function () {
                Categories.all().then(result => {
                    this.categories = result;
                });
            },
            createCategory: function () {
                Categories.create(this.newCategory).then(result => {
                    Swal.fire(result);
                    if (result.type === 'success') {
                        this.getCategories();
                        this.newCategory = {
                            name: null,
                            parent_id: null
                        }
                    }
                });
            },
            deleteCategory: function (category) {
                Categories.delete(category.id).then(result => {
                    Swal.fire(result);
                    if (result.type === 'success') {
                        this.getCategories();
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>