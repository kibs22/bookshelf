<style>
body,html{
    width:100%;
    height:100%;
    background-image: url('../../sass/images/background.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.setmargin{
    margin-top:30px;
}

</style>

<template>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-3  setmargin">
            <b-card
                class="mb-2"
                title=""
                sub-title=""
                footer-variant='success'
                >

                <div class="text-center">
                    <img class="card-img-top img-fluid" src="template/img/logo.jpg" alt="Card image cap">
                </div>
                
                 <b-form>
                 
                    <bs-input v-model="data.email" :error="errors.email" type="email" id="email" label="Email" input-class="input-md"></bs-input>
                    <bs-input v-model="data.password" :error="errors.password" type="password" id="password" label="Password" input-class="input-md"></bs-input>
                    
                    <button class="btn btn-success btn-block" @click.prevent="login()" style="margin-left:1px;">Login</button>
                    
                 </b-form>  
                   <p style="font-size: 12px">Don't have an account yet?<router-link to="/register" style="margin-left:5px; text-decoration:underline; color:blue;">Sign-up</router-link></p>
            </b-card>
        </div>
    </div>
</div>
</template>

<script>

const link = 'http://localhost:8000/';
export default {
  
    data() {
        return {
            data: {
                password: null,
                email: null
            },
            errors: {}
           }
    },
   
    methods: {
        login() {
            this.$auth.login({
                data: this.data, // data: {} in Axios
                success: (res) => {

                    switch(res.data.user.role_type){
                        case 'ADMIN' : this.$router.push({'name' : 'adminprofile'}); break;
                        default: break;

                    }
                 
                   
                },
                error: (e) => {
                    this.errors = e.response.data
                },
                redirect: false,
                fetchUser: false
            });
            
        },
        
        updateModel(value) {
            this.$emit('input', value)
        },
    }
    
}

</script>