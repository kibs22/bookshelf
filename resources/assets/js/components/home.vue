
<template>

 <body class="home" id="page">
      <!-- Header -->
      <header class="main-header">
         <div class="container">
            <div class="header-content">
               <a href="index.html">
                  <img src="template/img/logo.jpg" style="height:250px;"/>
               </a>

               <nav class="site-nav">
                 <router-link to="/login" class="btn btn-outlined">Login</router-link>
                 
                  <a href="#" class="btn btn-outlined">Sign up</a>
               </nav>
            </div>
         </div>
      </header>

      <!-- Main Content -->
      <div class="content-box">
         <!-- Hero Section -->
         <section class="section section-hero">
            <div class="hero-box">
               <div class="container">
                  <div class="hero-text align-center">
                     <h1>Find books</h1>
                     <p>that suits your needs!</p>
                  </div>

                  <form class="destinations-form">
                     <div class="input-line">
                        <input type="text" name="destination" value="" class="form-input check-value" placeholder="" />
                        <button type="button" name="destination-submit" class="form-submit btn btn-special">Find a book</button>
                     </div>
                  </form>
               </div>
            </div>      
         </section>

         <section class="section section-hero">
            <div id="map"></div>
         </section>

         
         <!-- Parallax Box -->
         <div class="parallax-box">
            <div class="container">
               <div class="text align-center">
                  <h1>Have your own boat?</h1>
                  <p>navigare necesse est, vivere non est necesse</p>

                  <a href="#" class="btn btn-special no-icon size-2x">Rent your boat</a>
               </div>
            </div>
         </div>
      </div>

      <!-- Footer -->
      <footer class="main-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Top Locations</h5>
                     <ul>
                        <li><a href="#">Lorem impsum dolor</a></li>
                        <li><a href="#">Sit amet consectetur</a></li>
                        <li><a href="#">Adipisicing elit</a></li>
                        <li><a href="#">Eiusmod tempor</a></li>
                        <li><a href="#">incididunt ut labore</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Featured Boats</h5>
                     <ul>
                        <li><a href="#">Lorem impsum dolor</a></li>
                        <li><a href="#">Sit amet consectetur</a></li>
                        <li><a href="#">Adipisicing elit</a></li>
                        <li><a href="#">Eiusmod tempor</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-9">
                  <div class="widget widget_social">
                     <h5 class="widget-title">Subscribe to our newsletter</h5>
                     <form class="subscribe-form">
                        <div class="input-line">
                           <input type="text" name="subscribe-email" value="" placeholder="Your email address" />
                        </div>
                        <button type="button" name="subscribe-submit" class="btn btn-special no-icon">Subscribe</button>
                     </form>

                     <ul class="clean-list social-block">
                        <li>
                           <a href="#"><i class="icon-facebook"></i></a>
                        </li>
                        <li>
                           <a href="#"><i class="icon-twitter"></i></a>
                        </li>
                        <li>
                           <a href="#"><i class="icon-google-plus"></i></a>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Contact us</h5>
                     <ul>
                        <li><a href="#">Lorem impsum dolor</a></li>
                        <li><a href="#">Sit amet consectetur</a></li>
                        <li><a href="#">Adipisicing elit</a></li>
                        <li><a href="#">Eiusmod tempor</a></li>
                        <li><a href="#">incididunt ut labore</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
</body>

</template>

 
<script>
  
</script>