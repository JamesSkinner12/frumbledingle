class Items {
    static all() {
        return axios.get('/api/items').then(function (result) {
            return result.data;
        });
    }

    static delete(itemId) {
        return axios.delete('/api/items/' + itemId).then(function (result) {
            return result.data;
        });
    }

    static create(input) {
        return axios.post('/api/items', input).then(function (result) {
            return result.data;
        });
    }
}

export default Items;