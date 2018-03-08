{{--  @extends('admin.micasa.panel')

@section('content')
    <div class="maincontent">
        <div class="adminroute">
            <i class="material-icons">&#xE88A;</i>
            <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
            <span class="partup"> Agency </span>
        </div>
        <div class="adminpage">
            <span class="partdown">Agency</span>
            <text class="partdesc">All agencies for Shtepia ime</text>
        </div>
        <div class="loadhere">
            <table class="listing-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Agency</th>
                    <th>Url</th>
                    <th>Address</th>
                    <th>Email </th>
                    <th>Phone</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                <input type="hidden" value = '{{$i = 1}}'>
                    @foreach ($user as $value)
                        <tr>
                            <td>{{ $i }}</td>
                            {{--  <td>{{ $value->created_at }}</td>  
                            <td>{{ $value->agency->name}}</td>
                            <td>{{ $value->agency->url}}</td>
                            <td>{{ $value->agency->address}}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>
                                <a href="{{url('admin/agency/view/'.$value->agency->id_agency)}} " class="prbutton">View</a>
                                <a href="{{url('admin/agency/edit/'.$value->agency->id_agency)}}" class="prbutton">Edit</a>
                                <a href="{{url('admin/agency/delete/'.$value->id_user)}}" class="dlbutton">Delete</a>
                            </td>
                            <input type="hidden" value = '{{ $i++ }}'>
                        </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection  --}}

@extends('admin.micasa.panel')

@section('content')
    <div class="maincontent" style="    width: 97%;">
        <div class="adminroute">
            <i class="material-icons">&#xE88A;</i>
            <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
            <span class="partup"> Listing </span>
        </div>
        <div class="adminpage">
            <span class="partdown">Agency</span>
            <text class="partdesc">All agencies for Shtepia ime</text>
            <a class="btn btn-danger pull-right" href="{{url('/admin/agency/add')}}">Add agency</a>
        </div>

        <div class="loadhere">
            <table class="listing-table">
                <thead>
                <tr>
                    <th>#</th>

                    <th>Agency</th>
                    <th>Url</th>
                    <th>Address</th>
                    <th>Email </th>
                    <th>Phone</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                <input type="hidden" value = '{{$i = 1}}'>
                @foreach ($user as $value)
                        <tr>
                            <td> {{ $i }} </td>  
                            <td> {{ $value->agency->name }} </td>
                            <td> {{ $value->agency->url }} </td>
                            <td> {{ $value->agency->address }} </td>
                            <td> {{ $value->email }} </td>
                            <td> {{ $value->phone }} </td>

                            <td>
                                <a href="{{url('admin/agency/edit/'.$value->agency->id_agency)}}" class="prbutton">Edit</a>
                                <a href="{{url('admin/agency/delete/'.$value->id_user)}}" class="dlbutton">Delete</a>
                            </td>
                            <input type="hidden" value = '{{ $i++ }}'>  
                        </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

