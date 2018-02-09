<style>
  .rowdiv{
    height: 15px;
  }
  .contentmargin{
    margin:30px 80px 40px 80px
  }
  .panelsizelefttop{
    width:350px; margin-left: 145px; margin-bottom: 40px
  }
  .panelsizerightop{
    width:350px; margin-right: 60px; margin-left: 40px
  }
  .panelsizeleftbot{
    width:350px; margin-left: 145px
  }
  .panelsizerightbot{
    width:350px; margin-right: 60px; margin-left: 40px
  }
  .name{
    margin: 29px 0px 0px -45px
  }
  .school{
    margin: 10px 0px 0px -45px
  }
  #img {
    border-radius: 50%;
}
</style>
<template>
  <div>
  
    <!--header-->
    <navbar></navbar>
    <!--header-->
   
    
    <!--body-->
    <div class="container">
      <div class="row"><div class="col-md-12 rowdiv"></div></div>
      <div class="row">
          
          <div class="col-md-12">
            <div class="card">
              <div class="card-block">
                <h3 class="card-title" align="center">ABOUT US</h3>
                <h4 class="card-text contentmargin" >
                    As essential as education can be, it needs the appropriate tools to make it
                  effective. One of the most important tools one can have is the books has
                  provided knowledge that suits their needs. Nobody has the sufficiency to be
                  happily asking people around for their used books. The age of the internet has
                  already begun and everyone is looking for a much more efficient way of doing
                  things. This includes a way to search for the things you need right at the tip of
                  your hand with the use of mobile devices or a computer.
                </h4>
                <hr>
                <h3 class="card-title" align="center" style="margin-bottom: 30px">OUR TEAM</h3>

                <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-pink panelsizelefttop" style="" >
                        <div class="panel-heading"><i class="fa fa-coffee"></i>   Lead Developer</div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                               <img id="img" src="images/dy.png" alt="Avatar" style="width:100px">
                            </div>
                            <div class="col-md-6">
                              <h5 class="name">ADRIAN DY</h5>
                               <h5 class="school">University of San Carlos  </h5>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel panel-pink panelsizerightop"  >
                        <div class="panel-heading"><i class="fa fa-coffee"></i>   Backend Developer</div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                               <img id="img" src="images/wee.png" alt="Avatar" style="width:100px">
                            </div>
                            <div class="col-md-6">
                              <h5 class="name">MCPAUL WEE</h5>
                               <h5 class="school">University of San Carlos</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-pink panelsizeleftbot">
                        <div class="panel-heading"><i class="fa fa-coffee"></i>  Frontend Developer</div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                               <img  id="img" src="images/muta.png" alt="Avatar" style="width:100px">
                            </div>
                            <div class="col-md-6">
                              <h5 class="name">CARMICHAEL CABREROS</h5>
                               <h5 class="school">University of San Carlos</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-pink panelsizerightbot" style="" >
                      <div class="panel-heading"><i class="fa fa-coffee"></i>   Frontend Developer</div>
                      <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                               <img id="img" src="images/jam.png" alt="Avatar" style="width:100px">
                            </div>
                            <div class="col-md-6">
                              <h5 class="name"> JAMAICA YBANEZ</h5>
                              <h5 class="school">University of San Carlos</h5>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
         
      </div>
    </div>
    <!--body-->
    <!--footer-->
    <div class="container">
      <footers></footers>
    </div>
    <!--footer-->
  </div>

</template>