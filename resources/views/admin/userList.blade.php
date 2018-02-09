@extends ('partials.layout')

@section ('content')
<div class="content-wrapper">
    <section class="content-header">
    
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div style="float:left">
                            <h4 class="box-title">Registered Users</h4>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $user)
                                    <tr>
                                        <td>{{$user->firstname}} {{$user->MI}}. {{$user->lastname}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->role_type}}</td>
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
@endsection