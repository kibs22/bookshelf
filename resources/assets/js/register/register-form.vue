<template>
<div>
     <form> 
        <div class="col-md-7">
            <div class="panel panel-primary">
            <div class="panel-heading"><h3>PERSONAL INFORMATION</h3></div>
            <div class="panel-body">
                <bs-input v-model="data.firstname" :error="errors.firstname" type="text" id="firstname" label="Firstname" input-class="input-sm"></bs-input>
            
                <bs-input v-model="data.MI" :error="errors.MI" type="text" id="MI" label="Middle Initial" input-class="input-sm"></bs-input>

                <bs-input v-model="data.lastname" :error="errors.lastname" type="text" id="lastname" label="Lastname" input-class="input-sm"></bs-input>

                <bs-input v-model="data.address" :error="errors.address" type="text" id="address" label="Address" input-class="input-sm"></bs-input>

                <bs-input v-model="data.mobile" :error="errors.mobile" type="text" id="mobile" label="Mobile" input-class="input-sm"></bs-input>
                
                <bs-file v-model="data.image" :error="errors.image" id="year" label="userimage" ></bs-file>
            </div>
        </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-primary">
            <div class="panel-heading"><h3>LOGIN INFORMATION</h3></div>
            <div class="panel-body">
                    <bs-input v-model="data.email" :error="errors.email" type="email" id="email" label="Email" input-class="input-sm"></bs-input>

                    <bs-input v-model="data.password" :error="errors.password" type="password" id="password" label="Password" input-class="input-sm"></bs-input>

                    <bs-input v-model="data.password_confirmation" :error="errors.password" type="password" id="password_confirmation" label="Confirm Password" input-class="input-sm"></bs-input>

                    <button class="btn btn-danger" @click.prevent="register()" :disabled="loading" >
                        <i class="fa fa-spinner fa-sm fa-spin" style="font-size: 50px;" v-show="loading"> </i>SIGN UP 
                    </button>
                
            </div>
        </div>
        </div>
    </form>
</div>
</template>

<script>
const link = 'http://localhost:8000/';
export default{
	
	 props:{

	 },
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
                image:null,
                role_type:null
            },
            loading:false,
            formData: new FormData(),    
            errors: {}
        }
    },
    methods: {
        register() {
            this.loading = true;
            this.$swal({
                title: 'Register?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            })
            .then(()=>{
                 Vue.axios.post('register',this.formData)
                .then((response) => {
                    this.$swal({
                            title: 'Success!',
                            text: 'Successfully registered!',
                            type: 'success'
                        })
                        
                        .then(()=>{
                            this.$router.push({name:'login'})
                        })
                })
                .catch(d => {
                    
                    this.loading = false
                    this.errors = d.response.data
                    // console.log(Object.keys(d.response.data))
                    // console.log()
                    // console.log(typeof d) 
                })
            })
            .catch(this.$swal.noop) 
        },
        
        updateModel(value) {
                this.$emit('input', value)
        },
    },
    watch: {
        'data.firstname' (val) {
            this.formData.set('firstname', val);
        },
        'data.MI' (val) {
            this.formData.set('MI', val);
        },
        'data.lastname' (val) {
            this.formData.set('lastname', val);
        },
        'data.address' (val) {
            this.formData.set('address', val);
            // this.formData.set('title', val);
        },
        'data.mobile' (val) {
            this.formData.set('mobile', val);
        },
        'data.image' (val) {
            this.formData.set('image', val);
        },
        'data.email' (val) {
            this.formData.set('email', val);
        },
        'data.password' (val) {
            this.formData.set('password', val);
        },
        'data.password_confirmation' (val){
            this.formData.set('password_confirmation',val);
        },
        'data.role_type' (val){
            this.formData.set('role_type', 'NORMAL');
        }
    }
}
</script>