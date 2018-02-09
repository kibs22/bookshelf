<style>
body,html{
    background-image: url('../../../sass/images/background.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.setMargin{
    margin-left: 10px;
    margin-top: 10px;
    
}
.mapMargin{
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
        <div class="col-3 mapMargin">
         <!-- <user-profile class="mapMargin" ></user-profile>-->
         <category-list></category-list>
        </div>

        <div class="col-8 setMargin">
          <!--<user-search class="mapMargin"></user-search>-->
         <user-search></user-search>
        </div>

       
      </div>
    </div>
  </div>
</template>

<script>

export default{
     components : {
            'user-navbar' : require('../users/user-navbar.vue'),
            'user-profile' : require('../users/user-card.vue'),
            'user-search' : require('../users/user-search-results.vue'),
            'category-list' : require('../users/user-category-list.vue')
        },
}
</script>