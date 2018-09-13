<template id="post-edit">
    <div>
        <h3>Add new Post</h3>
        <form v-on:submit.prevent = "updatePost">
            <div class="form-group">
                <label for="edit-title">Title</label>
                <input id="edit-title" v-model="post.title" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="edit-body">Body</label>
                <textarea class="form-control" rows="10" v-model="post.body"></textarea>
            </div>
            <button type="submit" class="btn btn-xs btn-primary">Create Post</button>
            <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Cancel</router-link>
        </form>
    </div>
</template>

<script>
    export default{
        data: function () {
            return {
                post: {title: '', body: ''}
            }
        },
        created: function(){
            axios({method: 'get', url: '/posts/'+this.$route.params.id + '/edit', headers: { Authorization: "Bearer " +  localStorage.getItem('token') }}).then((response) => {
                this.post = response.data;
            });
        },
        methods: {
            updatePost: function() {
                axios({method: 'patch', url: '/posts/'+this.$route.params.id, headers: { Authorization: "Bearer " +  localStorage.getItem('token') }, data: this.post}).then((response) => {
                    this.$router.push({name: 'Listposts'})
                })
            }
        }
    }
</script>