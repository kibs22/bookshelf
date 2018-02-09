@extends ('partials.layout')

@section('content')
<div class="content-wrapper"> 
	<section class="content-header">
	<h1>Report List</h1>
	</section>
	<section class="content">
	    <div class="row">
	        <div class="col-md-8">
	            <div class="box box-primary">
	                <div class="box-header with-border">
	                    <div style="float:left">
	                        <h4 class="box-title">Reports</h4>
	                    </div>
	                </div>
	                <div class="box-body">
	                    <div class="table-responsive">
	                        <table class="table no-margin">
	                            <thead>
	                                <tr>
	                                    <th>Report Name</th>
	                                    <th>Description</th>
	                                    <th>Action</th> 
	                                </tr>
	                            </thead>
	                            <tbody>
	                            @foreach($data as $report)
                                	<tr id="tr{{$report->id}}" class="trupdate">
			                            <td>
			                                <span class="name"> {{ $report->name }} </span>
			                            </td>
			                            <td>
											<span class="name"> {{ $report->description }} </span>
			                            </td>
			                            <td>
			                                  <form action="{{url('/deletereportAdmin')}}" method="POST">
			                                  {{csrf_field()}}
			                                  <input type="hidden" name="id" value="{{$report->id}}">
			                                  <button class="btn btn-danger" type="submit">Delete</button>
			                                  </form>
			                            </td>
                         			 </tr>
	                            @endforeach
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section> 
</div>



<footer class="main-footer">
	<div class="pull-right hidden-xs">
	    <b>Version</b> 1.0.0
	</div>
	<strong>BOOKSHELF</a>.</strong> All rights
	    reserved.
</footer>
@endsection

@push('js')
<script>

</script>
@endpush
