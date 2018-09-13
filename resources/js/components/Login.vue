<template>
    <div>
        <form @submit.prevent="login">
            <h2>Login</h2>
            <input v-model="email" type="text"  name="email" placeholder="Email Address" required autofocus />
            <input v-model="password" type="password"  name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login(){
                axios.post('/login',{email:this.email,password:this.password})
                    .then((response)=>{
                       //console.log(response);
                        let token= response.data.token;
                        if(token){
                            localStorage.setItem('token',token);
                            localStorage.setItem('userId',response.data.userId);
                            this.$router.push({ name: 'Listposts'})
                        }
                    })
            }
        }
    }
</script>
