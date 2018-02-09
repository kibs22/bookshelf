<style>
.setTopMargin{
    margin-top: 10px;
}
</style>
<template>
<div>
    <div class="list-group">
        <div class="card">
            <h6 class="setTopMargin text-center">Browse by Category</h6>
            <a href="#" class="list-group-item list-group-item-action" v-for="c in category">{{ c.name }}</a>
        </div>
    </div>
</div>
</template>

<script>
export default{
    data(){
        return {
            category:{}
        }
    },
    methods:{
        initData(){
            Vue.axios.get('/getCategory')

            .then((d)=>{
                this.category = d.data.data;
                console.log();
            })
        }
    },
    mounted(){
        this.initData();
    }
}
</script>