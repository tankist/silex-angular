Vue.use(VueRouter);

var Api = {
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

var SilexIndex = Vue.component('silex-index', {
    template: '#silex-index'
});

var SilexList = Vue.component('silex-list', {
    template: '#silex-list',
    data: function () {
        return {
            items: []
        };
    },
    created: function () {
        this.getAllItems();
        this.title = 'List Items';
    },
    methods: {
        getAllItems: function () {
            var self = this;
            Api.index().then(function (data) {
                self.items = data;
            });
        },
        createItem: function () {
            var self = this;
            Api.create().then(function (data) {
                self.items.push(data);
            });
        }
    }
});

var SilexItem = Vue.component('silex-item', {
    template: '#silex-item',
    props: ['id'],
    data: function () {
        return {
            item: {}
        };
    },
    methods: {
        getItem: function (id) {
            var self = this;
            Api.get(id).then(function (data) {
                self.item = data;
            });
        },
        updateItem: function (id, item) {
            var self = this;
            Api.update(id, {item: item}).then(function (data) {
                self.item = data;
            });
        },
        deleteItem: function (id) {
            var self = this;
            Api.remove(id).then(function (data) {
                self.item = data;
            });
        }
    },
    created: function () {
        this.getItem(this.$props.id)
    }
});

var routes = [
    { path: '/', component: SilexIndex, name: 'index' },
    { path: '/items', component: SilexList, name: 'list' },
    { path: '/item/:id', component: SilexItem, name: 'item', props: true }
];

var router = new VueRouter({
    routes: routes
});

new Vue({
    el: '#body',
    data: {
        title: 'Index'
    },
    router: router
});