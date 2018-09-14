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
                    <th>USER</th>
                    <th>Post Title</th>
                    <th>Post Body</th>
                    <th>Like</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th class="col-md-2">Actions</th>
                </tr>

            </thead>
            <tbody>
                <tr v-for="(post, index) in filteredPosts">
                    <td>{{ index + 1 }}</td>
                    <td>{{ post.user_name}}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.body }}</td>
                    <td>
                        <form @submit.prevent="likeIt(post.id)" v-bind:id="post.id">
                            <p v-bind:id="post.id">{{post.likes}}</p>
                            <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-thumbs-o-up"></i> like</button>
                        </form>
                    </td>
                    <td>{{ post.created_at }}</td>
                    <td>{{ post.updated_at }}</td>
                    <td>
                        <router-link class="btn btn-info btn-xs" v-bind:to="{name: 'Viewpost', params: {id: post.id}}"><i class="fa fa-eye" aria-hidden="true"></i> Show</router-link>
                        <router-link v-if="post.action == true" class="btn btn-warning btn-xs" v-bind:to="{name: 'Editpost', params: {id: post.id}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</router-link>
                        <router-link v-if="post.action == true" class="btn btn-danger btn-xs" v-bind:to="{name: 'Deletepost', params: {id: post.id}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</router-link>
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
                //userID: null,
                log: false
            };
        },
        methods: {
            fetchIt(){
                this.loading = true;
                axios({method: 'get', url: 'posts',headers: { Authorization: "Bearer " +  localStorage.getItem('token') }}).then((response) => {
                    this.posts = response.data;
                    console.log(response.data);
                });
            },
            likeIt(postID) {
                axios({method: 'POST', url: 'like',headers: { Authorization: "Bearer " +  localStorage.getItem('token') }, data:{'postId':postID}})
                    .then((response)=>{
                        this.like = {'post':response.data[0].post_id,'count':response.data.length};
                        console.log(response.data);
                        document.getElementById(response.data[0].post_id).innerHTML = response.data.length;
                    })
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
            this.fetchIt();
            this.userID = localStorage.getItem('userId');
            if(localStorage.getItem('token') === null) {
                this.log = true;
            }
        }
    }
</script>