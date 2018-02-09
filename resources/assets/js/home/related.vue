<template>
  <div>
    <br>
        
       
        <div class="row">
             <label for="">Related Books</label>
            <relatedbook :title="related" :id="id" ref="related"></relatedbook>
        </div>
        <div class="row" style="margin-top:20px">
            <label for="">Suggested by Google</label>
            <relatedgooglebook :title="related" ref="google" ></relatedgooglebook>
        </div>
  </div>
</template>
<script >
export default {
  props:{
        related: String,
        id: null
  },
  methods : {
      updateRelated(){
          this.$refs.related.getRelated()
          this.$refs.google.getGoogleBooks()
      }
  },
  watch : {
      'related' (val) {
          this.related = val
      }
  }
}
</script>
