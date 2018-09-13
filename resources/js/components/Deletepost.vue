<template id="post-delete">
    <div>
        <h3>Delete post {{ post.title  }}</h3>
        <form v-on:submit.prevent = "deletePost">
            <p>The action cannot be undone</p>
            <button class="btn btn-xs btn-danger" type="submit" name="button">Delete</button>
            <router-link class="btn btn-xs btn-primary" v-bind:to="'/'">Back</router-link>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                post: {body: '', title: ''}
            }
        },
        created: function(){

            axios({method: 'get', url: '/posts/'+this.$route.params.id + '/edit', headers: { Authorization: "Bearer " +  localStorage.getItem('token') }}).then((response) => {
                this.post = response.data;
            });
        },
        methods: {
            deletePost: function() {
                axios({method: 'delete', url: '/posts/'+this.$route.params.id, headers: { Authorization: "Bearer " +  localStorage.getItem('token') }, data: this.post}).then((response) => {
                    this.$router.push({name: 'Listposts'})
                })
            }
        }
    }
</script>