<style>
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

        <div class="col-6 setTopMargin">
            <user-info></user-info>
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
            'user-info' : require('../users/user-info.vue')
        },
}
</script>