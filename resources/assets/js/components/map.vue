<template>
<div>
  <!--card-->  
  <div class="card">
    <div>
      <form class="form-inline my-2 my-lg-0 pull-right">
        <input class="form-control mr-sm-2" type="text" v-model="data.search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" @click="search">Search</button>
      </form>
    </div>
    <div class="card-body">
      <gmap-map
      :center="center"
      :zoom="10"
      style="width: 100%; height: 600px;"
      >
      
          <gmap-marker
          :key="index"
          v-for="(m, index) in markers"
          v-model="markers"
          :position="m.position"
          :clickable="true"
          @click="viewDetails(m)"
        >
        </gmap-marker>
      </gmap-map>
    </div>
  </div>
  <!--end of card-->

  
  <!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card" style="width: 100%;">
          <!--modal-card-->
                 <div class="row">
                    <div class="col-md-6">
                      <img class="card-img-top" :src="modal.image" alt="Card image cap">
                    </div>
                    <div class="col-md-6">
                      <div class="card-body">
                      <h4 class="card-title">{{modal.title }}</h4>
                      <p class="card-text">{{ modal.description }}</p>
                    </div>
                  </div>
              </div>
            </div>
          <!--end of modal card-->
            <hr>
            <bs-text v-model="data.message" :error="errors.message"  id="description" label="Message" input-class="input-sm"></bs-text>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success" @click.prevent="sendMessage()"> Send </button>
      </div>
    </div>
  </div>
</div>
<!--end of modal-->

</div>
</template>

<script>
import *  as VueGoogleMaps from 'vue2-google-maps';
import MapElementMixin  from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCkC-Iuz9NNHqJLwL2c7vbr3VlyVwluceE',
    libraries: 'places', // This is required if you use the Autocomplete plugin 

  }
})

export default {
  // mixins: [MapElementMixin],
  
   props: {
    'route-id': {
            type: Number
        },
   },
    data () {
      return {
        data: {
           search: null,
           results: null,
           places: null,
           details: {}
        },
        message:null,
        id:null,
        postId: null,
        modal:{
          image: null,
          title: null,
          description: null,
          price: null,
          message: null,
        },
        center: {lat: 10.31111, lng: 123.89167},
        markers: [],
        errors: {}
      }
    },
    methods: {
      trigger() {
       
      },
      search() {
          Vue.axios.post('/search',this.data)

          .then((r)=>{
            this.loading = true;
            this.markers = r.data.data;
            this.results = r.data.data;
          })
      },
      sendMessage(){
        Vue.axios.post('/sendMessage', {message:this.data.message, recipient_id: this.id, posted_id: this.postId})

        .catch((d)=>{
           this.errors = d.response.data
        })

        .then((e)=>{
          
        })
      },
      viewDetails(item){
        this.modal.image = item.item.image;
        this.modal.title = item.item.title;
        this.modal.description = item.item.description;
        this.postId = item.id;
        this.id = item.id;
        this.modal.price = item.price;
        this.triggerModal();
      },
      triggerModal(){
        $("#detailsModal").modal('show');
      }

    }
  }
</script>