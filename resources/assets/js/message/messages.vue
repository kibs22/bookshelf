<style>
    .card{
        margin-top: 15px;
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
                <message-navlinks></message-navlinks>
            </div>
            <div class="col-md-9">
                <message-thread></message-thread>
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
            'message-thread' : require('../message/message-thread.vue'),
            'message-navlinks' : require('../message/message-navlinks.vue')
        },
}
</script>