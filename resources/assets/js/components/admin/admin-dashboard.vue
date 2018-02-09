<style>
</style>
<template>
<div>
  <admin-login> </admin-login>
</div>
</template>

<script>

export default{
     components : {
            'admin-navbar' : require('../navbar.vue'),
            'admin-card' : require('../admin/admin-card.vue'),
            'admin-login': require('../adminLogin.vue')
      },
      mounted(){
        Vue.axios.get('/getUsers')
      },
}
</script>

