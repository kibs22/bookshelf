<template>
 <div>  
        <div class="card">
            <div class="card-block">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <router-link :to="{name: 'message' }"><span class="badge pull-right">{{ data.inboxNumber }}</span> Inbox </router-link>
                    </li>
                </ul>

                <br>

             
            </div>
        </div>
 </div>
</template>

<script>
export default {
  mounted(){
    this.getInboxNumber();
    this.getPostsForFilter();   
  },
  data(){
    return {
      data: {
        inboxNumber:0,
        post: null
      },
      errors : {},
      post: null,
      option:null
    }
  },
  methods:{
      getInboxNumber(){
          Vue.axios.get('/inbox')
          .then((res)=>{
              this.data.inboxNumber = res.data.data;
          })
      },

      getPostsForFilter(){
          Vue.axios.get('/getPostsForFilter')

          .then((res)=>{
            this.post = res.data.data
          })
      },

      filter(){
        
      }
  }
}
</script>
