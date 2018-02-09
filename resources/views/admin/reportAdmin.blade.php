@extends ('partials.layout')

@section('content')
	<div class="content-wrapper">
		<section class="content-header">
			<h1>File Report</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-8">
					<div class="box box-primary">
						<div class="box-body">
							<form  method="post" action="{{ url('/addreportAdmin') }}">
								{{ csrf_field() }}
								<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
									<label>Report Name</label>
									<input type="text" name="name" class="form-control" placeholder="Enter...">
									@if($errors->has('name'))
                                    	<div style="color:#E74C3C" class="form-group"><li>{{$errors->first('name')}}</li></div>
                               		 @endif
								</div>
								<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
									<label>Report Description</label>
									<textarea class="form-control" name="description" placeholder="Copy or Paste Report..."></textarea>
									@if($errors->has('description'))
                                    	<div style="color:#E74C3C" class="form-group"><li>{{$errors->first('description')}}</li></div>
                               		@endif
								</div>

								<button type="submit" class="btn btn-danger btn-sm">Submit</button>
							</form>
						</div>
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
