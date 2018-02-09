<template>
  <div>
  
    <!--header-->
    <navbar></navbar>
    <!--header-->
   
    
    <!--body-->
    <div class="container">

      <div class="row"><div class="col-md-12" style="height: 15px;"></div></div>

      <div class="row">
        <div class="col-md-12">
            <t-list></t-list>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <p-list></p-list>
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
export default {
  components: {
      't-list' : require('../transaction/transaction-list.vue'),
      'p-list' : require('../transaction/pending-list.vue'),
  } 
}
</script>
