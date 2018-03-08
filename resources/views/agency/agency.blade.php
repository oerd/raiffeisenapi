@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <a href="{{ url('agency') }}">Add offer</a>
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#home">Non Activated</a></li>
                      <li><a data-toggle="tab" href="#menu1">Activated</a></li>
                    </ul>

                    <div class="tab-content">
                      <div id="home" class="tab-pane fade in active">
                        <p>Hello these are your offers :</p>
                        <ul>
                          @foreach ($data as $offer)
                            <li>
                              <div class="col-md-8">
                                <a href="{{url('agency/show/'.$offer->id_offer)}}">{{ $offer->name }}</a>
                              </div>
                              <div class="col-md-4">
                                <div class="col-md-6">
                                  <a href="{{url('agency/edit/'.$offer->id_offer)}}" class="btn btn-block btn-primary">Edit</a>
                                </div>
                                <div class="col-md-6">
                                  <a href="{{url('agency/delete/'.$offer->id_offer)}}" class="btn btn-block btn-danger">Delete</a>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                      <div id="menu1" class="tab-pane fade">
                        <p>Hello these are your offers :</p>
                        <ul>
                          @foreach ($dataActive as $offerActive)
                            <li>
                              <div class="col-md-8">
                                <a href="{{url('agency/show/'.$offerActive->id_offer)}}">{{ $offerActive->name }}</a>
                              </div>
                              <div class="col-md-4">
                                <div class="col-md-6">
                                  <a href="{{url('agency/edit/'.$offerActive->id_offer)}}" class="btn btn-block btn-primary">Edit</a>
                                </div>
                                <div class="col-md-6">
                                  <a href="{{url('agency/delete/'.$offerActive->id_offer)}}" class="btn btn-block btn-danger">Delete</a>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
