<template>
<div>
    <div class="panel panel-default">
        <div class="panel-heading">My bought books</div>
        <div class="panel-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Book name</th>
                        <th>Status</th>
                        <th></th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <div class="d-block m-x-auto" v-bind:disabled="loading">
                        <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
                        <p v-show="loading">Please wait...</p>
                    </div>
                    <tr>
                        <tr v-for="t of data.details">
                            <td>{{ t.posted.posted_by.firstname }} {{ t.posted.posted_by.lastname }}</td>
                            <td><img :src="t.posted.image" :width="100" :height="100" alt=""> <br> {{ t.posted.title }}</td>
                            <td> 
                                <span class="label label-primary" > {{ t.flag }} </span> 
                            </td>
                            <td>
                                <button class="btn btn-success" data-toggle="modal" data-target="#myModalasd" v-if="t.flag== 'complete' && t.posted.has_reviews == null" @click="getDataForModal(t)">Make a review</button>
                            </td>
                            <td>
                                <button type="button" v-if="t.posted.reports == null && t.flag== 'complete' " class="btn btn-danger" data-toggle="modal" data-target="#myModalrep" @click="getDataForModal(t)">Report</button>
                            </td>
                        </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModalasd" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <b>Make a review</b>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <bs-text v-model="data.message"  :error="errors.message"></bs-text>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" @click.prevent="makeReview()" >Submit</button>
            </div>
            </div>

        </div>
    </div>

    <!--Modal -->
    <div class="modal fade" id="myModalrep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report As:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="radio" v-for="r of data.reports">
                    <label><input type="radio" name="name" :value="r.id" v-model="data.option">{{r.name}}</label>
                </div>                   
                <div class="radio" >
                    <label><input type="radio" name="optradio" @click="showOthers()">Others</label>
                </div> 
                <div v-if="data.others == true">
                    <textarea class="form-control"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="sendReport()">Send report</button>
        </div>
        </div>
    </div>
</div>

</div>
</template>

<script>
export default {
 mounted(){
      this.pending()
      this.getReports()
  },
  data(){
      return {
          data: {
              details: {},
              message:null,
              reportmsg:null,
              reports:null,
              option:null,
              others:false
          },
          reviewDetails:null,
          errors:{},
          loading:true
      }
  },
  methods: {
      pending(){
          Vue.axios.get('/pending')
          .then((res)=>{
            this.loading = false
            this.data.details = res.data.wee
            // console.log(this.data.details)
          })
      },
      showOthers(){
          this.data.others = true;
      },
      getReports(){
          Vue.axios.get('/reports')
          .then((res)=>{
              this.loading = false
              this.data.reports = res.data.data
          })
      },
      sendReport(){
          console.log(this.reviewDetails)
          Vue.axios.post('/addUserReport',{book_id: this.reviewDetails.posted_book_id, reported_to: this.reviewDetails.posted.seller_id})

          .then((res) => {
                if(res.data.success) {
                    this.$swal({
                        title: 'Success!',
                        text: 'Report sent to admin. ',
                        type: 'success'
                    })
                    .then(()=>{
                        this.pending()
                    })
                }
          })
       
      },
      makeReview(){
          let post = {reviewed_for: this.reviewDetails.posted.seller_id, message: this.data.message,posted_id: this.reviewDetails.posted.id}
          Vue.axios.post('/makeReview', post)
          .then((res)=>{
              console.log(res);     
              if(res.data.success == true){
                   this.$swal({
                        title: 'Success!',
                        text: 'Successfully made review!',
                        type: 'success'
                    })
                    .then(()=>{
                        this.pending()
                    })
                   
              }
          })
          .catch((e)=>{
              this.errors = e.response.data
          })
      },
      getDataForModal(d){
           this.loading = false
         this.reviewDetails = d
         console.log(this.reviewDetails)
      }
  }
}
</script>
