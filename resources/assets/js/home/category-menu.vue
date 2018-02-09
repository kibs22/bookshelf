<template>
    <div>
       
			<div class=" top-nav rsidebar span_1_of_left">
				<h3 class="cate">CATEGORIES</h3>
                <ul class="menu">
                    <ul class="kid-menu">
                        <li v-for="c in category">
                            <router-link @click="post()" :to="{ name: 'index', query:{cat : c.name }}"> {{ c.name }}</router-link>
                        </li>
                    </ul>
                </ul> 
                	
			</div>
	        <div class="clearfix"> </div>

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
            })
        },
        post(){
            this.$emit('user-posted')
        }
    },
    mounted(){
        this.initData();
    }
}
</script>