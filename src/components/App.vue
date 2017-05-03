<template>
    <div id="app" class="container-fluid">
        <div class="row">
            <SilexHeader></SilexHeader>
        </div>

        <div class="row">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import SilexHeader from './silex/SilexHeader.vue'

    export default {
        name: 'app',
        components: {
            SilexHeader
        }
    }
</script>

<style lang="less">
    @import "../../node_modules/bootstrap/less/scaffolding";
    @import "../../node_modules/bootstrap/less/theme";
    @import "../../node_modules/bootstrap/less/type";
    @import "../../node_modules/bootstrap/less/navs";
    @import "../../node_modules/bootstrap/less/buttons";

    section {
        clear: both;
        margin-bottom: 10px;
    }
</style>
