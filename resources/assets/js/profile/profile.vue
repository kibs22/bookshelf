<style>
.card{
    padding:10px 10px 10px 10px;
}
.nav-item{
    margin-top: 5px;
}
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}
.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

</style>
<template>
  <div>
      <div class="card" style="width: 24rem; height:60%; margin: auto;  ">
        <img :src="$auth.user().image" class="mx-auto rounded d-block img-rounded img-fluid " alt="" style="height:200px; ">
        <div class="card-body">
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                {{ $auth.user().fullname }}
              </div>
              <div>Email :
                {{ $auth.user().email }}
              </div>
              <div>Mobile :
                  {{ $auth.user().mobile }}
              </div>
              <div> Address :
                  {{ $auth.user().address }}
              </div>
			    	</div>
        </div>

        <div class="profile-usermenu">
            <ul class="nav flex-column">
                <li>
                    <button type="button" class="btn btn-danger btn-block" style="margin-top:20px;left:-10px;"  data-toggle="modal" data-target="#userModal" @click="profileDetails()">Edit</button>
                </li>
            </ul>
        </div>

       <!-- The Modal -->
           <div id="userModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                     <bs-input v-model="data.firstname" :value="data.firstname" :error="errors.firstname" type="text" id="firstname" label="Firstname" input-class="input-sm"></bs-input>
      
                    <bs-input v-model="data.MI" :value="data.MI" :error="errors.MI" type="text" id="MI" label="Middle Initial" input-class="input-sm"></bs-input>

                    <bs-input v-model="data.lastname" :value="data.lastname" :error="errors.lastname" type="text" id="lastname" label="Lastname" input-class="input-sm"></bs-input>

                    <bs-input v-model="data.address" :value="data.address" :error="errors.address" type="text" id="address" label="Address" input-class="input-sm"></bs-input>

                    <bs-input v-model="data.mobile" :value="data.mobile" :error="errors.mobile" type="text" id="mobile" label="Mobile" input-class="input-sm"></bs-input>
                    
                    <bs-input v-model="data.email" :error="errors.email" type="email" id="email" label="Email" input-class="input-sm"></bs-input>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success" data-dismiss="modal" @click="update()" :disabled="loading"> <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>  Update</button>
                  </div>
                  </div>

              </div>
          </div>
      </div>
  </div>
</template>


<script>
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
            formData: new FormData(),   
            loading: false, 
            errors: {}
        }
    },
    methods: {
        update() {
            

            this.$swal({
                title: 'Update?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            })
            .then(()=>{
                
                this.loading = true;
                Vue.axios.put('http://localhost:8000/api/userUpdate/'+this.$auth.user().id, this.data)
                .then((response) => {
                    this.loading = false;
                    this.$swal({
                            title: 'Success!',
                            text: 'Successfully updated!',
                            type: 'success'
                        })
                    .then(()=> {
                       
                    })
                      
                })
                .catch(d => {
                    this.loading = false;
                    this.errors = d.response.data
                    // console.log(Object.keys(d.response.data))
                    // console.log()
                    // console.log(typeof d) 
                })
            })
            
            .catch(this.$swal.noop) 
             
        },
        profileDetails(){
          this.data = this.$auth.user()
        }
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
        'data.email' (val) {
            this.formData.set('email', val);
        },
        'data.password' (val) {
            this.formData.set('password', val);
        },
        'data.role_type' (val){
            this.formData.set('role_type', 'NORMAL');
        }
    }
}
</script>