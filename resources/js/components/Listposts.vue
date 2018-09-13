<template id="post-list">
    <div class="row">
        <app-Header v-if="log"></app-Header>
        <div class="btn btn-info btn-xs">logout</div>
        <div class="pull-right">
            <router-link class="btn btn-xs btn-primary" v-bind:to="{path: '/add-post'}">
                <span class="glyphicon glyphicon-plus"></span>
                Add new Post
            </router-link>
            </br></br>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Post Title</th>
                    <th>Post Body</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>User id</th>
                    <th class="col-md-2">Actions</th>
                </tr>

            </thead>
            <tbody>
                <tr v-for="(post, index) in filteredPosts">
                    <td>{{ index + 1 }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.body }}</td>
                    <td>{{ post.created_at }}</td>
                    <td>{{ post.updated_at }}</td>
                    <td>{{ post.user_id }}</td>

                    <td>
                        <router-link class="btn btn-info btn-xs" v-bind:to="{name: 'Viewpost', params: {id: post.id}}"><i class="fa fa-eye" aria-hidden="true"></i> Show</router-link>
                        <router-link v-if="post.user_id == userID" class="btn btn-warning btn-xs" v-bind:to="{name: 'Editpost', params: {id: post.id}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</router-link>
                        <router-link v-if="post.user_id == userID" class="btn btn-danger btn-xs" v-bind:to="{name: 'Deletepost', params: {id: post.id}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="log">
            <h1>morate se ulogovati!!!</h1>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue';
    export default {
        components: {
            'app-Header': Header,
        },
        data:function(){
            return {
                posts: {},
                userID: null,
                log: false
            };
        },
        methods: {
            fetchIt(){
                this.loading = true;
                axios({method: 'get', url: 'posts',headers: { Authorization: "Bearer " +  localStorage.getItem('token') }}).then((response) => {
                    this.posts = response.data;
                });
            }
        },
        computed: {
            filteredPosts: function(){
                if(this.posts.length) {
                    return this.posts;
                }
            }
        },
        created: function() {
            /*let uri = '/posts/';
            Axios.get(uri).then((response) => {
                this.posts = response.data;
            });*/
            this.fetchIt();
            this.userID = localStorage.getItem('userId');
            if(localStorage.getItem('token') === null) {
                this.log = true;
            }
        }
    }
</script>