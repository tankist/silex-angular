<template>
    <section id="app-item-list">
        <section>
            <button class="btn btn-primary" type="button" @click.prevent="createItem">Create Item</button>
        </section>
        <ol>
            <li v-for="item in items">
                <router-link :to="{ name: 'item', params: { id: item.id } }">Item #id {{ item.id }} | "{{ item.title
                    }}
                </router-link>
            </li>
        </ol>
    </section>
</template>

<script>
    import Api from '../../lib/api'

    export default {
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
                let self = this;
                Api.index().then(function (data) {
                    self.items = data;
                });
            },
            createItem: function () {
                let self = this;
                Api.create().then(function (data) {
                    self.items.push(data);
                });
            }
        }
    };
</script>
