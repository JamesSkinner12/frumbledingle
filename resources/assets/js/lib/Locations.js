class Locations {
    static all() {
        return axios.get('/api/locations').then(function (result) {
            return result.data;
        });
    }

    static delete(locationId) {
        return axios.delete('/api/locations/' + locationId).then(function (result) {
            return result.data;
        });
    }

    static create(input) {
        return axios.post('/api/locations', imput).then(function (result) {
            return result.data;
        });
    }
}

export default Locations;