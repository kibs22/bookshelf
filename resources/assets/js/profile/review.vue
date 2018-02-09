<template>
    <div >

        <div class="panel panel-success" v-if="reviews" v-for="r of reviews">
            <div class="panel-heading">
                 <img :src="r.reviewer.image" width="50" height="50" class="d-inline-block align-top rounded-circle" alt="">
                <b style="margin-left:4px; margin-top:20px;">{{ r.reviewer.firstname }} {{ r.reviewer.lastname }}</b>
               
            </div>
            <div class="panel-body" >
                <p>{{ r.content }}</p>
            </div>
        </div>
        <div class="row"><div style="height: 5px;"></div></div>

        <div class="panel panel-default" v-if="hasData == false">
            <div class="panel-heading">
                <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
                No reviews yet..
            </div>
        </div>
    </div>
 
</template>

<script>
export default {
  data() {
      return {
          reviews: null,
          hasData:false
      }
  },
  mounted(){
      this.getMyReviews()
  },
  methods:{
      getMyReviews(){
          Vue.axios.get('/myReviews')

          .then((res)=>{
              this.reviews = res.data.data
              if(this.reviews.length > 0){
                  this.hasData = true;
              }
          })
      }
  }
}
</script>
