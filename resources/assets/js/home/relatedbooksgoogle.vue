<template>
  <div>

      <div class="d-block m-x-auto" v-bind:disabled="loading">
        <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
        <p v-show="loading">Please wait...</p>
    </div>
      
      <div class="col-md-2" v-if="loading == false" v-for="r of data.items">
        <div class="panel panel-primary" style="height:210px;">
            <div class="panel-heading" style="font-size:10px">{{ r.volumeInfo.title }}</div>
            <div class="panel-body" style="min-height: 10; max-height: 10;">
                <div v-if="r.volumeInfo.imageLinks">
                    <img  :src="r.volumeInfo.imageLinks.smallThumbnail" :width="100" :height="100" >
                        <p v-for="a of r.volumeInfo.authors">
                        {{ a }}
                    </p>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
    export default {
        props: {
            title: String
        },

        mounted(){
            this.getGoogleBooks()
        },
        data(){
            return{
                data : {
                    items: null,
                },
                 loading:true
            }
        },
        methods:{
            getGoogleBooks(){
                    Vue.axios.get('/getRelatedByGoogle',{params : {q: this.title,  }})
                    .then((res)=>{
                        this.data.items = res.data.items;
                        this.loading = false
                    })
                },
        },
        watch : {
            'title' (val) {
                this.title = val
                this.loading = true
                this.getGoogleBooks()
            }
        }
    }
</script>

