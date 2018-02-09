<template>
  <div>
  
    <!--header-->
    <navbar></navbar>
    <!--header-->
   
    
    <!--body-->
    <div class="container">

      <div class="row"><div class="col-md-12" style="height: 15px;"></div></div>

      <div class="row">
        <div class="col-md-3">
         <user-info></user-info>
        </div>
        <div class="col-md-6"  style="height:100%;">
          <div class="card-body" style="overflow-y:scroll; height:700px;">
            <myitems></myitems>
          </div>
        </div>
        <div class="col-md-3" >
         <reviews></reviews>
         <br>
          <regular></regular>
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
            'user-info' : require('../profile/profile.vue'),
            'reviews'   : require('../profile/review.vue'),
            'myitems'   : require('../profile/myitems.vue'),
            'regular'   : require('../profile/regular.vue'),
        },
}
</script>