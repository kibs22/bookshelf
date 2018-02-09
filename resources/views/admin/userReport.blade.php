@extends ('partials.layout')

@section ('content')
<div class="content-wrapper">
    <section class="content-header">
   
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <div style="float:left">
	                        <h4 class="box-title">Blockable Users</h4>
	                    </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Reports</td>
                                        <td>Block</td>
                                    </tr>
                                </thead>

                                <tbody>

                             
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row->firstname }} {{$row->MI}}.  {{$row->lastname}}</td>
                                        <td>{{ $row->email}}</td>
                                        <td> {{ $row->reports_count }}</td>
                                        <td>
                                        <!-- <a href="{{ url('/blockUser',['id' => $row->id]) }}" class="btn btn-danger"><i class="fa fa-times"></i></i></a> --> 
                                        <button id="block" class="btn btn-danger" value="{{ $row->id }}"> <span class="fa fa-times"> </span></button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                 @if (session('status'))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-times"></i> {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <div style="float:left">
	                        <h4 class="box-title">Unblock Users</h4>
	                    </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Unblock</td>
                                    </tr>
                                </thead>

                                <tbody>

                             
                                @foreach($unblockable as $row)
                                    <tr>
                                        <td>{{ $row->firstname }} {{$row->MI}}.  {{$row->lastname}}</td>
                                        <td>{{ $row->email}}</td>
                                        <td>
                                        <!-- <a href="{{ url('/blockUser',['id' => $row->id]) }}" class="btn btn-danger"><i class="fa fa-times"></i></i></a> --> 
                                        <button id="unblock" class="btn btn-success" value="{{ $row->id }}"> <span class="fa fa-check"> </span></button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                 @if (session('status'))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-times"></i> {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    
</div>
@endsection

@push('js')
    <script type="text/javascript">
        
        $('#block').on('click', function() {
            // alert( $(this).val() )
            var id = $(this).val() 
            console.log(id)
           
            swal({
                  title: "Are you sure?",
                  text: "User will be Blocked!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
               
                .then((willDelete) => {
                      if (willDelete) {
                        
                          $.post( "{{ url('/blockUser') }}", {user_id :id} )

                          .done(function(res) {
                                if(res.success == true){
                                    swal({
                                          title: "Success!",
                                          text: "User has been reported!",
                                          icon: "success",
                                          button: "OK",
                                        });

                                    setTimeout(function() {
                                            location.reload()
                                    }, 2000)
                                  
                                }
                          })
                      }
                });
        })

        $('#unblock').on('click', function(){

            var id = $(this).val();
            console.log(id);

            swal({
                  title: "Unblock User?",
                  text: "User will be Unblocked!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })

                .then((willUnblock)=>{

                    if(willUnblock){

                        $.post("{{ url('/unblockUser') }}", {userid:id})

                        .done((res)=>{
                            if(res.success == true){

                                swal({
                                          title: "Success!",
                                          text: "User has been Unblocked!",
                                          icon: "success",
                                          button: "OK",
                                        });

                                    setTimeout(function() {
                                            location.reload()
                                    }, 2000)

                            }
                        })

                    }

                })


        })
    </script>
@endpush

<!-- @if (session('status'))
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            swal({
                      title: "Success!",
                      text: "User has been reported!",
                      icon: "success",
                      button: "OK",
                    });
        })
    </script>
@endpush
@endif -->
