<template>
<div class="send-wrap ">
    <form accept-charset="UTF-8" action="" method="POST" role="form" class="">
        <bs-text v-model="data.message" :error="errors.message"></bs-text>
        <div class="form-group">
            <button class="btn btn-info btn-block" @click.prevent="send()" >Send</button>
        </div> 
    </form>
</div>
</template>
<script>
export default {
    props:{
        sellerId:Number
    },
    data(){
        return {
            data:{
                message:null
            },
            errors:{},
            postId:null
        }
    },
    mounted(){
        this.postId = this.$route.params.id
    },
    methods:{
        send(){
            this.$swal({
                title: 'Send message?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!'
            })
            .then(()=>{
                
                if(!this.$auth.user().id){
                    this.$swal({
                        title: 'Good day',
                        text: 'Please login in first',
                        type: 'warning'
                    });
                }else{
                    Vue.axios.post('/sendMessage',{recipient_id:this.sellerId, message:this.data.message, posted_id:this.postId})
                        .then((res)=>{
                            if(res.data.message){
                                
                                this.$swal('Sent!',res.data.message,'success')
                            }
                        })
                        .catch((e)=> {
                            this.errors = e.response.data
                        })  
                }
                
            })
            .catch(this.$swal.noop)
         }
    }
}
</script>
