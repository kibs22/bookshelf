 <style>
body,html{
     background-image: url('../../../sass/images/background.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    width: 100%;
    height: auto;
}
.setMargin{
    margin-left: 10px;
    margin-top: 10px;
    
}
.setTopMargin{
    margin-top: 10px;
}

</style>
<template>
<div>
    <div>
       <user-navbar></user-navbar>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-3">
          <user-profile class="setMargin"></user-profile>
        </div>

        <div class="col-8 setTopMargin">
        <!-- <div class="card">
            <user-post-items  v-on:user-posted="userPosted()"></user-post-items>
          </div>-->

         <div class="card" style="height:100%;">
           <div class="card-body" style="overflow-y:scroll; height:700px;">
              <user-items class="setTopMargin" ref="userItems"></user-items>
            </div>
          </div>
        </div>

      </div>
    </div>

</div>
</template>


<script>
export default{
    methods: {
      userPosted () {
        this.$refs.userItems.updateList();
      }
    },
     components : {
            'user-navbar' : require('../users/user-navbar.vue'),
            'user-profile' : require('../users/user-card.vue'),
            'user-items' : require('../users/user-posted-items.vue'),
            'user-post-items' : require('../users/user-post-items.vue'),
            'user-search' : require('../users/user-search-results.vue'),
            
        },

}
</script>