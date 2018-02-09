<template>
  <div>
    <div class="msg-wrap">
        
        <div class="row">
            
             <div class="d-block m-x-auto" v-bind:disabled="loading">
                <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
                <p v-show="loading">Please wait...</p>
            </div>

            <div class="col-md-3">
                <p class="thread-title">Inbox</p>
            </div>
            <div class="col-md-3 col-md-offset-6" v-show="loading == false">
                 <div class="form-group">
                    <label class="form-control-label" >Posts</label>
                    <select  class="form-control" v-model="option" style="height:30px"  v-on:change="filter($event.target.value)">
                        <option value="" selected disabled>Select a post</option>
                        <option :value="null" :selected="null">all</option>
                        <option  v-for="(p, index) in post" :value="p.id" :selected="p.id" >{{p.name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="msg even" v-if="data.messages.length !=  0" v-for="m of data.messages" v-show="loading == false">
            <div class="col-md-3 author" >
                <div class="row">
                    <div class="col-3">
                        <img :src="m.image" alt=" " :height="50">
                    </div>
                    <div class="col-5">
                        <router-link :to="{name:'message-user-thread',query: { c: m.conversation_id }}" class="media-heading">{{ m.name }} </router-link>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                {{ m.book }}
            </div>
            <div class="clearfix"></div>
        </div>
        <div v-if="data.messages.length ==  0">
            <div class="col-md-3 author" >
                <div class="row">
                    <b> No messages under this book </b>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
    export default {
        components : {
            'message-nav' : require('../message/message-nav.vue'),
            'message-thread' : require('../message/message-thread.vue'),
            'message-thread' : require('../message/message-navlinks.vue'),
        },
        data(){
            return {
                data: {
                    messages:null,
                    post: null
                    },
                    errors : {},
                    post: null,
                    option:null,
                    q: null,
                    loading: true
                }
        },
        
        mounted(){
            this.retrieveMessages(this.q)
            this.getPostsForFilter()
        },
        methods:{
            retrieveMessages(q){
                
                Vue.axios.get('/retrieveMessages', {params: {q: q}})

                .then((d)=>{
                    this.loading = false
                    this.data.messages = d.data.data;
                })

               
            },
            
            getPostsForFilter(){
                Vue.axios.get('/getPostsForFilter')

                .then((res)=>{
                    this.post = res.data.data
                })
            },

            filter(op){
               
                if(op != ''){
                   this.loading = true;
                     Vue.axios.get('/retrieveMessages', {params: {q: op}})

                        .then((d)=>{
                            this.loading = false
                            this.data.messages = d.data.data;
                        })
                }
                
                if(op == '')
                {
                  
                    this.retrieveMessages('');
                }
                   
               
            }
        }
    }
</script>
