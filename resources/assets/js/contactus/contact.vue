<style>
 #contact .card:hover i,#contact .card:hover h4{
	color: #87d37c;
}
.rowdiv{
    height: 15px;
    
  }
hr{
    margin-top: 1.5em;
}

    
</style>

<template>
  <div>

    <!--header-->
    <navbar></navbar>
    <!--header-->

    <!-- body -->

       <div class="container">
        <div class="row"><div class="col-md-12 rowdiv"></div></div>
           <div class="card">
               <div class="card-block">
                   <h3 class="card-title" align="center" stye="margin-bottom: 20px;">CONTACT US</h3>
                   <hr >
                   <section id="contact">
                       <div class="row">
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-phone fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">Call us</h4>
                    <p>+63 9467059326</p>
                    <p>+63 9989665222</p>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-book fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">School</h4>
                   <address>University of San Carlos - Talamban Campus</address>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-map-marker fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">Address</h4>
                    <address>Nasipit, Talamban, Cebu City, Cebu 6000 </address>
                    <p>+63 32 230 0100</p>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-globe fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">Email</h4>
                    <p>bookshelf@gmail.com</p>
                  </div>
                </div>
             </div>
           </div>
                   </section>
               </div>
           </div>
           
           
       </div>
 
    <!-- body -->

    <!-- footer -->
    <div class="container">
      <footers></footers>
    </div>
    <!-- footer -->
  </div>
</template>
