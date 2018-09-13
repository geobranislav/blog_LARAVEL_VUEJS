<template>
    <div class="pull-left">
        <router-link class="btn btn-primary btn-lg" v-bind:to="{path: '/login'}">
            Login
        </router-link>
        <router-link class="btn btn-primary btn-lg" v-bind:to="{path: '/register'}">
            Register
        </router-link>
    </div>
</template>

<script>

    export default {
        data() {
            return {

            }
        }
    }
</script>

<style scoped>
    ul{
        list-style-type: none;
        text-align: center;
        margin: 0;
    }
    li{
        display: inline-block;
        margin: 0 10px;
    }
    a{
        color: #fff;
        text-decoration: none;
        padding: 6px 8px;
        border-radius: 10px;
    }
    nav{
        background: #444;
        padding: 14px 0;
        margin-bottom: 40px;
    }
    .router-link-active{
        background: #eee;
        color: #444;
    }
</style>