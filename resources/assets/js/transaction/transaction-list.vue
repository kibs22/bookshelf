<template>
  <div>
      <div>
          <div class="panel panel-primary">
            <div class="panel-heading">My sold books</div>
            <div class="panel-body">
                 <table class="table">
                    <thead>
                        <tr>
                            <th>Sold to</th>
                            <th>Book name</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                         <div class="d-block m-x-auto" v-bind:disabled="loading">
                            <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"></i>
                            <p v-show="loading">Please wait...</p>
                        </div>
                        <tr v-if="data.details" v-for="t of data.details">
                            <td>{{ t.sold_to.firstname }} {{ t.sold_to.lastname }}</td>
                            <td><img :src="t.posted.image" :width="100" :height="100" alt=""> <br> {{ t.posted.title }}</td>
                            <td> 
                                <span class="label label-primary" v-if="t.flag == 'complete'"> {{ t.flag }} </span> 
                                 <button class="btn btn-success" v-if="t.flag == 'ongoing'" @click="complete(t)"><i class="fa fa-check"></i></button>
                                 <button class="btn btn-danger" v-if="t.flag == 'ongoing'" @click="cancel(t)"><i class="fa fa-times"></i></button>
                            </td>                           
                        </tr>

                    </tbody>
                </table>
            </div>
          </div>
      </div>
  </div>
</template>
<script>
export default {
  mounted(){
      this.getTransactions()
      
  },
  data(){
      return {
          data: {
              details: {},
              
          },
          loading: true
      }
  },
  methods: {
      getTransactions(){
          Vue.axios.get('/getTransaction')
          .then((res)=>{
              this.loading = false
              this.data.details = res.data.wee
            //   console.log(this.data.details)
          })
      },
      complete(t){
             this.$swal({
                title: 'Is this transaction complete?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes it is!'
            })

            .then(()=>{
                Vue.axios.post('/setToComplete', { transaction_id : t.id })

                .then((res)=>{
                    if(res.data.success == true){
                        this.$swal({
                            title: 'complete!',
                            type: 'success',
                        })
                      this.getTransactions();
                    }
                })
            })

            .catch(this.$swal.noop)
        },
        cancel(t){
             this.$swal({
                title: 'are you sure you want to cancel this transaction?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            })

            .then(()=>{
                Vue.axios.post('/setToCancel', { transaction_id : t.id })

                .then((res)=>{
                    if(res.data.success == true){
                        this.$swal({
                            title: 'complete!',
                            type: 'success',
                        })
                      this.getTransactions();
                    }
                })
            })

            .catch(this.$swal.noop)
        }
        
  }
}
</script>
