

<template>
    <div>
       <div class="footer" >
		<div class="footer-top">
			<div class="container">
				<div class="latter">
					<h6>NEWS-LETTER</h6>
					<div class="sub-left-right">
						<!-- <form>
							<input type="text" value="Enter email here"onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter email here';}" />
							<input type="submit" value="SUBSCRIBE" />
						</form> -->
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="latter-right">
					<p>ABOUT US</p>
					<ul class="face-in-to">
						<li><a href="#"><span> </span></a></li>
						<li><a href="#"><span class="facebook-in"> </span></a></li>
						<div class="clearfix"> </div>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container" >
				<div class="footer-bottom-cate" style="backgroundcolor:blue">
					<h6>CATEGORIES</h6>
					<ul v-if="category" v-for="c in category">
						<li>
							<router-link @click="post()" :to="{ name: 'index', query:{cat : c.name }}"> {{ c.name }}</router-link>
						</li>
					</ul>
				</div>
				<div class="footer-bottom-cate bottom-grid-cat">
					<h6>LATEST BOOKS</h6>
					<ul v-if="books" v-for="c in books">
						<li>
							<router-link :to="{ name: 'viewItem', params: { id: c.id } }"> {{ c.title }}</router-link>
						</li>
					</ul>
				</div>
				<div class="footer-bottom-cate">
					<h6>FEATURED AUTHORS</h6>
					<ul v-if="authors" v-for="q in authors">
						<li>
							<router-link @click="post()" :to="{ name: 'index', query:{q : q }}"> {{ q }}</router-link>
						</li>
					</ul>
				</div>
				<div class="footer-bottom-cate cate-bottom">
					<img src="images/bookshelflogo.png" class="mx-auto rounded d-block img-rounded img-fluid" alt="">	
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
    </div>
</template>

<script>
export default{
    data(){
        return {
			category:{},
			books:{},
			authors:{},
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
		},
		author(){
			this.$emit('user-search')
		},
		getBooks(){
			Vue.axios.get('/getBook')

			.then((res)=>{
				this.books = res.data.books;
				this.authors = res.data.author;
			})
		}
    },
    mounted(){
		this.initData();
		this.getBooks();
    }
}
</script>