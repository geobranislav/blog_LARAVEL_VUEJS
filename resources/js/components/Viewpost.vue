<template id="post">
    <div class="panel panel-info">
        <img :src="post.image">
        <div class="panel-heading">
            <strong>Title : </strong>
            <h3>{{ post.title }}</h3>
        </div>

        <div class="panel-body">
            <strong>Body : </strong>
            <div>
                {{ post.body }}
            </div>
        </div>
        <br/>
        <span class="glyphicon glyphicon-arrow-left"></span>
        <router-link v-bind:to="'/'">Back to post list</router-link>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                post: {title: '', body: ''}
            }
        },
        created: function(){
            axios({method: 'get', url: 'posts/'+this.$route.params.id, headers: { Authorization: "Bearer " +  localStorage.getItem('token') }}).then((response) => {
                this.post = response.data;
            });
        }
    }
</script>