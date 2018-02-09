<template>
  <div>
      <div class="panel panel-danger">
        <div class="panel-heading center"><b >Suggestions</b></div>
        <div class="panel-body">
           <ul class="list-group" v-if="suggestions" v-for="s of suggestions">
                <li class="list-group-item"> 
                   <div class="row">
                       <div class="col-md-3">
                            <img :src="s.image" width="50" height="50" class="d-inline-block align-top rounded-circle" alt="">
                       </div>
                       <div class="col-md-5">
                           <p style="font-size:10px;"> {{ s.title }}</p>
                       </div>
                       <div class="col-md-4">
                           <router-link class="btn btn-success btn-sm" :to="{ name: 'viewItem', params: { id: s.id }}" ><span class="fa fa-arrow-circle-right"></span></router-link>
                       </div>
                   </div>
                </li>
           </ul>
        </div>
    </div>
     
  </div>    
</template>

<script >
export default {
  data(){
      return {
          suggestions:null
      }
  },
  mounted(){
      this.getSuggestions();
  },
  methods:{
      getSuggestions(){
         Vue.axios.get('/getSuggestions')
         .then((res)=>{
             this.suggestions = res.data.suggestions
         })
      }
  }
}
</script>

