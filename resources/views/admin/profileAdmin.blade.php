@extends ('partials.layout')

@section ('content')
<div class="content-wrapper">
    <section class="content-header">
    
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="box-header with-border">
                            <img class="profile-user-img img-responsive img-circle" src="images/admin.png" alt="User profile picture">
                            <h3 class="profile-username text-center">Admin Profile</h3>
                        </div>
                        <form action="{{url('/update')}}" method="post" class="ajax">
                            {{ csrf_field() }}
                            <div class="row"><br>
                                <div class="col-md-5">
                                    <label>Firstname</label>
                                    <input name="firstname" type="text" value="{{Auth::User()->firstname}}" class="form-control  editable" disabled="disabled">
                                </div> 
                                <div class="col-md-2">
                                    <label>MI</label>
                                    <input name="MI" type="text" value="{{Auth::User()->MI}}" class="form-control editable" disabled="disabled"> 
                                </div>
                                <div class="col-md-5">
                                    <label>Lastname</label>
                                    <input name="lastname" type="text" value="{{Auth::User()->lastname}}" class="form-control editable" disabled="disabled">
                                </div>       
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <br><label>Email</label>
                                    <input name="email" value="{{Auth::User()->email}}" class="form-control editable" disabled="disabled">
                                </div>
                                <div class="col-md-6">
                                    <br><label>Mobile</label>                 
                                    <input name="mobile" value="{{Auth::User()->mobile}}" class="form-control editable" disabled="disabled">
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br><label>Address</label>
                                    <input name="address" value="{{Auth::User()->address}}" class="form-control editable" disabled="disabled">
                                </div>

                                <div class="col-md-12">
                                    <br><button type="button" class="btn btn-primary btn-block editablebutton " onclick="showupdate()"><i class="fa fa-pencil"></i> Edit</button>
                                </div>

                                <div class="col-md-6">
                                    <br><button type="submit" class="btn btn-success btn-block hidden editablebutton" ><i class="fa fa-check"></i> Update</button>
                                </div>

                                <div class="col-md-6">
                                    <br><button type="button" class="btn btn-danger btn-block hidden editablebutton" onclick="unshowupdate()"><i class="fa fa-ban"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <form action="{{url('/changePassword')}}" method="post" class="ajax">
                    {{ csrf_field() }}
                   
                    <div class="col-md-4 password hidden">
                        <br><label>New Password</label>
                        <input type="password" name="password" class="form-control  ">
                       
                    </div>  

                    <div class="col-md-4 password hidden">
                        <br><label >Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control  ">
                    </div>
                    <div class="col-md-4" style="margin-top: 45px;">
                        <button type="button" class="btn btn-success editablebuttonPass" onclick="showupdatepassword()">Change User Password</button>
                        <button type="submit" class="btn btn-success editablebuttonPass hidden"><i class="fa fa-check"></i> Update</button>
                        <button type="button" class="btn btn-danger editablebuttonPass hidden" onclick="unshowupdatepassword()"><i class="fa fa-ban"></i> Cancel</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-4" >
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i> <strong>SUCCESS!</strong>    {{ session('status') }}
                    </div>
                @endif

                @if($errors->count() || isset($loginError))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul class="">  
                            @foreach($errors->all() AS $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

@endsection

@push('js')
    <script type="text/javascript">

        function showupdate(){
            $('.editable').removeAttr('disabled')  
            
            $('.editablebutton').toggleClass('hidden') 
        }

        function unshowupdate(){
            $('.editable').attr('disabled', 'disabled')
            // $('.password').addClass('hidden')
            $('.editablebutton').toggleClass('hidden')
        }

        function showupdatepassword(){
            $('.editablebuttonPass').toggleClass('hidden')
            $('.password').removeClass('hidden')
        }

        function unshowupdatepassword(){
            $('.editablebuttonPass').toggleClass('hidden')
            $('.password').addClass('hidden')
        }

        $(".ajax").on('submit', function(){
            event.preventDefault()
                swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continue'
            }).then((result) => {
            if (result.value) {
                $(this).unbind('submit').submit()
            }
            })
        })

    </script>
    
@endpush