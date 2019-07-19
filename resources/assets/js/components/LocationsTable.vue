<template>
    <div>
        <form @submit.prevent="createLocation">

            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newLocationName.name" type="text" class="form-control" placeholder="Location Name"/>
                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>

        </form>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in locations" :key="row.id">
                <td>{{ row.id }}</td>
                <td>{{ row.name }}</td>
                <td align="center">
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteLocation(row.id)">
                        <i class="fa fa-times"></i> Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Locations from '../lib/Locations';
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
                locations: [],
                newLocationName: {name: null},
            };
        },
        mounted() {
            this.getLocations();
        },
        methods: {
            getLocations() {
                Locations.all().then(result => {
                    this.locations = result;
                }).catch(console.error);
            },
            createLocation() {
                Locations.create(this.newLocationName)
                    .then(result => {
                        Swal.fire(result);
                    })
                    .then(this.getLocations)
                    .then(() => this.newLocationName = {name: null})
                    .catch(console.error);
            },
            deleteLocation(id) {
                Locations.delete(id)
                    .then(result => {
                        Swal.fire(result)
                    })
                    .then(this.getLocations)
                    .catch(console.error);
            }
        }
    }
</script>

<style>
    .create-location-form {
        margin-bottom: 10px;
    }
</style>