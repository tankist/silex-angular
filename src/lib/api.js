export default {
    url: '/api.php/items',
    index: function () {
        return fetch(this.url).then(function (r) {
            return r.json();
        });
    },
    get: function (id) {
        return fetch(this.url + '/' + id).then(function (r) {
            return r.json();
        });
    },
    create: function () {
        return fetch(this.url, {method: 'POST'}).then(function (r) {
            return r.json();
        });
    },
    update: function (id, data) {
        return fetch(this.url + '/' + id, {method: 'PUT', body: JSON.stringify(data)}).then(function (r) {
            return r.json();
        });
    },
    remove: function (id) {
        return fetch(this.url + '/' + id, {method: 'DELETE'}).then(function (r) {
            return r.json();
        });
    }
};
