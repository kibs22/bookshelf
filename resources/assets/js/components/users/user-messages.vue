<style>
body,html{
    background-image: url('../../../sass/images/background.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.setMargin{
    margin-left: 10px;
    margin-top: 10px;
    
}
.topMargin{
    margin-top: 10px;
},
.user-img-circle {
    border-radius: 50%;
}
</style>

<template>
<div>
    <div>
     <user-navbar></user-navbar>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-3">
          <user-profile class="setMargin"></user-profile>
        </div>

        <div class="col-9 mapMargin">
        <!-- collapse-->
            <div class="card topMargin" v-for="posts in data.posts">
                <div class="card" style="width: 100%;" height="50">
                <!--modal-card-->
                    <div class="row">
                        <div class="col-md-4">
                            <img class="card-img-top" :src="posts.image" alt="Card image cap">
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h4 class="card-title">{{posts.title }}</h4>
                                <p class="card-text">{{ posts.description }}</p>
                             </div>
                        </div>
                        <div class="col-md-4">
                            <div v-for="d in data.message">
                                <div v-if="posts.id == d.posted_id">
                                     <div class="topMargin ">
                                        <a @click="viewMessage(d)">
                                             <img class="rounded-circle border border-primary"  style="padding:2px 2px 2px 2px" :height="70" :width="70" :src="d.image" alt="Card image cap"> 
                                        </a>
                                         {{ d.fullname }}
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end of modal card-->
            </div>
        <!--end of collapse-->
        </div>
      </div>
    </div>

     <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="card" style="width: 100%;">
                <!--modal-card-->
                    <div>
                        <p> {{ modal.message.message }} </p>
                    </div> 
                </div>
                <!--end of modal card-->
                    <hr>
                    <bs-text v-model="data.message" :error="errors.message"  id="description" label="Message" input-class="input-sm"></bs-text>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" @click.prevent="sendMessage()"> Send </button>
            </div>
            </div>
        </div>
    </div>
    <!--end of modal-->
</div>
</template>
<script>
export default{
    components : {
            'user-navbar' : require('../users/user-navbar.vue'),
            'user-profile' : require('../users/user-card.vue'),
    
    },
    props:{
        name: null
    },
    mounted(){
        this.retrieveMessages()
    },
    data(){
        return{
            data: {
                message:{},
                posts: {}
            },
            modal:{
                message:{}
            },
        }
    },
    methods:{
      retrieveMessages(){
          Vue.axios.get('/retrieveMessages')

          .then((d)=>{

              this.data.message = d.data.data;
              
              this.data.posts = d.data.posted_books;
          })
      },
       viewMessage(m){
        this.modal.message = m;
        console.log(m)
        this.triggerModal();
      },
      triggerModal(){
        $("#detailsModal").modal('show');
      }
       
    }
}
</script>