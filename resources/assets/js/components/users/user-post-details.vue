 <style>
body,html{
     background-image: url('../../../sass/images/background.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    width: 100%;
    height: auto;
}
.setMargin{
    margin-left: 10px;
    margin-top: 10px;
    
}
.setTopMargin{
    margin-top: 10px;
}
.setMarginLeft{
    margin-left:8px;
}

</style>
<template>
<div>
    <div>
       <user-navbar></user-navbar>
    </div>

    <div class="container-fluid">
      <div class="row">
            <div class="col-8 setTopMargin">
                 <!--CARD-->
                <div class="card setMarginTop" v-for="d of details">
                    <div class="card-body">
                        <img :src="d.item.image" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
                    </div>
                </div>
                <!--END OF CARD-->
            </div>

            <div class="col-4 setTopMargin">
              <!-- card-->
               <div class="card">
                   <div class="card-body" v-for="d of details">
                        <p class="card-text">Book: {{ d.item.title }}</p>
                        <p class="card-text">Author: {{ d.item.author }}</p>
                        <p class="card-text">Year published: {{ d.item.year }}</p>
                        <p class="card-text">Description: {{ d.item.description }}</p>   
                   </div>
                   <div class="card-footer">
                        <button class="btn btn-primary btn-block">Chat with seller</button>
                   </div>
               </div>
               <!--end of card-->

                <div class="card setTopMargin">
                   <div class="card-header bg-success" style="padding:3px 3px 3px 3px;"></div>
                   <p class="text-center"> Meet the seller</p>
                   <div class="card-body" v-for="d of details">
                        <div class="text-center">
                            <img src="images/default_avatar_female.png" width="50" height="50" class="d-inline-block align-top rounded-circle" alt="">
                            <b style="margin-left:4px;">{{ d.seller.fullname }}</b>
                        </div>
                   </div>
               </div>

               <div class="card setTopMargin">
                   <div class="card-header bg-warning" style="padding:3px 3px 3px 3px;"></div>
                   <p class="text-center"> Related Books</p>
                   <div class="card-body">
                         <div>
                            <img src="images/java.jpg" width="100" height="100" class="setMarginLeft align-top"  style="margin-right:15px;" alt="">
                            <img src="images/swiftbook.jpg" width="100" height="100" class="setMarginLeft align-top" style="margin-right:15px;" alt="">
                            <img src="images/cbook.jpg" width="100" height="100" class="setMarginLeft align-top"  alt="">
                        </div>
                   </div>
               </div>

            </div>            
        </div>
    </div>

    <div class="footer" style="padding:20px 20px 20px 20px;"></div>
</div>
</template>

<script>
    export default{
        props:{

        },
        data() {
            return {
                id:null,
                details: {}
            }
        },
        components : {
        'user-navbar' : require('../users/user-navbar.vue'),
        'user-profile' : require('../users/user-card.vue'),
        },
        created(){
            this.id = this.$route.params.id;
            this.initData();
        },
        methods:{
            initData(){
                Vue.axios.post('viewSpecificDetails',{id: this.id})
                
                .then((r)=>{
                    this.details = r.data.data
                })
            }
        }

    }
</script>
