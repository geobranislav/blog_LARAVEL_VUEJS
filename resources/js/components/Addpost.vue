<template id="add-post">
    <div>
        <h3>Add new Post</h3>
        <form v-on:submit.prevent = "createPost">
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" @change="imageChange" />
            </div>
            <div class="form-group">
                <label for="add-title">Title</label>
                <input id="add-title" v-model="post.title" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="add-body">Body</label>
                <textarea class="form-control" rows="10" v-model="post.body"></textarea>
            </div>
            <button type="submit" class="btn btn-xs btn-primary">Create Post</button>
            <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Cancel</router-link>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                post: {title: '', body: '', image: ''},
                token: localStorage.getItem('token')
            }
        },
        methods: {
            createPost: function() {
                axios({method: 'POST', url: 'posts',headers: { Authorization: "Bearer " +  this.token }, data: this.post}).then((response) => {
                    this.$router.push({name: 'Listposts'})
                })
            },
            imageChange: function(e){
                console.log(e.target.files[0]);
                var fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.post.image = e.target.result;
                }
                console.log(this.post);

            }
        }
    }
</script>