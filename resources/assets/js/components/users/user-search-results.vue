<style>
.setTopMargin{
    margin-top: 10px;
}
.setMarginLeft{
    margin-right:5px;
}

</style>
<template>
<div>
    <div class="card">
        <div>
            <form>
                <div class="form-row" style="padding:5px 5px 5px 5px">
                    <div class="col-7">
                        <input class="form-control" type="text" v-model="data.search" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-3">
                         <select class="custom-select mb-2 mr-sm-2 mb-sm-0 form-control">
                            <option>Programming</option>
                            <option>Science</option>
                            <option>History</option>
                            <option>Math</option>
                            <option>Health</option>
                         </select>
                    </div>
                    <div class="col" style="margin-top:-7px;">
                        <button class="btn btn-outline-success" @click="search"><span class="fa fa-search"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card setTopMargin">
          <div class="d-block m-x-auto" v-bind:disabled="loading">
            <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
            <p v-show="loading">Please wait...</p>
        </div>
        
        <div class="card-body" style="overflow-y:scroll; height:700px;">
                <!--CARD-->
            <div class="row">
                <div class="col-4 setTopMargin"  v-for="posts of data.posts">
                    <div class="card" style="height:100% !important ">
                        <div class="card-body">
                            <img :src="posts.image" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
                            <p class="card-text">Book: {{ posts.title }}</p>
                            <p class="card-text">Price: {{ posts.price }}</p>
                        </div>
                        <div>
                            <span class="btn-outline-primary" v-for="cat of posts.get_category">  {{ cat.name }} </span>
                        </div>

                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                            <div class="pull-right">
                            <router-link :to="{ name: 'post-details', params: { id: posts.id }}" class="btn btn-success ">View</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!--END OF CARD-->
            </div>
        </div>
    </div>
</div>


</template>

<script>
export default{
    props: {
    'route-id': {
            type: Number
        },
   },
    data(){
        return {
            data: {
                posts:{}
            },
            loading:true
        }
    },
    methods: {
        search(){
            this.loading = true;
            Vue.axios.post('/search',this.data)

            .then((r)=>{
               setTimeout(() => {  
                     this.data.posts  = r.data.data;
                     this.loading = false;
                },2000)
               
            })
        },
        initData(){
            Vue.axios.get('/getallpost')

            .then((r)=> {
                this.data.posts = r.data.posts;
                this.loading = false;
            })
        },
        refresh(){
            setTimeout(()=> {
                this.loading = false 
            },2000)
        }
    },
    mounted(){
      
       setTimeout(() => {  
            this.initData();
        },2000)
    }
}
</script>