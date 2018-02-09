@extends ('partials.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Category 
      </h1>
    </section>
 
    <section class="content">
    
    <!-- <button class="btn btn-success btn-sample">SHOW</button>
    <div class="sample"></div> -->

     <div class="row-xs-5">
          <div class="box">
            <div class="box-body">
              <form method="POST" action="{{ url('/createCategory') }}">
                {{csrf_field()}}
                <div class="form-group">
                  <input type="text" name="name" class="form-group" id="name" placeholder="Enter New Category" >
                  @if($errors->has('name'))
                  <span class="text-muted">{{ $errors->first('name')}}</span>
                  @endif
                  <button class="btn btn-success btn-sm" type="submit" >Create</button>
                </div>
              </form>
            </div>
          </div>
      </div> 

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">CATEGORY</h3>
            </div>
            
            <div class="box-body">
                <table class="table table-bordered table-responsive">
                    <thead>
                      <tr>
                          <th>Category</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach($data as $d)
                          <tr id="tr{{$d->id}}" class="trupdate">
                            <td>
                                 
                                <!-- <span class="name"> {{ $d->name }} </span> -->
                                <!-- <input type="text" name="name" class="hidden editable catname " value="{{$d->name}}"> -->
                                {{ csrf_field() }}
                                <a href="#"  id="" class="edit" data-type="text" data-pk="{{$d->id}}"  data-title="Update Category">{{$d->name}}</a>

                            </td>
                            <!-- <td>
                                <button class="btn btn-warning btn update" type="button">Edit</button>
                                <button class="btn btn-success btn-update hidden check " type="submit"><i class="fa fa-check"></i></button>
                                <button class="btn btn-danger hidden check unshow" type="button"><i class="fa fa-times"></i></button>
                        
                            </td> -->
                            <td>
                                  <form action="{{url('/deleteCategory')}}" method="post" class="ajax">
                                  {{csrf_field()}}
                                  <input type="hidden" name="id" value="{{$d->id}}">
                                  <button class="btn btn-danger" style="align:center" type="submit">Delete</button>
                                  </form>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
    </section> 

  </div>
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
       
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>

@endsection

@push('js')

<script >
   
   $(document).ready(function() { 
      
      $(".edit").editable({
        type: 'POST',
        url: '{{ url("/updateCat") }}',
        success: function(response) {   
            
          },
          validate: function(value){
            if(!$.trim(value))
              return 'required'
          }
      })//1 function

      // $.get('{{ url("/sample") }}')

      // .then(function(res){
      //     for(var x = 0; x < res.wee.length; x++){
      //        console.log(res.wee[x].name);
      //        $('.sample').append('<p>'+res.wee[x].name+'</p>')
      //     }
      // })//2nd function
      
  });

  
  $(".btn-sample").on('click',function(){

          $.ajax({
            type:'get',
            url: '{{ url("/sample") }}',
            success:function(res){
              for(var x = 0; x < res.wee.length; x++){
                console.log(res.wee[x].name);
                $('.sample').append('<p>'+res.wee[x].name+'</p>')
              }
            }
         })
      })


 

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


