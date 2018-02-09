<style>
.round{
    border-radius: 50px;
}
.setMarginTop{
    margin-top: 15px;
}

</style>
<template>
 <div>
    <div class="d-block m-x-auto" v-bind:disabled="loading">
        <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
        <p v-show="loading">Please wait...</p>
    </div>
    <!--CARD-->
    <div class="card setMarginTop" v-for="posts of data.posts">
        <div class="card-body">
            <img :src="posts.image" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
            <p class="card-text">Book: {{ posts.title }}</p>
            <p class="card-text">Author: {{ posts.author }}</p>
            <p class="card-text">Year published: {{ posts.year }}</p>
            <p class="card-text">Description: {{ posts.description }}</p>
        </div>
        <div>
            <span class="btn-outline-primary" v-for="cat of posts.get_category">  {{ cat.name }} </span>
          
        </div>
        <div class="card-footer">
           <small class="text-muted">Last updated 3 mins ago</small>
           <div class="pull-right">
             <button type="button" class="btn btn-outline-primary round"><i class="fa fa-pencil" aria-hidden="true"></i></button>
             <button type="button" class="btn btn-outline-danger round"><i class="fa fa-trash" aria-hidden="true"></i></button>
           </div>
        </div>
    </div>
    <!--END OF CARD-->
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
                loading: true
            }
        },
        mounted(){  
            setTimeout(() => {  
                 this.initData();
            },2000)
        },
        methods: {
            initData() {
                Vue.axios.get('/view').then((res) => {
                        this.data.posts = res.data.posts;
                        this.loading = false;
                })
            },
            updateList() {
                this.initData();
            }
        }

    }
</script>