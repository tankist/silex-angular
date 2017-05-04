<template>
    <section id="app-default-index">
        <h1>{{ title }}</h1>
        <ul class="nav nav-pills">
            <li>
                <router-link :to="{ name: 'index' }">Index</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'list' }">Items List</router-link>
            </li>
        </ul>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                title: 'Index'
            }
        }
    }
</script>
