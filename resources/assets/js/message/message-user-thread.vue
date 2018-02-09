<style>
.card{
    padding:10px 10px 10px 10px;
}
.card-header{
    padding:5px 5px 5px 5px;
    background-color:firebrick;
    margin-top:-10px;
    margin-bottom: 10px;
    width: 100%;
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
    <!--header-->
    <navbar></navbar>
    <!--header-->
    <!--body-->
    <div class="container">
        <div class="women">
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <message-navlinks style=" margin-top: 15px;"></message-navlinks>
            </div>
            <div class="col-md-9">
                <div class="row"><div class="col-md-12" style="height: 15px;"></div></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-danger">
                                <div class="panel-heading"> <i class="fa fa-comments fa-lg "></i>CHAT BOX</div>
                            </div>
                            <div class="panel panel-body" style="overflow-y:scroll; height:400px;">
                                <div class="d-block m-x-auto" v-bind:disabled="loading">
                                    <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
                                    <p v-show="loading">Please wait...</p>
                                </div>
                                <ul class="chat">
                                    <div class="row" v-for="c of chat"> 
                                        <div class="col-md-6 pull-left" v-if="$auth.user().id == c.sender_id">
                                            <li class="clearfix" ><span class="chat-img pull-left">
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font"></strong> {{ $auth.user().firstname  }}
                                                    </div>
                                                    <p>
                                                       {{c.message}}
                                                    </p>
                                                </div>
                                            </li>
                                        </div>

                                        <div class="col-md-6 col-md-offset-6 " v-else>
                                             <li class=" clearfix" ><span class="chat-img">
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font">{{ chatting_with.firstname }}</strong>
                                                    </div>
                                                    <p>
                                                       {{c.message}}
                                                    </p>
                                                </div>
                                            </li>
                                        </div>

                                    </div>
                                </ul>
                            </div>
                            <div class="panel-footer" v-show="loading == false">
                                <div class="input-group" >
                                    <input id="btn-input" v-model="data.message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                    <span class="input-group-btn">
                                        <button  class="btn btn-warning btn-sm" id="btn-chat" @click.prevent ="send()">
                                            Send</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card" v-if="item" style="width: 24rem; margin-left: 50px; margin-bottom:10px  ">
                                <div class="card-header"></div>
                                <img :src="item.image" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
                                <div class="card-body">
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-job">
                                            {{ item.title }}
                                        </div>
                                        <div v-if="item.seller_id == $auth.user().id">
                                            <button class="btn btn-success btn-block" v-if="availability !='transacted' " @click="sell()">Sell</button>
                                            <span  v-if="availability != null "><b>Sold</b></span>
                                       </div>
                                       <div v-if="transaction_details != null">
                                           <div v-if="transaction_details[0].sold_to == chatting_with.id && transaction_details[0].flag == 'ongoing' ">
                                                    <button class="btn btn-danger btn-block" v-if="availability =='transacted' " @click="cancel(transaction_details[0].id)">Cancel</button>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="width: 24rem; margin-left: 50px;" v-if="chatting_with">
                                <div class="card-header"></div>
                                <img src="template/img/background.jpg" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
                                <div class="card-body">
                                    <div class="profile-usertitle">
                                        <h5 class="text-center">
                                            Currently chatting with
                                        </h5>
                                        <div>
                                            <b>{{ chatting_with.firstname }} {{ chatting_with.lastname }}</b>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
   </div>
   
    <!--body-->
    <!--footer-->
    <div class="container">
      <footers></footers> 
    </div>
    <!--footer-->
</div>
</template>

<script>
export default{
    components : {
                'message-nav' : require('../message/message-nav.vue'),
                'message-navlinks' : require('../message/message-navlinks.vue'),
    },
    data(){
        return {
            conversation:null,
            chat:null,
            chatting_with:null,
            item: null,
            data:{
                message:null
            },
            availability:null,
            interval: null,
            loading: true,
            transaction_details: null
        }
    },
    mounted() {
        this.conversation = this.$route.query.c;
        
        this.interval = setInterval(()=>{
            this.getDetails()

        },5000);

    },
    methods:{
        getDetails(){
            Vue.axios.get('/retrieveMessagesDuringChat', {params: {id :this.conversation}})
            .then((res)=>{
                this.loading = false
                this.chat = res.data.data
                this.chatting_with = res.data.conversation_with
                this.item = res.data.item[0]
                this.availability = res.data.is_transacted;
                this.transaction_details = res.data.transaction_details
            })
        },
        send(){
            
            Vue.axios.post('/sendMessage',{message:this.data.message, conversation_id: this.conversation, recipient_id: this.chatting_with.id})
            .then(()=>{
                this.data.message = null
                this.getDetails()
            })
        },
        sell(){
             this.$swal({
                title: 'sell to? \n'+this.chatting_with.firstname+' '+this.chatting_with.lastname,
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, sell it!'
            })

            .then(()=>{
                Vue.axios.post('/sell', { sold_to : this.chatting_with.id, posted_book_id: this.item.id })

                .then((res)=>{
                    if(res.data.success == true){
                        this.$swal({
                            title: 'sold to! \n'+this.chatting_with.firstname+' '+this.chatting_with.lastname,
                            type: 'success',
                        })
                    }
                })
            })

            .catch(this.$swal.noop)
        },
        cancel(t){
             this.$swal({
                title: 'are you sure you want to cancel this transaction?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            })

            .then(()=>{
                Vue.axios.post('/setToCancel', { transaction_id : t })

                .then((res)=>{
                    if(res.data.success == true){
                        this.$swal({
                            title: 'complete!',
                            type: 'success',
                        })
                      this.getTransactions();
                    }
                })
            })

            .catch(this.$swal.noop)
        }
    },
    beforeDestroy(){
        clearInterval(this.interval)
       
    }
}
</script>