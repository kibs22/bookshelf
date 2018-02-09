<template>
  <div>
  
    <!--header-->
    <navbar v-on:user-posted="userSearched()"></navbar>
    <!--header-->
   
    
    <!--body-->
    <div class="container">

      <div class="row"><div class="col-md-12" style="height: 15px;"></div></div>

      <div class="row">
        <div class="col-md-3">
          <category v-on:user-posted="userSearched()"></category>
          
        </div>
        <div class="col-md-8">
          <items :query="q" :shit="c"  v-on:user-search="searchBook()" ref="userItems"></items>
        </div>
<!-- 
        <div class="col-md-12">
            <div class="panel panel-default">
              <chart style="margin-top:10px;"> </chart>  
          </div>
        </div> -->
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
   
    methods: {
      userSearched () {
        this.$refs.userItems.updateList();
      },
      searchBook(){
        this.$refs.userItems.bookSearch();
      }

    },
    data() {
      return {
        q: null,
        c:null
      }
    },
    created() {
      this.q = this.$route.query.q;
      this.c = this.$route.query.cat;
    },
    watch: {
      '$route' (to, from) {
        this.q = this.$route.query.q;
        this.c = this.$route.query.cat
        console.log('search from index component: %s', this.c)
      },
      'c' (val){
        this.c = this.$route.query.cat
      }
    }
  }
</script>
