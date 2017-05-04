<template>
    <section id="app-item-view">
        <p>Item id: {{ item.id }}</p>
        <p>Item title: {{ item.title }}</p>

        <section>
            <button class="btn btn-primary" type="button" @click.prevent="updateItem(item.id)">Update Item</button>
        </section>

        <section>
            <button class="btn btn-danger" type="button" @click.prevent="deleteItem(item.id)">Delete Item</button>
        </section>
    </section>
</template>

<script>
    import Api from '../../lib/api'
    
    export default {
        props: ['id'],
        data: function () {
            return {
                item: {}
            };
        },
        methods: {
            getItem: function (id) {
                let self = this;
                Api.get(id).then(function (data) {
                    self.item = data;
                });
            },
            updateItem: function (id, item) {
                let self = this;
                Api.update(id, {item: item}).then(function (data) {
                    self.item = data;
                });
            },
            deleteItem: function (id) {
                let self = this;
                Api.remove(id).then(function (data) {
                    self.item = data;
                });
            }
        },
        created: function () {
            this.getItem(this.$props.id)
        }
    };
</script>
