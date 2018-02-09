<style>
.navbar{
  width: 100%;
}
</style>
<template>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="#">
       <img src="template\img\logo.jpg" width="30" height="30" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <router-link class="nav-link" to="/userdashboard" active-class="active">Home</router-link>
        </li>
      
        <li class="nav-item">
          <a class="nav-link" href="#"> </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" Style="margin-top:5px;">
            <img :src="$auth.user().image" width="30" height="30" class="d-inline-block align-top rounded-circle" style="margin-top:-5px;" alt="">
            {{ $auth.user().fullname }}
          </a>
          <div class="dropdown-menu">
            <router-link class="dropdown-item" to="/userposts">Profile</router-link>
            <router-link class="dropdown-item" to="/usermessages">Messages</router-link>
            <div class="dropdown-divider"></div>
             <span class="fa fa-sign-out dropdown-item"  data-toggle="modal" data-target=".bd-logout-modal-sm"> Logout</span>
          </div>
        </li>
        <li class="nav-item">
         <button class="btn btn-outline-danger" @click="sell()">Sell</span></button>
        </li>
      </ul>
    </div>
  </nav>
  
    <!-- Modal -->
    <div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="padding:5px 5px 5px 5px;">
                <div class="col-auto">
                  <user-post-items v-on:user-posted="userPosted()"></user-post-items>
                </div>
            </div>
        </div>
    </div>
    <!--end of modal-->

    <div class="modal fade bd-logout-modal-sm" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-body">
            Logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">AY</button>
            <button type="button" class="btn btn-primary" @click="$auth.logout()" data-dismiss="modal" >Cge</button>
          </div>
        </div>
      </div>
    </div>

</header>
</template>

<script>
export default{
  props:{

  },
  components:{
    'user-post-items' : require('../users/user-post-items.vue')
  },
  methods:{
    sell(){
      this.openModal();
    },
    openModal(){
      $("#sellModal").modal('show');
    }
  }
}
</script>