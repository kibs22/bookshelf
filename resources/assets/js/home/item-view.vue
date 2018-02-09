<template>
<div>
  <div class="panel panel-primary" v-for="d of details"> 
      <div class="panel-heading">
          <p class="card-text">Book: <b>{{ d.item.title }}</b></p>
      </div>
      <div class="panel-body">
          <div class="row">
              <div class="col-md-3">
                    <img :src="d.item.image" width="100px">
              </div>
              <div class="col-md-6">
                    <p class="card-text"><b>Author:</b> {{ d.item.author }}</p>
                    <p class="card-text"><b>Year published:</b> {{ d.item.year }}</p>
                    <p class="card-text"><b>Description:</b> {{ d.item.description }}</p>
                    
              </div>

          </div>
      </div>    
  </div>


  <div class="panel panel-primary" v-for="d of details"> 
      <div class="panel-heading">
          <p class="card-text">Seller details</p>
      </div>
      <div class="panel-body">
          <div class="row">
              <div class="col-md-3">
                   <img :src="d.seller.image" height="100" width="100" class="d-inline-block align-top rounded-circle" alt="">
              </div>
              <div class="col-md-9">
                  Posted by: <b>{{ d.seller.firstname }} {{ d.seller.lastname }}</b>
                  
                  <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <h4>Reviews</h4>
                            <li class="list-group-item"> 
                                <div>
                                    <div v-if="d.seller.my_reviews" >
                                        <div v-for="r of d.seller.my_reviews">
                                            {{ r.content }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                  </div>
              </div>
          </div>
      </div>    
  </div>


</div>
</template>

<script>
 export default{
        props:{
            details:{}
        },
        mounted(){
            console.log(this.details)
            // this.getReviewsOfSeller()
        },
        data() {
            return {
                id:null,
            }
        }
    }
</script>
