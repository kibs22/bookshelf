<template>
    <div>
         <div class="row">
            <div class="col-md-8">
                 <div class="panel panel-primary">
                    <div class="panel-heading"><h3>BOOK INFORMATION</h3></div>
                    <div class="panel-body">
                        <form>
                    
                            <bs-input v-model="data.title" :error="errors.title" type="text" id="bookname" label="Book name" input-class="input-sm"></bs-input>
                                
                            <bs-input v-model="data.author" :error="errors.author" type="text" id="author" label="Author" input-class="input-sm"></bs-input>
                                
                            <bs-input v-model="data.year" :error="errors.year" type="text" id="year" label="Year" input-class="input-sm"></bs-input>
                            
                            <bs-input v-model="data.price" :error="errors.price" type="number" id="year" label="price" input-class="input-sm"></bs-input>

                            <bs-select  v-model="data.category"
                            label="Category"
                            :error="errors.category"
                            :options="category"
                            > </bs-select>

                            <bs-input v-model="data.isbn" :error="errors.isbn" type="text" id="ISBN" label="ISBN" input-class="input-sm"></bs-input>
                                        
                            <bs-text v-model="data.description" :error="errors.description"  id="description" label="Description" input-class="input-sm"></bs-text>

                            <bs-file v-model="data.image" :error="errors.image" id="year" label="Book Image" ></bs-file>
        
                            <button type="button" class="btn btn-danger btn-block" @click="submit()" :disabled="loading"> <i class="fa fa-spinner fa-spin" style="font-size: 50px;" v-show="loading"> </i> POST</button>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{

    },
    data(){
        return {
            data:{
                title:null,
                description:null,
                image: null,
                author: null,
                year: null,
                price: null,
                isbn: null,
                category:null
            },
            category:null,
            errors:{},
            formData: new FormData(),
            loading:false,
        }
    },
    mounted(){
        Vue.axios.get('/getCategory')
        .then((res)=>{
            this.category = res.data.data
        })
    },
    methods: {
        submit(){
            
            this.$swal({
                title: 'Post book?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, post it!'
            })
            .then(()=>{

                  this.loading = true;
                   Vue.axios.post('post',this.formData)

                    .then((res)=> {
                       this.loading = false
                       if(res.data.success == true){
                           this.$emit('user-posted');
                            this.$swal({
                                title: 'Success!',
                                text: 'Successfully posted book!',
                                type: 'success'
                            })
                            
                            .then(()=>{
                                this.$router.push({name:'index'})
                            })
                       }
                    })
 
                    .catch((e)=> {
                        this.loading = false
                        this.errors = e.response.data
                    })
            })
            .catch(this.$swal.noop)
        
        },

    },
    watch: {
        'data.title' (val) {
            this.formData.set('title', val);
        },
        'data.category' (val) {
            this.formData.set('category', val);
        },
        'data.description' (val) {
            this.formData.set('description', val);
        },
        'data.image' (val) {
            this.formData.set('image', val);
            // this.formData.set('title', val);
        },
        'data.author' (val) {
            this.formData.set('author', val);
        },
        'data.year' (val) {
            this.formData.set('year', val);
        },
        'data.price' (val) {
            this.formData.set('price', val);
        },
        'data.isbn' (val){
            this.formData.set('isbn', val);
        }
    }
}
</script>