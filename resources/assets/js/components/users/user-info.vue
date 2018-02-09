<style></style>
<template>
    <div>
        <div class="card">
        <div class="row">
            <div class="col-md-6">
            <img class="card-img-top" :src="$auth.user().image" alt="Card image cap">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h4  align="center">{{ $auth.user().fullname }}</h4>
                
                <hr>
                <div class="profile-usertitle-name">Email :
                  {{ $auth.user().email }}
                </div>
                <div class="profile-usertitle-name">Mobile :
                    {{ $auth.user().mobile }}
                </div>
                <div class="profile-usertitle-name"> Address :
                    {{ $auth.user().address }}
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default{
    mounted(){
        console.log(this.$auth.user());
    }
}

</script>
