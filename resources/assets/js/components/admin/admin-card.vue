<style>
.card{
    padding:10px 10px 10px 10px;
}
.nav-item{
    margin-top: 5px;
}
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}
.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

</style>
<template>
  
    <div class="card" style="width: 15rem;">
        <img src="template/img/background.jpg" class="mx-auto rounded d-block img-rounded img-fluid" alt="">
        <div class="card-body">
            <div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ $auth.user().fullname }}
					</div>
					<div class="profile-usertitle-job">
						{{ $auth.user().role_type }}
					</div>
				</div>
        </div>

        <div class="profile-usermenu">
            <ul class="nav flex-column">
                <li>
                    <a href="dashboard.html">
                    <i class="glyphicon glyphicon glyphicon-folder-open"></i>
                   Profile</a>
                </li>
                <li>
                    <a href="#">
                    <i class="glyphicon glyphicon-user"></i>
                    Account Settings </a>
                </li>
                <li>
                    <button type="button" class="btn btn-danger btn-block" style="margin-top:20px;left:-10px;"  data-toggle="modal" data-target=".bd-logout-modal-sm">Logout</button>
                </li>
            </ul>
        </div>

        <div class="modal fade bd-logout-modal-sm"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body">
                Logout?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">AY</button>
                <button type="button" class="btn btn-primary" @click="$auth.logout()" data-dismiss="modal" >Cge</button>
              </div>
            </div>
          </div>
        </div>
        
    </div>

</template>

<script>
export default {
 
  
}
</script>