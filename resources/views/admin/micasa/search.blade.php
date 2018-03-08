@extends('admin.micasa.panel')
@section('content')
    <div class="maincontent">
        <div class="adminroute">
            <i class="material-icons">&#xE88A;</i>
            <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
            <span class="partup"> Listing <b> / </b></span> <span class="partup">Search</span>
        </div>
        <div class="adminpage">
            <span class="partdown">LISTING</span>
            <text class="partdesc">Search listings for Shtepia ime</text>
        </div>
        <div class="loadhere">
            <table class="listing-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                <input type="hidden" value = '{{$i = 1}}'>

                    @foreach($results as $offer)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $offer->created_at }}</td>
                             <td>{{ $offer->name}}</td> 
                            <td>{{ $offer->address }}</td>

                            <td>  @if($offer->active == 0)
                                    Not approved
                                @endif
                                @if($offer->active == 1)
                                    Approved
                                @endif
                                @if($offer->active == 2)
                                    Waiting
                                @endif
                            </td>
                            <td>
                                <a href="{{url('admin/listings/view/'.$offer->id_offer)}} " class="prbutton">View</a>
                                <a href="{{url('admin/listings/edit/'.$offer->id_offer)}}" class="prbutton">Edit</a>
                                <a href="{{url('admin/listings/delete/'.$offer->id_offer)}}" class="dlbutton">Delete</a>
                            </td>
                            <input type="hidden" value = '{{ $i++ }}'>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection