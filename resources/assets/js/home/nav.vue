<template>
  <div class="header">
		<div class="top-header">
			<div class="container">
				<div class="top-header-left">
					<ul class="support">
						
						<li ><a href="/">Home</a></li>
					</ul>
					<ul class="support">
						
						<!-- <li><a href="#">About </a></li> -->
						<li><router-link :to="{ name:'about' }">About</router-link></li>
					</ul>
					<ul class="support">
						
						<li><router-link :to="{ name:'contact' }">Contact us</router-link></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="top-header-right">
					<div class="down-top" v-if="$auth.user().firstname">
						  	<select class="in-drop">
								<option value="*" class="in-of"  v-if="$auth.user().firstname"  >Welcome, {{ $auth.user().firstname }}</option>	
							</select>
							<button class="btn btn-success" data-toggle="modal" data-target=".logoutmodal" v-if="$auth.user().firstname">Logout </button>		
					 </div>	
				</div>
				<div class="clearfix"> </div>		
			</div>
		</div>
		<div class="bottom-header">
			<div class="container">
				<div class="header-bottom-left">
					<div class="logo">
						<a href="/"><img src="images/bookshelflogo.png" alt=" " /></a>
					</div>	
					<div class="search">
						<input type="text" v-model="data.search" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
						<input type="submit"  value="SEARCH" @click="search()">
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="header-bottom-right">					
						<div class="account" v-if="$auth.user().firstname"> <router-link :to="{path:'/profile'}"><span><i class="fa fa-user fa-lg" ></i> </span> <br> ACCOUNT</router-link></div>
							<ul class="login"   v-if="!$auth.user().firstname">
								<li><router-link :to="{name: 'login' }"><span><i class="fa fa-lock fa-lg"></i> </span>LOGIN</router-link></li> |
								<li><router-link :to="{name: 'register' }">SIGNUP</router-link></li>
							</ul>
						<div class="cart" v-if="$auth.user().firstname"> 
							<router-link :to="{name: 'post'}">
								<span><i class="fa fa-book fa-lg"></i> </span> <br> POST
							</router-link>
						</div>
						<div class="cart" v-if="$auth.user().firstname"> 
							<router-link :to="{name: 'message'}" @click="hideNewMessageNotif()">
								<span :class="badge" :style="background"><i class="fa fa-envelope fa-lg"> {{ data.count != 0 || newMessage != null  ? 'new' : '' }} </i></span>  <br> MESSAGES
							</router-link>
						</div>
						<div class="cart" v-if="$auth.user().firstname" style="margin-left:-10px;">
							<router-link :to="{name: 'transaction'}" >
								<span><i class="fa fa-cart-arrow-down fa-lg" ></i> </span> TRANSACTIONS
							</router-link>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>

		 <div class="modal fade bd-logout-modal-sm logoutmodal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Logout?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" @click="$auth.logout()" data-dismiss="modal" >Proceed</button>
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
					search:null,
					count:0,
					hasNew:false
				},
				background:null,
				badge: null,
				newMessage:null
			}
		},
		mounted(){
				if(this.$auth.user().id){
					 this.interval = setInterval(()=>{
						this.notification()
					},5000);
				}
		   
		},
		methods: {
			search(){
				this.$emit('user-search')
				// console.log(this.data.search	)
				this.$router.push({ name	: 'index', query: { q: this.data.search }})		
			},
			notification(){
				Vue.axios.get('/notifaction', {params: {count:this.count, }} )
				.then((res)=>{
					this.count = res.data.count;
					
					if( res.data.new == true){
						this.showNewMessageNotif(res.data.number_of_new)
					}
				})
				.catch((e)=>{
					if(e.response.data.error){
						 clearInterval(this.interval)
					}
				})
			},
			showNewMessageNotif(newMessage){
					this.newMessage = newMessage
					this.background = 'background-color:red; width:60px;',
					this.badge = 'badge'
			},
			hideNewMessageNotif(){
					this.newMessage = null
					this.background = null,
					this.badge = null
			}
		}
	}
</script>




     