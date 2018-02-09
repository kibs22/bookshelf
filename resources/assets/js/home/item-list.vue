<style lang="sass">

ul.paginate-links
  list-style-type: none
  padding: 0


ul.paginate-links > li
  display: inline-block
  margin: 0 10px


</style>

<template>
<div>
    <div class="d-block m-x-auto" v-bind:disabled="loading">
        <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
        <p v-show="loading">Please wait...</p>
    </div>
    <div class="women">
        <a href="#"><h4>Total Items - <span>{{ total }}</span> </h4></a>
        <ul class="w_nav">
            <li>Sort : </li>
            <li><a href="#"  @click="sortNewLowest()">Low </a></li> |
            <li><a href="#" @click="sortNewHighest()"> High </a></li> 
            <div class="clearfix"> </div>	
            </ul>
            <div class="clearfix"> </div>	
    </div>
    <div class="row"><div class="col-md-12" style="height:15px;"></div></div>
        <paginate
        name="posted"
        :list="data.samplePost.posts"
        :per="9"
        v-if="data.samplePost"
        >
            <div class="col-md-4"  v-for="posts in paginated('posted')" >
                <div class="panel panel-primary">
                    <div class="panel-heading" ></div>
                    <div class="panel-body" style="height:250px;">
                        <router-link :to="{ name: 'viewItem', params: { id: posts.id }}">
                            <img src="images/cbook.jpg" alt=" " v-if="!posts.image" :width="100" :height="100">
                            <img :src="posts.image" style="width:100%;" :height="100" alt="" v-if="posts.image">
                        </router-link>
                        <div>
                            <p><b>{{ posts.title }}</b></p>
                            <p class="card-text">Author: {{ posts.author }}</p>
                            <p class="card-text">Price: {{ posts.price }}</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div v-if="posts.seller_id == $auth.user().id">
                                <router-link class="btn btn-success btn-block" :to="{ path: '/profile'}">Edit</router-link>
                            </div>
                            <div v-else>
                                <router-link class="btn btn-success btn-block" :to="{ name: 'viewItem', params: { id: posts.id } }">Buy</router-link>
                            </div>
                    </div>
                </div>
            </div>
        </paginate>
       
        <div class="col-md-4" style="margin-left:300px !important ;margin-top:0; !important">
            <div class="clearfix"> </div>	
            <paginate-links for="posted" :async="true"  class="btn btn-default" >
            </paginate-links>
        </div>
</div>
</template>

<script>
    export default{
        props:{
            query: {
                'type': String,
                'default': ''
            },

            shit: {
                'type': String,
                'default': ''
            },
            
            'route-id':{
                type: Number
            }
        },
        data(){
            return {
                data:{
                    user: {},
                    posts:{},
                    categories: {},
                    samplePost: null,
                },
                total:null,
                loading: true,
                paginate: ['posted'],

            }
        },
        mounted(){ 
                setTimeout(() => {  
                    // this.initDataByCategory()
                    this.initData();
                },2000)
        },
        methods: {
            initData() {
                Vue.axios.get('/getallpost', {params: {q:this.query}} ).then((res) => {
                        this.data.posts = res.data.posts;
                        this.data.samplePost = res.data;
                        this.total = res.data.total;
                        //console.log(this.data.posts);
                        this.loading = false;
                        
                })
            },
            bookSearch() {
                Vue.axios.get('/getallpost', {params: {q:this.query}} ).then((res) => {
                        this.data.posts = res.data.posts;
                        this.data.samplePost = res.data;
                        this.total = res.data.total;
                        //console.log(this.data.posts);
                        this.loading = false;
                        
                })
            },
            initDataByCategory(){
                 Vue.axios.get('/getallpost', {params: {cat :this.shit }} ).then((res) => {
                        this.data.posts = res.data.posts;
                        this.data.samplePost = res.data;
                        this.total = res.data.total;
                        //console.log(this.data.posts);
                        this.loading = false;
                        
                })
            },
            updateList(){
                //this.refresh()
                this.initData()
                //this.$emit('user-posted')
            },
            updateListByCategory(){
                this.refresh()
                this.initDataByCategory()
            },
            refresh(){
                setTimeout(()=> {
                    this.loading = false 
                },2000)
            }, 
            sortNewHighest(){
                Vue.axios.post('/sortLow', this.data.samplePost.posts)
                .then((res) => {
                     this.data.posts = res.data.posts;
                        this.data.samplePost = res.data;
                        this.total = res.data.total;
                        //console.log(this.data.posts);
                        this.loading = false;
                })
            },
            sortNewLowest(){

                 Vue.axios.post('/sortHigh', this.data.samplePost.posts)
                .then((res) => {
                     this.data.posts = res.data.posts;
                        this.data.samplePost = res.data;
                        this.total = res.data.total;
                        //console.log(this.data.posts);
                        this.loading = false;
                })

            }
        },
        watch: {
            query(val) {
                console.log(val)
                if(val != ''){
                     this.updateList()
                }else{
                    return;
                }     
            },
            shit(val){
                if(val != ''){
                    this.updateListByCategory()
                }
                
            }
        }

    }
</script>