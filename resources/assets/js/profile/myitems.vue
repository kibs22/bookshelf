<style>
.round{
    border-radius: 50px;
}
.setMarginTop{
    margin-top: 15px;
}
#myModal{
    margin-top:15px;
}

</style>
<template>
<div>

    <div class="women col-11">
        <h3>MY BOOKS</h3>
        <div class="clearfix"> </div>	
        <div>
          <div class="d-block m-x-auto" v-bind:disabled="itemloading">
              <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="itemloading"></i>
              <p v-show="itemloading">Please wait...</p>
          </div>
        </div>

        <!--CARD-->
            <div v-if="data.posts">
                 <div class="card setMarginTop" v-for="posts of data.posts">
                    <div class="card-body">
                        <div class="row">
                                <div class="col-md-3">
                                        <img :src="posts.image" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
                                </div>
                                 <div class="col-md-9">
                                        <p><b>Title: </b> {{ posts.title }}</p>
                                        <p><b>Price: </b>   {{ posts.price }}</p>
                                        <p><b>Author: </b>  {{ posts.author }}</p>
                                        <p><b>Year published: </b>  {{ posts.year }}</p>
                                        <p v-if="posts.get_category.length > 0"><b>Category: </b> {{posts.get_category[0].name}} </p>
                                        <p><b>Description: </b>  {{ posts.description }}</p>
                                       
                                </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="button" v-if="posts.has_many_users_interested.length > 0 " class="btn btn-outline-danger round"  data-toggle="modal" data-target="#interestedPeopleModal" @click="interestedPeople(posts.has_many_users_interested, posts.is_transacted)"><i class="fa fa-users" aria-hidden="true"></i></button>
                            <button type="button" v-if="posts.is_transacted == null" class="btn btn-outline-primary round"  data-toggle="modal" data-target="#editModal" @click="getDetails(posts)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            <button type="button" v-if="posts.is_transacted == null" class="btn btn-outline-danger round" @click.prevent="deletePost(posts)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                     
                </div>
            </div>
          <!--END OF CARD-->
    </div>
    <!--MODAL-->
     <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <bs-input v-model="edit.title"  :error="errors.title" type="text" label="Title" input-class="input-md"></bs-input>
                <bs-input v-model="edit.price" :error="errors.price" type="number" label="Price" input-class="input-md"></bs-input>
                <bs-input v-model="edit.author" :error="errors.author" type="text" label="Author" input-class="input-md"></bs-input>
                <bs-input v-model="edit.year" :error="errors.year" type="text" label="Year" input-class="input-md"></bs-input>
              
                <div class="form-group" v-if="edit">
                    <label for="">Category</label>
                    <select class="form-control"  v-if="category && edit.get_category != null " v-model="edit.categories">
                       <option :value="edit.get_category[0].id" disabled> current category {{ edit.get_category[0].name }}</option>
                       <option value="" ></option>
                        <option v-for="q of category" :value="q.id"> {{q.name}} </option>
                    </select>
                </div>
                 <!-- <bs-select  v-model="edit.categories"
                            label="Category"
                            :error="errors.categories"
                            :options="category"
                            > </bs-select> -->
                <bs-text v-model="edit.description"  :error="errors.description" label="Description"></bs-text>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" @click.prevent="submit()" :disabled="loading" > <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i> Submit</button>
            </div>
            </div>

        </div>
    </div>


    <!--INTERESTED MODAL-->
     <div id="interestedPeopleModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary" v-for="i of interestedUsers">
                    <div class="panel-heading">
                      </div>
                    <div class="panel-body">
                        <img :src="i.interested_users_details.image" width="50" height="50" class="d-inline-block align-top rounded-circle" alt="">
                        {{i.interested_users_details.firstname}} {{i.interested_users_details.lastname}}
                        
                        <div v-if="soldTo != null">
                           
                             <b v-if="i.interested_users_details.id == soldTo.sold_to">SOLD TO THIS USER</b>
                        </div>
                       
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
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
        data(){
            return {
                data:{
                    user: {},
                    posts:{},
                    categories: {}
                },
                edit: {get_category:null},
                itemloading : true,
                loading: false,
                errors: {},
                interestedUsers:{},
                soldTo:null,
                category: null
            }
        },
        mounted(){  
            setTimeout(() => {  
                 this.initData();
            },1500),

            Vue.axios.get('/getCategory')
                .then((res)=>{
                    this.category = res.data.data
                })
        },
        methods: {
            initData() {
                Vue.axios.get('/viewUserItems').then((res) => {
                         this.itemloading = false;
                        this.data.posts = res.data.posts;
                      
                       
                })
            },
            updateList() {
               setTimeout(() => {  
                 this.initData();
                },1500)
            },
            getDetails(post){
                this.edit = post;
                console.log(this.edit)
            },
            deletePost(post){
                this.$swal({
                    title: 'Delete item?',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then(()=>{
                       
                    Vue.axios.get('/deletePost/'+post.id)
                    .then((res)=>{
                        this.loading = true;
                         this.updateList();
                    })
                })
                
            },
            submit(){
                
                 this.$swal({
                    title: 'Update Post?',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                })
                .then(()=>{
                    this.loading = true;
                    Vue.axios.put('updatePost/'+this.edit.id, this.edit )
                    .then((res)=>{

                        if(res.data.success === true){
                            this.$swal({
                            title: 'complete!',
                            type: 'success',
                            })
                            this.loading = false;
                            this.updateList()
                        }else{
                            
                            this.$swal({
                            title: 'No changes were made'
                            })
                            this.loading = false;
                        }
                        
                    })

                    .catch((e)=> {
                        this.loading = false;
                        this.errors = e.response.data
                    })

                })
                .catch(this.$swal.noop)
            },
            cancel(post){
                this.editable[post.id] = false
                console.log(this.editable)
                
                console.info(this.editable[post.id]);
            },
            interestedPeople(people, sold_to){
                
                this.interestedUsers = people;
                console.log(this.interestedUsers)
                this.soldTo = sold_to;
            
                
            }
        },
        watch: {
            'edit.title' (val){
                
            }
        }

    }
</script>
