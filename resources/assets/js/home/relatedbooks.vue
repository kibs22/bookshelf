<template>
  <div>
    
    <div class="d-block m-x-auto" v-bind:disabled="loading">
        <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
        <p v-show="loading">Please wait...</p>
    </div>
    
    <div v-if="localrelated.length != 0">
        <div class="col-md-3"  v-for="l of localrelated">
            <div class="panel panel-danger" style="width:200px;">
                <div class="panel-heading" style="font-size:10px">{{ l.title }}</div>
                <div class="panel-body" style="min-height: 10; max-height: 10;">
                    <img :src="l.image" :width="100" :height="100" > 
                </div>
                <div class="panel-footer">
                    <router-link class="btn btn-sm btn-success btn-block"  :to="{ name: 'viewItem', params: { id: l.id }}">View</router-link>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
         <div class="col-md-12">
             <span class="alert alert-danger">No related books found</span>
         </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
      title: String,
      id: null
  },

  data(){
      return{
          localrelated:null,
          loading:true
      }
  },
  mounted(){
      this.getRelated()
  },
  methods:{
      getRelated(){
         
          Vue.axios.get('/related', {params: {q: this.title, id: this.id }})

          .then((res)=>{
              this.localrelated = res.data.books;
              this.loading = false
          })
         
      },
  },
  watch : {
      'title' (val) {
          this.title = val
          this.loading = true
          this.getRelated()
      }
  }

}
</script>

