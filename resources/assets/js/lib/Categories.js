class Categories {
    static all() {
        return axios.get('/api/categories').then(function (result) {
            return result.data;
        });
    }

    static delete(categoryId) {
        return axios.delete('/api/categories/' + categoryId).then(function (result) {
            return result.data;
        });
    }

    static create(input) {
        return axios.post('/api/categories', {name: input.name, parent_id: input.parent_id}).then(function (result) {
            return result.data;
        });
    }
}

export default Categories;