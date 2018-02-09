<template>
    <div> 
		<div class="">
			<h3>REGISTERED USERS</h3>
				<p>If you have an account with us, please log in.</p>
				<div class="row">
					<div class="col-md-6">
						<form>
							<bs-input v-model="data.email" :error="errors.email" type="email" id="email" label="Email" input-class="input-md"></bs-input>
							<bs-input v-model="data.password" :error="errors.password" type="password" id="password" label="Password" input-class="input-md"></bs-input>          
							<button class="btn btn-danger" @click.prevent="login()" style="margin-left:1px;" :disabled="loading"><i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>LOGIN</button>
						</form>
					</div>
				</div>
			   </div>	
			    <div class="">
			  	 <h3>NEW USERS</h3>
				 <p>By creating an account with our site, you will be able to post a book into you account profile and find a potential buyer for your posted book.</p>
				  <router-link to="register" class="btn btn-danger"> Create an Account</router-link>
			</div>
		<div class="clearfix"> </div>
    </div>
</template>

<script>
const link = 'http://localhost:8000/';
export default {
	props:{

	 	},
  	data() {
        return {
            data: {
                password: null,
                email: null
            },
            loading:false,

            errors: {}
           }
    },
    mounted(){
        if(this.$auth.user().id){
             this.$router.replace({'name' : 'index'});
        }
    },
    methods: {
        login() {
            this.loading = true
            
            this.$auth.login({
                data: this.data, // data: {} in Axios
                success: (res) => {
                        
                        this.loading = false;
                        this.$swal({
                            title: 'Good day',
                            text: 'Login Success',
                            type: 'success'
                        })
                    
                    // setTimeout(()=> {
                    //     location.reload()
                    // },2000)
                    
                },
                error: (e) => {
                    console.log(e.response.data)
                     if(e.response.data.error_credentials){
                        
                        this.$swal({
                            title: '',
                            text: e.response.data.error_credentials,
                            type: 'warning'
                        })

                        .catch(this.$swal.noop)
                         
                     }

                  if(e.response.data.error) {
                   this.loading = false;
                        this.$swal({
                                title: '',
                                text: 'Your account is temporarily suspended',
                                type: 'warning'
                        })
                        
                        .catch(this.$swal.noop)
                         
                     }
                     this.loading = false;
                     this.errors = e.response.data
                }
            });
            
        },
        
        
        updateModel(value) {
            this.$emit('input', value)
        },
    }
    
}

</script>