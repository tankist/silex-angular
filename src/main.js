import Vue from 'vue'
import VueRouter from 'vue-router'

import App from './components/App.vue'
import SilexIndex from './components/silex/SilexIndex.vue'
import SilexList from './components/silex/SilexList.vue'
import SilexItem from './components/silex/SilexItem.vue'

Vue.use(VueRouter);

const routes = [
    { path: '/', component: SilexIndex, name: 'index' },
    { path: '/items', component: SilexList, name: 'list' },
    { path: '/item/:id', component: SilexItem, name: 'item', props: true }
];

const router = new VueRouter({
    routes: routes
});

new Vue({
    el: '#app',
    render: h => h(App),
    router
});
