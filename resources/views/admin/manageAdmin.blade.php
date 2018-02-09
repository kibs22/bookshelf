@extends ('partials.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
        <h1>Add Admin</h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div style="float:ledt">
                        <h4>Admin Details</h4>
                    </div>
                </div>
                    <form method="POST" role="form" action="{{url('/addAdmin')}}" class="ajax">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                            <div class="form-group col-md-4 {{ $errors->first('firstname') ? 'has-error' : '' }}">
                                <label for="">First Name</label>
                                <input type="text" name="firstname" class="form-control">
                                @if($errors->has('firstname'))
                                    <div style="color:#E74C3C" class="form-group"><li>{{$errors->first('firstname')}}</li></div>
                                @endif
                            </div>
                            <div class="form-group col-md-4 {{ $errors->first('MI') ? 'has-error' : '' }}">
                                <label for="">MI</label>
                                <input type="text" name="MI" class="form-control">
                                @if($errors->has('MI'))
                                    <div style="color:#E74C3C" class="form-group"><li>{{$errors->first('MI')}}</li></div>
                                @endif
                            </div>
                            <div class="form-group col-md-4 {{ $errors->first('lastname') ? 'has-error' : '' }}">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" class="form-control">
                                @if($errors->has('lastname'))
                                    <div style="color:#E74C3C" class="form-group"><li>{{$errors->first('lastname')}}</li></div>
                                @endif
                            </div>
                            <div class="col-md-12">
                            </div>      
                            </div>
                            <div class="form-group {{ $errors->first('mobile') ? 'has-error' : '' }}" >
                                <label for="">Mobile</label>
                                <input type="text" name="mobile" class="form-control">
                                @if($errors->has('mobile'))
                                    <div style="color:#E74C3C"><li>{{$errors->first('mobile')}}</li></div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}" >
                                <label for="">Address </label>
                                <input type="text" name="address" class="form-control">
                                @if($errors->has('address'))
                                    <div style="color:#E74C3C"><li>{{$errors->first('address')}}</li></div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                                @if($errors->has('email'))
                                    <div style="color:#E74C3C"><li>{{$errors->first('email')}}</li></div>
                                @endif
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @if($errors->has('password'))
                                        <div style="color:#E74C3C"><li>{{$errors->first('password')}}</li></div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                            </div>
                        </div>  
                        <button  class="btn btn-success btn-block"  type="submit">ADD AS ADMIN</button>
                    </form>
            </div>
          </div>
          <div class="col-md-4">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i> <strong>SUCCESS!</strong>    {{ session('status') }}
                </div>
            @endif
          </div>
      </div>
   </section> 
  </div>
    <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>BOOKSHELF</a>.</strong> All rights
    reserved.
  </footer> -->
@endsection

@push('js')
<script>
   $(".ajax").on('submit', function(){
    event.preventDefault()
                swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Add as admin'
            }).then((result) => {
            if (result.value) {
                $(this).unbind('submit').submit()
            }
            })
   })

</script>
@endpush
