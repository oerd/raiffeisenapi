@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <a href="{{ url('agency') }}">Add offer</a>
                        <p>Hello these are your offers :</p>
                        <ul>
                          @foreach ($user as $agency)
                            @foreach($agency->offer as $offer)

                              <div class="col-md-7">
                                <div class="col-md-3">
                                  {{ $offer->created_at }}
                                </div>
                                <div class="col-md-3">
                                  {{ $agency->agency->name}}
                                </div>
                                <div class="col-md-3">
                                  {{ $offer->address }}
                                </div>
                                <div class="col-md-3">
                                  @if($offer->active == 0)
                                  <a href="#">Not approved</a>
                                  @endif
                                  @if($offer->active == 1)
                                  <a href="#"> Approved</a>
                                  @endif
                                  @if($offer->active == 2)
                                  <a href="#">Waiting </a>
                                  @endif
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="col-md-4">
                                  <a href="{{url('admin/listings/view/'.$offer->id_offer)}} " class="btn btn-default">View</a>
                                </div>
                                <div class="col-md-4">
                                  <a href="{{url('admin/listings/edit/'.$offer->id_offer)}}" class="btn btn-block btn-primary">Edit</a>
                                </div>
                                <div class="col-md-4">
                                  <a href="{{url('admin/listings/delete/'.$offer->id_offer)}}" class="btn btn-block btn-danger">Delete</a>
                                </div>
                              </div><br/><br>
                              @endforeach
                          @endforeach
                        </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
