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
    margin-top:20px;
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
                     
                 <bs-input v-model="data.firstname" :error="errors.firstname" type="text" id="firstname" label="Firstname" input-class="input-sm"></bs-input>
                      
                 <bs-input v-model="data.MI" :error="errors.MI" type="text" id="MI" label="Middle Initial" input-class="input-sm"></bs-input>

                 <bs-input v-model="data.lastname" :error="errors.lastname" type="text" id="lastname" label="Lastname" input-class="input-sm"></bs-input>

                 <bs-input v-model="data.address" :error="errors.address" type="text" id="address" label="Address" input-class="input-sm"></bs-input>

                 <bs-input v-model="data.mobile" :error="errors.mobile" type="text" id="mobile" label="Mobile" input-class="input-sm"></bs-input>

                 <bs-input v-model="data.email" :error="errors.email" type="email" id="email" label="Email" input-class="input-sm"></bs-input>

                 <bs-input v-model="data.password" :error="errors.password" type="password" id="password" label="Password" input-class="input-sm"></bs-input>

                 <bs-input v-model="data.password_confirmation" :error="errors.password" type="password" id="password_confirmation" label="Confirm Password" input-class="input-sm"></bs-input>

                     <b-button variant="success" :block=true @click.prevent="register()">REGISTER</b-button>
                 </b-form>  
                  
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
                firstname:null,
                MI: null,
                lastname: null,
                mobile: null,
                address: null,
                password: null,
                email: null,
                password_confirmation: null,
            },
            
            errors: {}
        }
    },
    methods: {
        register() {
            Vue.axios.post(link+'register',this.data)
            .then((response) => {})

            .catch(d => {
                
                 this.errors = d.response.data
                // console.log(Object.keys(d.response.data))
                // console.log()
                // console.log(typeof d) 
            })
            .success(d => {
                console.log(d.data);
            })

        },
        
        updateModel(value) {
                this.$emit('input', value)
            },
    }
}

</script>